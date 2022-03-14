<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

final class DropExcludedUrlsTable extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('vdlp_basic_authentication_excluded_urls');
    }

    public function down(): void
    {
        Schema::create('vdlp_basic_authentication_excluded_urls', static function (Blueprint $table): void {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('url');
            $table->timestamps();
        });
    }
}
