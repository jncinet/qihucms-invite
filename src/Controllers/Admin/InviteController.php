<?php

namespace Qihucms\Invite\Controllers\Admin;

use App\Admin\Controllers\Controller;
use App\Models\User;
use Qihucms\Invite\Models\Invite;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class InviteController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '会员推广关系';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Invite);

        $grid->model()->orderBy('user_id', 'desc');

        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableActions();

        $grid->filter(function ($filter) {

            $filter->disableIdFilter();

            $filter->equal('user_id', __('invite::invite.user_id') . 'ID');
            $filter->equal('parent_id', __('invite::invite.parent_id') . 'ID');
            $filter->equal('grandfather_id', __('invite::invite.grandfather_id') . 'ID');
            $filter->between('son_count', __('invite::invite.son_count'));
            $filter->between('grandson_count', __('invite::invite.grandson_count'));
        });

        $grid->column('user_id', __('invite::invite.user_id'))
            ->display(function () {
                $model = $this->user_info;
                if ($model) {
                    $html = '<div>' . __('user.username') . '：' . $model->username . '</div>';
                    $html .= '<div>' . __('user.mobile') . '：' . ($model->mobile ?: '未绑定') . '</div>';
                    return $html;
                }
            });
        $grid->column('parent_id', __('invite::invite.parent_id'))
            ->display(function () {
                $html = 'TA没有' . __('invite::invite.parent_id');
                if ($this->parent_id > 0) {
                    $model = $this->parent_info;
                    if ($model) {
                        $html = '<div>' . __('user.username') . '：' . $model->username . '</div>';
                        $html .= '<div>' . __('user.mobile') . '：' . ($model->mobile ?: '未绑定') . '</div>';
                    }
                }
                return $html;
            });
        $grid->column('grandfather_id', __('invite::invite.grandfather_id'))
            ->display(function () {
                $html = 'TA没有' . __('invite::invite.grandfather_id');
                if ($this->grandfather_id) {
                    $model = $this->grandfather_info;
                    $html = '<div>' . __('user.username') . '：' . $model->username . '</div>';
                    $html .= '<div>' . __('user.mobile') . '：' . ($model->mobile ?: '未绑定') . '</div>';
                }
                return $html;
            });
        $grid->column('son_count', __('invite::invite.son_count'))->suffix('人')->sortable();
        $grid->column('grandson_count', __('invite::invite.grandson_count'))->suffix('人')->sortable();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Invite::findOrFail($id));

        $show->field('user_id', __('invite::invite.user_id'));
        $show->field('parent_id', __('invite::invite.parent_id'));
        $show->field('grandfather_id', __('invite::invite.grandfather_id'));
        $show->field('son_count', __('invite::invite.son_count'));
        $show->field('grandson_count', __('invite::invite.grandson_count'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Invite);

        return $form;
    }
}
