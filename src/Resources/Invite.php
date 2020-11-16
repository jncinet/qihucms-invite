<?php

namespace Qihucms\Invite\Resources;

use App\Http\Resources\User\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Invite extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'parent' => new User($this->parent_info),
            'grandfather' => new User($this->grandfather_info),
            'son_count' => $this->son_count,
            'grandson_count' => $this->grandson_count,
        ];
    }
}
