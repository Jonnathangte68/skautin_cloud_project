<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersToConversationThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conversation_thread', function (Blueprint $table) {
            $table->string('user_a')->nullable();
            $table->string('user_b')->nullable();
            $table->string('user_c')->nullable();
            $table->string('user_d')->nullable();
            $table->string('user_e')->nullable();
            $table->string('user_f')->nullable();
        });
    }
}
