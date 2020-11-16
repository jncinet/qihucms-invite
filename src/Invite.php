<?php

namespace Qihucms\Invite;

use Qihucms\Invite\Models\Invite as InviteModel;

class Invite
{
    /**
     * 当前用户
     *
     * @param $user_id
     * @return mixed
     */
    public function findByUserId($user_id)
    {
        return InviteModel::find($user_id);
    }

    /**
     * 创建推广记录
     *
     * @param int $user_id 当前注册的会员
     * @param int $parent_id 当前注册会员的师父
     * @return mixed
     */
    public function create($user_id, $parent_id = 0)
    {
        // 是否有师父
        if ($parent_id > 0) {
            // 读取师父关系
            $parent = $this->findByUserId($parent_id);
            // 祖师的ID
            $grandfather_id = $parent->parent_id;
        } else {
            // 当前会员的祖师
            $grandfather_id = 0;
        }

        // 上级不能是自己
        if ($user_id == $parent_id) {
            $parent_id = 0;
            $grandfather_id = 0;
        }

        // 创建记录
        $result = InviteModel::create([
            'user_id' => $user_id,
            'parent_id' => $parent_id,
            'grandfather_id' => $grandfather_id
        ]);

        // 更新师傅的徒弟数
        if ($result && $result->parent_id > 0) {
            $this->updateSonCount($result->parent_id);

            // 更新太师的徒孙数
            if ($result->grandfather_id > 0) {
                $this->updateGrandsonCount($result->grandfather_id);
            }
        }

        return $result;
    }

    /**
     * 更新会员徒弟数量
     * @param $user_id
     * @return mixed
     */
    public function updateSonCount($user_id)
    {
        $count = $this->getUserSonCount($user_id);
        return InviteModel::where('user_id', $user_id)->update(['son_count' => $count]);
    }

    /**
     * 更新会员徒孙数量
     * @param $user_id
     * @return mixed
     */
    public function updateGrandsonCount($user_id)
    {
        $count = $this->getUserGrandsonCount($user_id);
        return InviteModel::where('user_id', $user_id)->update(['grandson_count' => $count]);
    }

    /**
     * 获取会员徒弟的数量
     *
     * @param $user_id
     * @return mixed
     */
    public function getUserSonCount($user_id)
    {
        return InviteModel::where('parent_id', $user_id)->count();
    }

    /** 获取会员徒孙的数量
     * @param $user_id
     * @return mixed
     */
    public function getUserGrandsonCount($user_id)
    {
        return InviteModel::where('grandfather_id', $user_id)->count();
    }

    /**
     * 获取徒弟
     *
     * @param int $user_id 用户ID
     * @param int $limit 显示数量
     * @return mixed
     */
    public function getUserGrandson($user_id, $limit = 15)
    {
        return InviteModel::where('grandfather_id', $user_id)->orderBy('user_id', 'desc')->paginate($limit);
    }

    /**
     * 获取徒孙
     *
     * @param int $user_id 用户ID
     * @param int $limit 显示数量
     * @return mixed
     */
    public function getUserSon($user_id, $limit = 15)
    {
        return InviteModel::where('parent_id', $user_id)->orderBy('user_id', 'desc')->paginate($limit);
    }
}