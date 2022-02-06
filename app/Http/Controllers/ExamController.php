<?php

namespace App\Http\Controllers;

use App\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function retrieve(Request $request)
    {
        return Exam::get();
    }
}
