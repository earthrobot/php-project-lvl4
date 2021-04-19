<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTaskStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_statuses', function (Blueprint $table) {
            $table->bigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('task_statuses', 'created_by_id'))
        {
            Schema::table('task_statuses', function (Blueprint $table)
            {
                $table->dropColumn('created_by_id');
            });
        }
    }
}
