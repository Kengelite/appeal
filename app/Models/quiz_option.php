<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class quiz_option extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name_option',
    ];
}