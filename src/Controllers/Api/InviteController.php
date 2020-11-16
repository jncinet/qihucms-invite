<?php

namespace Qihucms\Invite\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Qihucms\Invite\Invite;
use Qihucms\Invite\Resources\PupilCollection;
use Qihucms\Invite\Resources\Invite as InviteResource;

class InviteController extends ApiController
{
    protected $invite;

    /**
     * InviteController constructor.
     * @param Invite $invite
     */
    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
        $this->middleware('auth:api');
    }

    /**
     * 我的推广信息
     *
     * @return InviteResource
     */
    public function my()
    {
        $result = $this->invite->findByUserId(\Auth::id());

        return new InviteResource($result);
    }

    /**
     * 我的徒弟
     *
     * @param Request $request
     * @return PupilCollection
     */
    public function mySon(Request $request)
    {
        $limit = $request->get('limit', 15);
        $result = $this->invite->getUserSon(\Auth::id(), $limit);

        return new PupilCollection($result);
    }

    /**
     * 我的徒孙
     *
     * @param Request $request
     * @return PupilCollection
     */
    public function myGrandson(Request $request)
    {
        $limit = $request->get('limit', 15);
        $result = $this->invite->getUserGrandson(\Auth::id(), $limit);

        return new PupilCollection($result);
    }
}