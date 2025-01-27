<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackApiController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::latest()->get();
        return response()->json($feedbacks);
    }
    public function store(Request $request)
    {
        $feedback = new Feedback();
        $feedback->rating = $request->rating;
        $feedback->message = $request->message;
        $feedback->save();
        return response()->json([
            'success' => true,
            'feedback' => $feedback
        ]);
    }
}
