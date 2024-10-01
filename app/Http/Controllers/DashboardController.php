<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Exam;
use App\Models\User;
use App\Models\SubmissionTable;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if (fullAccess()) {
            $exam = Exam::count();
            $student = User::where('role_id',2)->count();
            $submit = SubmissionTable::count();
            return view('adminDashboard',compact('exam','student','submit'));
        } else {
            $user = User::find(currentUserId());
            $exam = Exam::where('class_id',$user->class_id)->count();
            $submit = SubmissionTable::where('user_id',currentUserId())->count();
            $total_marks = Exam::where('class_id',$user->class_id)->sum('total_marks');
            $total_obtain = SubmissionTable::where('user_id',currentUserId())->sum('total_obtain_marks');
            return view('dashboard',compact('user','exam','submit','total_marks','total_obtain'));
        }
    }
}