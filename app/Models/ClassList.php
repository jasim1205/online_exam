<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassList extends Model
{
    use HasFactory , SoftDeletes;

    /**
     * Get all of the exam for the ClassList
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exam(): HasMany
    {
        return $this->hasMany(Exam::class, 'exam_id', 'id');
    }

    public function user(){
        return $this->hasMany(User::class,'class_id','id');
    }
}
