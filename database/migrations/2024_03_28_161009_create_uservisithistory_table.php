<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUservisithistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uservisithistory', function (Blueprint $table) {
            $table->id();
            $table->string('users_id')->nullable();
            $table->string('username')->nullable();
            $table->string('userlocation')->nullable();
            $table->string('usercompany')->nullable();
            $table->string('useremail')->nullable();
            $table->string('nama_produk')->nullable();
            $table->string('filepath')->nullable();
            $table->timestamp('visited_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uservisithistory');
    }
}
