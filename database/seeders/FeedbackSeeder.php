<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $feedbackArray = [
            "Excellent service! The staff was very friendly and helpful.",
            "The product arrived on time and in perfect condition.",
            "I’ve been a customer for years, and I’ve never been disappointed.",
            "The product is a game-changer. It has made my life so much easier.",
            "The team was very accommodating with my special request.",
            "The product is lightweight and easy to use. Perfect for my needs.",
            "I received a personalized thank-you note with my order. A nice touch!",
            "The product is versatile and can be used in many ways.",
            "The company has a great return policy, which gives me peace of mind.",
            "The product is a great value for the price. Highly recommend!",
            "The company offers no discounts or loyalty rewards.",
            "The product takes up too much space. Not practical.",
            "I had a terrible experience from start to finish. Will not recommend!",
            "The product is not suitable for my needs. Very unhappy!",
            "The company ignores feedback and doesn’t improve.",
            "The product is a waste of money. I regret buying it.",
            "The delivery was slow, and the product is low-quality.",
            "The company has a bad reputation, and now I know why.",
            "The product is confusing and not user-friendly.",
            "The company provides no after-sales support.",
            "The product is flimsy and broke after one use. Very unhappy!",
            "The company is unreliable. I won’t trust them again.",
            "The product is a waste of space. I don’t like it at all."
        ];

        foreach ($feedbackArray as $feedback) {
            Feedback::create([
                'rating' => fake()->numberBetween(1, 5),
                'message' => $feedback,
            ]);
        }

        // php artisan db:seed --class=FeedbackSeeder
    }
}
