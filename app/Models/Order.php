<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = ['location','size','weight','status','pickup_time','delivery_time','user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
