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
        Schema::create('logs', function (Blueprint $table){
            $table->id();
            $table->timestamp('timestamp');
            $table->string('method')->comment('Request Method');
            $table->text('url')->comment('request url');
            $table->integer('response_code')->comment('response code');
            $table->json('response_body')->nullable()->comment('response body');
            $table->float('request_time')->comment('request time in ms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
};
