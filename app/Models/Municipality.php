<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'province_id'
    ];
}
