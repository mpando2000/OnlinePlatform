<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'image_path' => 'images/IMG16.jpg',
                'caption' => 'The teacher is guiding their students around a table, explaining the task at hand with clear instructions.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'image_path' => 'images/IMG3.jpg',
                'caption' => 'The students are engaged in a practical session of dissecting a rat. They are gathered around lab tables, wearing protective gear such as gloves and lab coats for safety.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'image_path' => 'images/IMG15.jpg',
                'caption' => 'Kawawa JKT School is located in a serene environment, providing a conducive atmosphere for learning',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'image_path' => 'images/IMG9.jpg',
                'caption' => 'The school offers a comfortable and well-maintained environment for boarding students, with clean and secure hostels.',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'image_path' => 'images/IMG2.jpg',
                'caption' => 'The students are lined up on the parade ground, standing in neat rows and columns, dressed in their school uniforms.',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'image_path' => 'images/IMG6.jpg',
                'caption' => 'A group of students is in a garden, watering vegetables. They are working together, carefully tending to the plants, ensuring each one gets enough water.',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'image_path' => 'images/IMG17.jpg',
                'caption' => 'A group of students is in a garden, watering vegetables. They are working together, carefully tending to the plants, ensuring each one gets enough water.',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'image_path' => 'images/slider1.jpeg',
                'caption' => 'Future innovators at work, exploring practical science and technology',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'image_path' => 'images/slider2.jpeg',
                'caption' => 'Active learning in progress. Every lesson brings them one step closer to their dreams',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'image_path' => 'images/slider3.jpeg',
                'caption' => 'Young leaders growing together confidence, discipline, and excellence.',
                'order' => 10,
                'is_active' => true,
            ],
            [
                'image_path' => 'images/slider4.jpeg',
                'caption' => 'An image showing buildings of one of the schools',
                'order' => 11,
                'is_active' => true,
            ],
            [
                'image_path' => 'images/slider5.jpeg',
                'caption' => 'Where curiosity meets opportunity the journey to success starts here.',
                'order' => 12,
                'is_active' => true,
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
}
