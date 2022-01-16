<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'Admin'
            ],
            [
                'id' => 2,
                'name' => 'Moderator'
            ],
            [
                'id' => 3,
                'name' => 'User'
            ],
            [
                'id' => 4,
                'name' => 'Client'
            ]
        ]);
    }
}
