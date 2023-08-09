<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('auth0')->nullable();
            $table->boolean('email_verified')->default(false);

            $table->unique('auth0', 'users_auth0_unique');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_auth0_unique');

            $table->dropColumn('auth0');
            $table->dropColumn('email_verified');
        });
    }
};
