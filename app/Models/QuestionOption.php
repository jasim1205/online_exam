<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionOption extends Model
{
    use HasFactory;
    protected $fillable = ['question_id', 'option', 'option_text'];

    public function question(){
        return $this->belongsTo(Question::class, 'question_id','id');
    }
    public function answer(){
        return $this->hasOne(AnswerSubmit::class,'option_id','id');
    }
}
