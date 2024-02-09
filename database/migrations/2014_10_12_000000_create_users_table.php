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
            $table->string('nip')->nullable();
            $table->string('no_dokumen')->nullable();
            $table->string('join_date');
            $table->string('status')->nullable();
            $table->string('role_name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('ruangan')->nullable();
            $table->string('jenis_jabatan')->nullable();
            $table->string('eselon')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('tema_aplikasi')->nullable();
            $table->string('warna_sistem')->nullable();
            $table->string('warna_sistem_tulisan')->nullable();
            $table->string('warna_mode')->nullable();
            $table->string('tabel_warna')->nullable();
            $table->string('tabel_tulisan_tersembunyi')->nullable();
            $table->string('warna_dropdown_menu')->nullable();
            $table->string('ikon_plugin')->nullable();
            $table->string('bayangan_kotak_header')->nullable();
            $table->string('warna_mode_2')->nullable();
            $table->timestamps();
        });

        DB::table('users')->insert([
            ['name'                         => 'Kelvin',
             'user_id'                      => 'ID_00001',
             'email'                        => 'kelvin.p2504@gmail.com',
             'nip'                          => '1905102006',
             'no_dokumen'                   => NULL,
             'join_date'                    => now()->toDayDateTimeString(),
             'status'                       => 'Active',
             'role_name'                    => 'Admin',
             'avatar'                       => 'photo_defaults.jpg',
             'ruangan'                      => NULL,
             'jenis_jabatan'                => 'Developer',
             'eselon'                       => NULL,
             'password'                     => Hash::make('Kelvin.P980425'),
             'tema_aplikasi'                => 'Terang',
             'warna_sistem'                 => NULL,
             'warna_sistem_tulisan'         => NULL,
             'warna_mode'                   => NULL,
             'tabel_warna'                  => NULL,
             'tabel_tulisan_tersembunyi'    => NULL,
             'warna_dropdown_menu'          => NULL,
             'ikon_plugin'                  => NULL,
             'bayangan_kotak_header'        => NULL,
             'warna_mode_2'                 => NULL,
             'created_at' => now(),
             'updated_at' => now()
            ],
            ['name'                         => 'Frizsa Dias',
             'user_id'                      => 'ID_00002',
             'email'                        => 'frizsadias20@gmail.com',
             'nip'                          => '1905101051',
             'no_dokumen'                   => NULL,
             'join_date'                    => now()->toDayDateTimeString(),
             'status'                       => 'Active',
             'role_name'                    => 'Admin',
             'avatar'                       => 'photo_defaults.jpg',
             'ruangan'                      => NULL,
             'jenis_jabatan'                => 'Developer',
             'eselon'                       => NULL,
             'password'                     => Hash::make('123456789'),
             'tema_aplikasi'                => 'Terang',
             'warna_sistem'                 => NULL,
             'warna_sistem_tulisan'         => NULL,
             'warna_mode'                   => NULL,
             'tabel_warna'                  => NULL,
             'tabel_tulisan_tersembunyi'    => NULL,
             'warna_dropdown_menu'          => NULL,
             'ikon_plugin'                  => NULL,
             'bayangan_kotak_header'        => NULL,
             'warna_mode_2'                 => NULL,
             'created_at' => now(),
             'updated_at' => now()
            ],
            ['name'                         => 'Bayu Saputra',
             'user_id'                      => 'ID_00003',
             'email'                        => 'bayusputra131@gmail.com',
             'nip'                          => '2105102003',
             'no_dokumen'                   => NULL,
             'join_date'                    => now()->toDayDateTimeString(),
             'status'                       => 'Active',
             'role_name'                    => 'Admin',
             'avatar'                       => 'photo_defaults.jpg',
             'ruangan'                      => NULL,
             'jenis_jabatan'                => 'Developer',
             'eselon'                       => NULL,
             'password'                     => Hash::make('123456789'),
             'tema_aplikasi'                => 'Terang',
             'warna_sistem'                 => NULL,
             'warna_sistem_tulisan'         => NULL,
             'warna_mode'                   => NULL,
             'tabel_warna'                  => NULL,
             'tabel_tulisan_tersembunyi'    => NULL,
             'warna_dropdown_menu'          => NULL,
             'ikon_plugin'                  => NULL,
             'bayangan_kotak_header'        => NULL,
             'warna_mode_2'                 => NULL,
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
