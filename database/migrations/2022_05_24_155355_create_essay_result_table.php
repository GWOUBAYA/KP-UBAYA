<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEssayResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('essay_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id', 'fk_254_user_user_id_essay_result')->references('id')->on('users');
            $table->string('correct')->nullable();
            $table->datetime('date')->nullable();
            $table->integer('essay_id')->unsigned()->nullable();
            $table->foreign('essay_id', 'fk_257_essay_essay_id_result')->references('id')->on('essays');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('essay_result');
    }
}
