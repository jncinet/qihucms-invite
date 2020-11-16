<?php

namespace Qihucms\Invite\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Qihucms\Invite\Events\Invited;

class Invite extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'grandfather_id', 'parent_id', 'son_count', 'grandson_count'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'son_count' => 'integer',
        'grandson_count' => 'integer'
    ];

    /**
     * @var array
     */
    protected $dispatchesEvents = ['created' => Invited::class];

    /**
     * 用户信息
     *
     * @return BelongsTo
     */
    public function user_info(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * 师父
     *
     * @return BelongsTo
     */
    public function parent_info(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'parent_id');
    }

    /**
     * 太师
     *
     * @return BelongsTo
     */
    public function grandfather_info(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'grandfather_id');
    }
}