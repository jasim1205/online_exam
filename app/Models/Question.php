<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;

    public function option(){
        return $this->hasMany(QuestionOption::class, 'question_id','id');
    }
    public function answer(){
        return $this->hasOne(AnswerSubmit::class,'question_id','id');
    }
}
