<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class quiz_sequen extends Model
{
    use HasFactory,SoftDeletes;
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'next_quiz',
    ];
}
