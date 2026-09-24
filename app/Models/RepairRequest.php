<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairRequest extends Model
{
    protected $fillable = [
        'requester_name',
        'title',
        'category',
        'location',
        'description',
        'image',
        'status',
        'repair_result',
    ];
}
