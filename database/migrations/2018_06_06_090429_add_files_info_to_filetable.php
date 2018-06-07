<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFilesInfoToFiletable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files',function($table)
        { 
           $table->string('file_name');
           $table->integer('file_size');
           $table->string('file_extention');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('files',function($table)
        { 
           $table->dropColumn('file_name');
           $table->dropColumn('file_size');
           $table->dropColumn('file_extention');

        });
    }
}
