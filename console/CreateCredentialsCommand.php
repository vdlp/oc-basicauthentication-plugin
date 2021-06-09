<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Console;

use Illuminate\Console\Command;
use Throwable;
use Vdlp\BasicAuthentication\Models\Credential;

final class CreateCredentialsCommand extends Command
{
    public function __construct()
    {
        $this->signature = 'vdlp:basicauthentication:create-credentials {hostname} {realm} {username} {password}';
        $this->description = 'Create Basic Authentication credentials.';

        parent::__construct();
    }

    public function handle(): void
    {
        try {
            Credential::query()
                ->updateOrInsert([
                    'hostname' => $this->argument('hostname'),
                ], [
                    'realm' => $this->argument('realm'),
                    'username' => $this->argument('username'),
                    'password' => $this->argument('password'),
                    'is_enabled' => true,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]);

            $this->info('Basic Authentication credentials have been added to the database.');
        } catch (Throwable $e) {
            $this->error('Could not create Basic Authentication credentials: ' . $e->getMessage());
        }
    }
}
