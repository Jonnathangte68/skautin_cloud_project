<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJobsToDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data', function (Blueprint $table) {
            $table->string('is_job')->nullable();
            $table->string('job_title')->nullable();
            $table->string('job_description')->nullable();
            $table->string('job_requirements')->nullable();
            $table->string('job_category')->nullable();
            $table->string('job_subcategory')->nullable();
            $table->string('job_country')->nullable();
            $table->string('job_state')->nullable();
            $table->string('job_city')->nullable();
            $table->string('job_type')->nullable();
            $table->string('job_level')->nullable();
            $table->timestamp('job_creation_time')->default(\DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data', function (Blueprint $table) {
            //
        });
    }
}
