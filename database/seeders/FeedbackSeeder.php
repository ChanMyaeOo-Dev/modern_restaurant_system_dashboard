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
            "The product is great, but delivery was late.",
            "Excellent customer service!",
            "The quality could be better.",
            "Very satisfied with the purchase.",
            "The product arrived damaged.",
            "Fast shipping and great packaging.",
            "The item was not as described.",
            "Highly recommend this product!",
            "The customer support team was very helpful.",
            "The product stopped working after a week.",
            "Great value for the price.",
            "The delivery was delayed by 3 days.",
            "The instructions were unclear.",
            "The packaging was eco-friendly, which I appreciate.",
            "The product is too expensive for what it offers.",
            "The item was out of stock, but I was notified quickly.",
            "The product is durable and long-lasting.",
            "The delivery person was rude.",
            "The product is perfect for my needs.",
            "The website was easy to navigate.",
            "The product broke after the first use.",
            "The customer service team resolved my issue quickly.",
            "The product is not worth the price.",
            "The delivery was faster than expected.",
            "The product is lightweight and easy to use.",
            "The item was missing parts.",
            "The product is exactly what I was looking for.",
            "The return process was hassle-free.",
            "The product is overpriced.",
            "The delivery was on time, but the packaging was damaged.",
            "The product is user-friendly.",
            "The customer service team was unresponsive.",
            "The product is of high quality.",
            "The item was delivered to the wrong address.",
            "The product is versatile and functional.",
            "The delivery was delayed due to weather conditions.",
            "The product is not suitable for my needs.",
            "The customer service team was very polite.",
            "The product is worth every penny.",
            "The item was defective upon arrival.",
            "The product is easy to assemble.",
            "The delivery was delayed without any notification.",
            "The product is stylish and modern.",
            "The customer service team was not helpful.",
            "The product is reliable and efficient.",
            "The item was not in the color I ordered.",
            "The product is comfortable to use.",
            "The delivery was quick and efficient.",
            "The product is not durable.",
            "The customer service team went above and beyond.",
            "The product is too complicated to use.",
            "The item was delivered on time and in perfect condition.",
            "The product is energy-efficient.",
            "The delivery was delayed due to a shipping error.",
            "The product is not as advertised.",
            "The customer service team was very professional.",
            "The product is easy to clean.",
            "The item was missing from the package.",
            "The product is innovative and well-designed.",
            "The delivery was delayed by a week.",
            "The product is not suitable for heavy use.",
            "The customer service team was very understanding.",
            "The product is compact and space-saving.",
            "The item was damaged during shipping.",
            "The product is perfect for everyday use.",
            "The delivery was delayed due to high demand.",
            "The product is not compatible with other devices.",
            "The customer service team was very patient.",
            "The product is well-packaged and secure.",
            "The item was not the size I expected.",
            "The product is easy to operate.",
            "The delivery was delayed due to a holiday.",
            "The product is not environmentally friendly.",
            "The customer service team was very knowledgeable.",
            "The product is great for beginners.",
            "The item was not in stock as advertised.",
            "The product is easy to maintain.",
            "The delivery was delayed due to a technical issue.",
            "The product is not suitable for children.",
            "The customer service team was very friendly.",
            "The product is great for professional use.",
            "The item was not as durable as expected.",
            "The product is easy to store.",
            "The delivery was delayed due to a customs issue.",
            "The product is not suitable for outdoor use.",
            "The customer service team was very efficient.",
            "The product is great for small spaces.",
            "The item was not the model I ordered.",
            "The product is easy to transport.",
            "The delivery was delayed due to a strike.",
            "The product is not suitable for large families.",
            "The customer service team was very accommodating.",
            "The product is great for travel.",
            "The item was not the brand I expected.",
            "The product is easy to install.",
            "The delivery was delayed due to a natural disaster.",
            "The product is not suitable for long-term use.",
            "The customer service team was very responsive.",
            "The product is great for beginners and experts alike.",
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
