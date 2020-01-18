<?php

use Illuminate\Database\Seeder;
use App\Remarks;
class RemarksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Remarks::create(['remarks_desc' => 'Present']);
        Remarks::create(['remarks_desc' => 'No Teacher Around']);
        Remarks::create(['remarks_desc' => 'No Student and Teacher Around']);
        Remarks::create(['remarks_desc' => 'Fieldwork']);
        Remarks::create(['remarks_desc' => 'Research Subject/OJT']);
        Remarks::create(['remarks_desc' => 'On Leave w/ substitute']);
        Remarks::create(['remarks_desc' => 'Lab Schedule']);
        Remarks::create(['remarks_desc' => 'No Lab Schedule Yet']);
        Remarks::create(['remarks_desc' => 'At Lecture Room']);
        Remarks::create(['remarks_desc' => 'No Final Loading Yet']);
        Remarks::create(['remarks_desc' => 'No Allowed Faculty Yet']);
        Remarks::create(['remarks_desc' => 'At Labortary']);
    }
}
