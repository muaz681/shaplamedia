<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnToMediaEntity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * php artisan make:migration add_more_column_to_media_entity  --table=media_entity
     */

    public function up()
    {
        Schema::table('media_entity', function (Blueprint $table) {
            $table->string('character_name')->nullable()->after('role_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media_entity', function (Blueprint $table) {
            $table->dropColumn(['character_name']);
        });
    }
}
