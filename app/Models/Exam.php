<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the Exam
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classlist()
    {
        return $this->belongsTo(ClassList::class, 'class_id', 'id');
    }
    public function examtype()
    {
        return $this->belongsTo(ExamType::class, 'examtype_id', 'id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
    public function submission(){
        return $this->hasMany(SubmissionTable::class, 'exam_id','id');
    }
}
