<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAndAddRecruiterOrganizationDataTable extends Migration
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
            $table->string('org_name')->nullable();
            $table->string('org_website')->nullable();
            $table->string('org_phone')->nullable();
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
