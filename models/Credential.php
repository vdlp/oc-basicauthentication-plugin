<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Models;

use October\Rain\Database\Model;

final class Credential extends Model
{
    public $table = 'vdlp_basic_authentication_credentials';

    protected $fillable = [
        'hostname',
        'username',
        'password',
        'realm',
        'is_enabled',
    ];
}
