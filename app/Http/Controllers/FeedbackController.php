<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Services\FeedbackService;

class FeedbackController extends Controller
{
    protected $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    public function index()
    {
        $feedbacks = Feedback::latest()->get();
        return view('feedbacks.index', compact('feedbacks'));
    }

    public function summarize()
    {
        $feedbacks = Feedback::latest()->limit(50)->get();

        $ratings = $feedbacks->pluck('rating')->toArray(); // Assuming 'rating' is the column name
        $messages = $feedbacks->pluck('message')->toArray(); // Assuming 'message' is the column name

        // Calculate rating distribution
        $ratingDistribution = array_count_values($ratings); // Count occurrences of each rating

        // Ensure all ratings (1 to 5) are included, even if count is 0
        $ratingDistribution = array_replace([1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0], $ratingDistribution);

        // Get the summary
        $summary = $this->feedbackService->summarizeFeedback($messages);

        // Return the summary (or use it as needed)
        return response()->json([
            'summary' => $summary,
            'ratingDistribution' => $ratingDistribution,
        ]);
    }
}
