<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Karate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrasi', function (Blueprint $table) {
            $table->bigIncrements('idregistrasi');
            $table->Integer('idhint');
            $table->String('jawaban');
            $table->String('email')->unique();
            $table->String('namaregistrasi');
            $table->String('password');
            $table->timestamps();
        });

        Schema::create('peserta', function (Blueprint $table) {
            $table->Integer('idpeserta')->primary();
            $table->String('namapeserta');
            $table->enum('jk', ['l', 'p']);
            $table->String('kontingen');
            $table->String('wa');
            $table->timestamps();
        });

        Schema::create('pertandingan', function (Blueprint $table) {
            $table->bigIncrements('idpertandingan');
            $table->Integer('idkelas');
            $table->Integer('idpeserta');
            $table->Integer('idlomba');
            $table->Integer('idbagian');
            $table->boolean('sah');
            $table->timestamps();
        });

        Schema::create('bagian', function (Blueprint $table) {
            $table->bigIncrements('idbagian');
            $table->enum('namabagian', ['putra', 'putri'])->unique();
            $table->timestamps();
        });

        $bagian = ['putra', 'putri'];
        foreach ($bagian as $bagian) {
            DB::table('bagian')->insert([
                'namabagian' => $bagian,
            ]);
        }

        Schema::create('lomba', function (Blueprint $table) {
            $table->bigIncrements('idlomba');
            $table->String('namalomba');
            $table->char('tahun', 4);
            $table->timestamps();
        });

        Schema::create('kelas', function (Blueprint $table) {
            $table->bigIncrements('idkelas');
            $table->String('namakelas');
            $table->timestamps();
        });

        Schema::create('hint', function (Blueprint $table) {
            $table->bigIncrements('idhint');
            $table->String('namahint');
            $table->timestamps();
        });

        $hint = [
            "What is your best friend's name?",
            "What is your teacher's name?",
            "What is your girlfriend's name?",
            "What's your parents name?",
        ];
        
        foreach ($hint as $hint) {
            DB::table('hint')->insert([
                'namahint' => $hint,
            ]);
        }

        $kelas = [
            'Kata Perorangan Usia Dini',
            'Kata Perorangan Prapemula',
            'Kata Perorangan Pemula',
            'Kata Perorangan Cadet',
            'Kata Perorangan Junior',
            'Kata Perorangan Under 21',
            'Kata Perorangan Senior',
            'Kata Beregu',
        ];

        foreach ($kelas as $kls) {
            DB::table('kelas')->insert([
                'namakelas'=> $kls,
            ]);
        }



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
