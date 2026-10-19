<?php

namespace App\Http\Controllers;

class SampleController extends Controller
{
    public $course = 'BSIT';

    public function index()
    {
        $student = 'Mark';
        $message = "Hello, World, $student";

        return response()->json([
            'student' => $student,
            'message' => $message,
            'course' => $this->course,
        ]);
    }

    public function read()
    {
        $greetingsName = $this->greet('Mark');

        return response()->json([
            'course' => $this->course,
            'greetings' => $greetingsName,
        ]);

    }

    public function greet($name)
    {
        return response()->json([
            'message' => "Hello, $name!",
        ]);
    }
}
