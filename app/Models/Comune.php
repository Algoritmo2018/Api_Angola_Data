<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comune extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'municipality_id'
    ];
}
