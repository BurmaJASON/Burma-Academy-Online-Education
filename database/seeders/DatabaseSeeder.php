<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User database seeding
        User::factory(110)->create();
        User::factory(7)->create(['role' => 'admin']);

        //Categories data seeding
        $dataScience = Category::factory()->create(['name' => 'Data Science']);
        $business = Category::factory()->create(['name' => 'Business']);
        $computeScience = Category::factory()->create(['name' => 'Computer Science']);
        $personalDev = Category::factory()->create(['name' => 'Personal Development']);
        $informationTec = Category::factory()->create(['name' => 'Information Technology']);
        $health = Category::factory()->create(['name' => 'Health']);
        $socialScience = Category::factory()->create(['name' => 'Social Sciences']);
        $arts = Category::factory()->create(['name' => 'Arts and Humanities']);
        $language = Category::factory()->create(['name' => 'Language Learning']);



        // Admin who create courses
        $jack = User::factory()->create(['name' => 'Jack', 'user_name' => 'Jackey','email' => 'jack@gmail.com', 'role' => 'admin']);
        $erica = User::factory()->create(['name' => 'Erica', 'user_name' => 'Erica','email' => 'erica@gmail.com', 'role' => 'admin']);
        $jason = User::factory()->create(['name' => 'Jason', 'user_name' => 'Burma Jason', 'email' => 'burmajason@gmail.com', 'role' => 'admin']);


        // Course data seeding
        Course::factory(2)->create(['category_id' => $dataScience->id, 'user_id' => $jack->id]);
        Course::factory(4)->create(['category_id' => $dataScience->id, 'user_id' => $jason->id]);

        Course::factory(5)->create(['category_id' => $business->id, 'user_id' => $erica->id]);
        Course::factory(3)->create(['category_id' => $business->id, 'user_id' => $jack->id]);

        Course::factory(1)->create(['category_id' => $computeScience->id, 'user_id' => $erica->id]);
        Course::factory(1)->create(['category_id' => $computeScience->id, 'user_id' => $jack->id]);
        Course::factory(1)->create(['category_id' => $computeScience->id, 'user_id' => $jason->id]);

        Course::factory(3)->create(['category_id' => $personalDev->id, 'user_id' => $jack->id]);

        Course::factory(2)->create(['category_id' => $informationTec->id, 'user_id' => $jason->id]);

        Course::factory(1)->create(['category_id' => $health->id, 'user_id' => $erica->id]);

        Course::factory(1)->create(['category_id' => $socialScience->id, 'user_id' => $jack->id]);
        Course::factory(2)->create(['category_id' => $socialScience->id, 'user_id' => $jason->id]);

        Course::factory(1)->create(['category_id' => $arts->id, 'user_id' => $jason->id]);

        Course::factory(1)->create(['category_id' => $language->id, 'user_id' => $jack->id]);
        Course::factory(1)->create(['category_id' => $language->id, 'user_id' => $erica->id]);



















    }
}
