<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_tasks', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->string('title');
            $table->tinyInteger('is_done');
            $table->unsignedBigInteger('todo_list_id')->nullable()->index();
            $table->foreign('todo_list_id')->references('id')->on('todo_lists');
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
        Schema::dropIfExists('todo_tasks');
    }
}
