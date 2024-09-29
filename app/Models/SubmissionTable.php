<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionTable extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function exam(){
        return $this->belongsTo(Exam::class,'exam_id','id');
    }
    public function answer(){
        return $this->hasMany(AnswerSubmit::class,'submission_id','id');
    }

}
