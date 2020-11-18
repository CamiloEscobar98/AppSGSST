<?php

use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Topic::class, 10)->create()
            ->each(function ($topic) {
                $topic->image()->create([
                    'image' => 'default.png',
                    'url' => 'storage/images/topics'
                ]);
            });
    }
}
