<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory,SoftDeletes;


    public function exam(): HasMany
    {
        return $this->hasMany(Exam::class, 'exam_id', 'id');
    }
}
