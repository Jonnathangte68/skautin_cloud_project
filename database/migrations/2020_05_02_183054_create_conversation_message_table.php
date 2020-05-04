<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversation_message', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('thread_id')->nullable();
            $table->string('sender')->nullable();
            $table->string('receiver')->nullable();
            $table->text('content')->nullable();
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
        Schema::dropIfExists('conversation_message');
    }
}
