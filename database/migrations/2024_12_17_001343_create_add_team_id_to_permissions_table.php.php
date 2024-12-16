<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->foreignId('team_id')->nullable()->constrained()->cascadeOnDelete();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->foreignId('team_id')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropForeign(['team_id']);
            $table->dropColumn('team_id');
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->dropForeign(['team_id']);
            $table->dropColumn('team_id');
        });
    }
};
