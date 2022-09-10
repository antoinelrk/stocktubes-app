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
        Schema::create('tubes', function (Blueprint $table) {
            $table->id();
            $table->string('reference')
                ->unique();
            $table->string('slug')
                ->unique();
            $table->bigInteger('user_id')
                ->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->integer('used')
                ->default(0);
            $table->integer('unused')
                ->default(0);
            $table->integer('warning')
                ->nullable()
                ->default(NULL);
            $table->integer('critical')
                ->nullable()
                ->default(NULL);
            $table->string('datasheet', 255)
                ->nullable()
                ->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tubes');
    }
};
