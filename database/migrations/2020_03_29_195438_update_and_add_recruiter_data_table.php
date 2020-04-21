<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAndAddRecruiterDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add recruiter fields
        Schema::table('data', function (Blueprint $table) {
            $table->json('criteria_age_range')->nullable();
            $table->json('criteria_genre')->nullable();
            $table->json('criteria_level')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
