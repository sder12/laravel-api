<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['FrontEnd', 'BackEnd', 'Devops', 'FullStack'];

        foreach ($types as $type) {
            //new
            $newType = new Type();
            //name
            $newType->name = $type;
            //slug
            $newType->slug = Str::slug($type);
            //save
            $newType->save();
        }
    }
}
