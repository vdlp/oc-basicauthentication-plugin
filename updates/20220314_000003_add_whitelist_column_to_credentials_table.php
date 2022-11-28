<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

final class AddWhitelistColumnToCredentialsTable extends Migration
{
    public function up(): void
    {
        Schema::table('vdlp_basic_authentication_credentials', static function (Blueprint $table): void {
            $table->json('whitelist')
                ->nullable()
                ->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('vdlp_basic_authentication_credentials', static function (Blueprint $table): void {
            $table->dropColumn('whitelist');
        });
    }
}
