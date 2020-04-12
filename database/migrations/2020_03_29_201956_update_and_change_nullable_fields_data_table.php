<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAndChangeNullableFieldsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add recruiter organization fields
        Schema::table('data', function (Blueprint $table) {
            $table->string('criteria_age_range')->nullable()->change();
            $table->string('criteria_genre')->nullable()->change();
            $table->string('criteria_level')->nullable()->change();
            $table->string('level')->nullable()->change();
            $table->string('org_name')->nullable()->change();
            $table->string('org_website')->nullable()->change();
            $table->string('org_phone')->nullable()->change();
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
