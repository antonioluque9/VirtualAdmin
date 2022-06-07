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
        Schema::create('virtualhosts', function (Blueprint $table) {
            $table->id();
            $table->string('server');
            $table->string('servername');
            $table->string('virtualhost');
            $table->string('username');
            $table->string('description');
            $table->string('type');
            $table->string('parent')->nullable();
            $table->string('real_domain')->nullable();
            $table->string('phpversion')->nullable();

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
        Schema::dropIfExists('virtualhosts');
    }
};
