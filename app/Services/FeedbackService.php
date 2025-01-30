<?php

namespace App\Services;

use GuzzleHttp\Client;

class FeedbackService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function summarizeFeedback(array $feedbackArray)
    {
        $maxRetries = 3; // Maximum number of retries
        $retryDelay = 5; // Delay between retries in seconds

        // Combine all feedback into a single string
        $feedbackText = implode(' ', $feedbackArray);

        for ($i = 0; $i < $maxRetries; $i++) {
            try {
                // Send request to Hugging Face Inference API
                $response = $this->client->post('https://api-inference.huggingface.co/models/facebook/bart-large-cnn', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . env('HUGGING_FACE_API_KEY'),
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        // 'inputs' => "Summarize this feedback, try to keep it simple and readable, if need be add more details: " . $feedbackText,
                        'inputs' => $feedbackText,
                        'parameters' => [
                            'max_length' => 200,
                            'min_length' => 100,
                        ],
                    ],
                ]);

                // Decode the response
                $responseBody = json_decode($response->getBody(), true);

                // Check if the model is still loading
                if (isset($responseBody['error']) && strpos($responseBody['error'], 'is currently loading') !== false) {
                    sleep($retryDelay); // Wait before retrying
                    continue;
                }

                // Check for other errors
                if (isset($responseBody['error'])) {
                    throw new \Exception($responseBody['error']);
                }

                // Extract the summary from the response
                return $responseBody[0]['summary_text'];
            } catch (\Exception $e) {
                // Handle errors
                return "Error summarizing feedback: " . $e->getMessage();
            }
        }

        return "Failed to summarize feedback after $maxRetries attempts.";
    }
}
