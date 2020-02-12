<?php

use Illuminate\Database\Seeder;
use App\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Student::create(
             [

               'nama'   => 'Anisa',//Nilai
               'jk'     =>'P'
             ]
        );


            for ($i=0; $i <59; $i++ ) {
                $jk = 'p' ;

                if($i > 10 ) {
                    $jk ='L' ;
                }

                Student::create(
             [

               'nama'   => 'Anisa-'.$i , //Nilai
               'jk'     => $jk
             ]
        );  

       }
    }
}
