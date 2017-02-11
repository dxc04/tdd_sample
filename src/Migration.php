<?php

require "vendor/autoload.php";
require "src/DB.php";

$capsule->schema()->create('students', function($table) {
    $table->increments('student_id');
    $table->string('first_name');
    $table->string('last_name');
    
});

$capsule->schema()->create('attendance', function($table) {
    $table->increments('attendance_id');
    $table->string('status');
    $table->timestamp('created_at');
    $table->integer('student_id')->unsigned();
    $table->foreign('student_id')
        ->references('student_id')->on('students')
        ->onDelete('cascade');
});

$capsule->table('students')->insert([
    ['first_name' => 'John', 'last_name' => 'Smith'],
    ['first_name' => 'John', 'last_name' => 'Snow']
]);
