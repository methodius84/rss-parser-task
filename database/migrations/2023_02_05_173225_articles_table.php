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
        Schema::create('articles', function (Blueprint $table){
            $table->string('guid')->primary()->unique()->comment('GUID из RSS rbc.ru');
            $table->string('title')->comment('Название статьи');
            $table->text('text')->comment('Краткое описание');
            $table->dateTime('publish_date')->comment('Дата и время публикации');
            $table->string('author')->nullable()->comment('Автор статьи');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
