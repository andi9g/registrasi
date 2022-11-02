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
            $table->String('gambar');
            $table->timestamps();
        });

        Schema::create('pertandingan', function (Blueprint $table) {
            $table->bigIncrements('idpertandingan');
            $table->Integer('idkelas');
            $table->Integer('idpeserta');
            $table->enum('idbagian', ['l', 'p']);
            $table->Integer('idlomba');
            $table->boolean('sah');
            $table->timestamps();
        });

        Schema::create('penilaian', function (Blueprint $table) {
            $table->bigIncrements('idpenilaian');
            $table->Integer('idpesertatanding');
            $table->Integer('idjuri');
            $table->Integer('idlapangan');
            $table->Float('nt');
            $table->Float('na');
            $table->Integer('waktu');
            $table->timestamps();
        });

        Schema::create('juri', function (Blueprint $table) {
            $table->bigIncrements('idjuri');
            $table->String('username');
            $table->String('password');
            $table->String('password2');
            $table->Integer('idadmin');
            $table->Integer('posisi');
            $table->timestamps();
        });

        Schema::create('tanding', function (Blueprint $table) {
            $table->bigIncrements('idtanding');
            $table->String('idregu');
            $table->Integer('idadmin')->nullable();
            $table->Integer('idlapangan')->nullable();
            $table->boolean('waktu');
            $table->Integer('idkelas');
            $table->Integer('idbagian');
            $table->Integer('idlomba');
            $table->String('ket')->nullable();
            $table->timestamps();
        });

        Schema::create('pesertatanding', function (Blueprint $table) {
            $table->bigIncrements('idpesertatanding');
            $table->Integer('idtanding');
            $table->Integer('idpertandingan');
            $table->timestamps();
        });

        Schema::create('regu', function (Blueprint $table) {
            $table->bigIncrements('idregu');
            $table->String('namaregu');
            $table->timestamps();
        });

        $regu = ['Pool A1', 'Pool A2', 'Pool B1', 'Pool B2', 'Babak Penyisihan 2', 'Babak Perempat Final', 'Babak Pertiga Final', 'Final', 'Final Perebutan Juara 3'];
        
        foreach ($regu as $pool) {
            DB::table('regu')->insert([
                'namaregu' => $pool,
            ]);
        }
        

        Schema::create('lapangan', function (Blueprint $table) {
            $table->bigIncrements('idlapangan');
            $table->String('namalapangan');
            $table->timestamps();
        });
        $lapangan = ['Lapangan 1', 'Lapangan 2', 'Lapangan 3'];
        
        foreach ($lapangan as $lap) {
            DB::table('lapangan')->insert([
                'namalapangan' => $lap,
            ]);
        }

        Schema::create('dewanjuri', function (Blueprint $table) {
            $table->bigIncrements('iddewanjuri');
            $table->Integer('idjuri');
            $table->Integer('idkelas');
            $table->Integer('nojuri');
            $table->timestamps();
        });

        Schema::create('bagian', function (Blueprint $table) {
            $table->enum('idbagian', ['l', 'p'])->primary();
            $table->enum('namabagian', ['putra', 'putri'])->unique();
            $table->timestamps();
        });

        $bagian = ['putra-l', 'putri-p'];

        foreach ($bagian as $item) {
            $data = explode("-", $item);
            DB::table('bagian')->insert([
                'idbagian' => $data[1],
                'namabagian' => $data[0],
            ]);
        }

        Schema::create('lomba', function (Blueprint $table) {
            $table->bigIncrements('idlomba');
            $table->String('namalomba');
            $table->String('proposal');
            $table->dateTime('tanggalberkas');
            $table->String('tanggallomba');
            $table->dateTime('tanggaltutup');
            $table->String('akses')->nullable();
            $table->String('wa1')->nullable();
            $table->String('wa2')->nullable();
            $table->char('tahun', 4);
            $table->boolean('ket');
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
