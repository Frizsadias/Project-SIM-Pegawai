<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user_id');
            $table->string('email')->unique();
            $table->string('join_date');
            $table->string('status')->nullable();
            $table->string('role_name')->nullable();
            $table->string('avatar')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            ['name' => 'Kelvin',
             'user_id' => 'ID_00001',
             'email' => 'kelvin.p2504@gmail.com',
             'join_date' => now()->toDayDateTimeString(),
             'status' => 'Active',
             'role_name' => 'Admin',
             'avatar' => 'photo_defaults.jpg',
             'password' => Hash::make('Kelvin.P980425'),
             'created_at' => now(),
             'updated_at' => now()
            ],
            ['name' => 'Frizsa Dias',
             'user_id' => 'ID_00002',
             'email' => 'frizsadias20@gmail.com',
             'join_date' => now()->toDayDateTimeString(),
             'status' => 'Active',
             'role_name' => 'Admin',
             'avatar' => 'photo_defaults.jpg',
             'password' => Hash::make('12345678'),
             'created_at' => now(),
             'updated_at' => now()
            ]
        ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
