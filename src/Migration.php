<?php

require "vendor/autoload.php";
require "src/DB.php";

if ($capsule->schema()->hasTable('students')) {
    $capsule->schema()->create('students', function($table) {
        $table->increments('student_id');
        $table->string('first_name');
        $table->string('last_name');
        $table->primary(['first_name', 'last_name']);
        
    });

    $capsule->schema()->create('attendance_marks', function($table) {
        $table->increments('attendance_mark_id');
        $table->string('mark');
    });

    $capsule->schema()->create('attendance', function($table) {
        $table->increments('attendance_id');
        $table->integer('student_id')->unsigned();
        $table->integer('attendance_mark_id')->unsigned();
        $table->dateTime('created_at');
        $table->date('logged_at');
        $table->foreign('student_id')
            ->references('student_id')->on('students')
            ->onDelete('cascade');

        $table->foreign('attendance_mark_id')
            ->references('attendance_mark_id')->on('attendance_marks')
            ->onDelete('cascade');
        $table->primary(['student_id', 'created_at']);
    });

    $faker = Faker\Factory::create();

    $capsule->table('attendance_marks')->insert([
        ['mark' => 'Present'],
        ['mark' => 'Absent'],
        ['mark' => 'Tardy']
    ]);
/*
    $students = [];
    for($i=0; $i<10; $i++) {
        $students[] = ['first_name' => $faker->firstName(), 'last_name' => $faker->lastName()];
    }

    $capsule->table('students')->insert($students);
    
    $attendance = [];
    for($i=1; $i<=10; $i++) {
        $attendance[] = [
            'student_id' => $i,
            'attendance_mark_id' => $faker->numberBetween(1,3),
            'created_at' => $faker->date(),
            'logged_at' => $faker->dateTime()
        ];
    }
    $capsule->table('attendance')->insert([
        ['student_id' => 1, 'attendance_mark_id' => '1']
    ]);
*/
}
