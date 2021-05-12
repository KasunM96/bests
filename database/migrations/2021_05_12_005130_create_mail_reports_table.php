<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_reports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('to');
            $table->integer('from');
            $table->string('subject');
            $table->string('message');
            $table->integer('s_id');
            $table->string('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_reports');
    }
}
