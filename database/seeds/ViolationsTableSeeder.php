<?php

use Illuminate\Database\Seeder;
use App\Violation;
class ViolationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        Violation::create(['violation_details' => 'Not Wearing ID']);
        Violation::create(['violation_details' => 'Not Wearing Uniform']);
        Violation::create(['violation_details' => 'Not Wearing Prescribed Uniform']);
        Violation::create(['violation_details' => 'Wearing Maong Pants']);
        Violation::create(['violation_details' => 'Not Weaing Presscribed Footwear']);
    }
}
