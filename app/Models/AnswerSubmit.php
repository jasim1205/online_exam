<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnswerSubmit extends Model
{
    use HasFactory,SoftDeletes;

    public function submission(){
        return $this->belongsTo(SubmissionTable::class,'submission_id','id');
    }
    public function question(){
        return $this->belongsTo(Question::class,'question_id','id');
    }
    public function option(){
        return $this->belongsTo(Option::class,'option_id','id');
    }

}
