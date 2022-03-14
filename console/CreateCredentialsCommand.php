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

    public function handle(): int
    {
        $exists = Credential::query()
            ->where('hostname', $this->argument('hostname'))
            ->exists();

        if ($exists) {
            $this->error('Hostname already exists.');

            return 1;
        }

        try {
            $credential = new Credential([
                'hostname' => $this->argument('hostname'),
                'realm' => $this->argument('realm'),
                'username' => $this->argument('username'),
                'password' => $this->argument('password'),
                'is_enabled' => true,
                'updated_at' => now(),
                'created_at' => now(),
            ]);

            $credential->forceSave();
        } catch (Throwable $throwable) {
            $this->error('Could not create Basic Authentication credentials: ' . $throwable->getMessage());

            return 2;
        }

        $this->info('Basic Authentication credentials have been added to the database.');

        return 0;
    }
}
