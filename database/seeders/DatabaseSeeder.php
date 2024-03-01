<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Feature;
use App\Models\Login;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Database\Factories\FeatureFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\Company::factory(50)->create();
        // $fake = \Faker\Factory::create();
        // School::factory(50)->create();
        // for ($i = 1; $i < 51; $i++) {
        //     for ($j = 1; $j < 1001; $j++) {
        //         Student::insert([
        //             'school_id' => $i,
        //             'name' => $fake->name,
        //             'father_name' => $fake->name,
        //             'mother_name' => $fake->name,
        //             'phone_number' => $fake->phoneNumber,
        //             'state' => $fake->state,
        //             'address' => $fake->address,
        //             'created_at' => now(),
        //             'updated_at' => now()
        //         ]);
        //     }
        // }

//        \App\Models\User::factory(20)->create();
//        \App\Models\Post::factory(5000)->create();
//        \App\Models\Product::factory(100)->create();


//        eloquent part 4 ----------------------------------------------------------------------------------------------

//        User::factory()->count(60)->create()->each(fn ($user) => $user->logins()
//        ->createMany(Login::factory()->count(500)->make()->toArray())
//        );


//        User::factory()->count(60)->create()->each(function($user) {
//            $user->logins()->createMany(Login::factory()->count(60)->make()->toArray());
//        });


        // eloquent part 5 ---------------------------------------------------------------------------------------------

        $users = User::factory()->count(250)->create();
//
//        Feature::factory()->count(60)->create()->each(function ($feature) use ($users){
//           $feature->comments()->createMany(
//               Comment::factory()->count(rand(1, 50))->make()->each(function ($comment) use ($users){
//                    $comment->user_id = $users->random()->id;
//               })->toArray()
//           );
//        });

        $this->call(RolesAndPermissionsSeeder::class);

    }
}
