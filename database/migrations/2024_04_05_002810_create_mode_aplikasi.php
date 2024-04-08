<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mode_aplikasi', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('user_id')->nullable();
            $table->string('email')->nullable();
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

        DB::table('mode_aplikasi')->insert([
            ['name'                         => 'Kelvin',
             'user_id'                      => 'ID_00001',
             'email'                        => 'kelvin.p2504@gmail.com',
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
            ],
            ['name'                         => 'Frizsa Dias',
             'user_id'                      => 'ID_00002',
             'email'                        => 'frizsadias20@gmail.com',
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
            ],
            ['name'                         => 'Bayu Saputra',
             'user_id'                      => 'ID_00003',
             'email'                        => 'bayusputra131@gmail.com',
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
        Schema::dropIfExists('mode_aplikasi');
    }
};