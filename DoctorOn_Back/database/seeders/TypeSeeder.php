<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
            'id' => 1,
            'type' => 'USER'
        ]);

        Type::create([
            'id' => 2,
            'type' => 'ADMIN UNIT'
        ]);

        Type::create([
            'id' => 3,
            'type' => 'ADMIN'
        ]);
    }
}
