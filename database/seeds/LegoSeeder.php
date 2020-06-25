<?php

use Illuminate\Database\Seeder;
use App\Lego;

class LegoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Lego::class, 10)->create();
    }
}
