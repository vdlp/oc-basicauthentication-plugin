<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

final class CreateBasicAuthenticationTables extends Migration
{
    public function up(): void
    {
        Schema::create('vdlp_basic_authentication_credentials', static function (Blueprint $table): void {
            $table->engine = 'InnoDB';
            $table->increments('id')
                ->unsigned();
            $table->string('hostname');
            $table->string('realm');
            $table->string('username');
            $table->string('password');
            $table->boolean('is_enabled')
                ->default(false);
            $table->unique('hostname');
            $table->timestamps();
        });

        Schema::create('vdlp_basic_authentication_excluded_urls', static function (Blueprint $table): void {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('url');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vdlp_basic_authentication_credentials');
        Schema::dropIfExists('vdlp_basic_authentication_excluded_urls');
    }
}
