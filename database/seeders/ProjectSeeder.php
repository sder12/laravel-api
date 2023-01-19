<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//use Faker\Generator as Faker;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker = Faker::create('it_IT');
        for ($i = 0; $i < 20; $i++) {
            //NEW
            $project = new Project();
            //title
            $project->title = $faker->sentence(4);
            //description
            $project->description = $faker->text(400);
            //creation_year
            $project->creation_year = $faker->year();
            //slug
            $project->slug = Project::generateSlug($project->title);
            //SAVE
            $project->save();
        }
    }
}
