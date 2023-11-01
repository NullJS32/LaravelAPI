<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->id();
            $table->integer('rank');
            $table->string('name');
            $table->string('symbol');
            $table->string('slug');
            $table->boolean('is_active');
            $table->timestamp('first_historical_data');
            $table->timestamp('last_historical_data');
            $table->unsignedBigInteger('platform_id')->nullable();
            $table->timestamps();

            // Создаем внешний ключ для связи с таблицей платформ
            $table->foreign('platform_id')->references('id')->on('platforms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coins');
    }
}
