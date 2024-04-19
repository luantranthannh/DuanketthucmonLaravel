<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToMessageContactsTable extends Migration
{
    public function up()
    {
        Schema::table('message_contacts', function (Blueprint $table) {
            $table->string('status')->default('0');
        });
    }

    public function down()
    {
        Schema::table('message_contacts', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
