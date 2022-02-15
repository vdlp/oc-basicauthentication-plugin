<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Models;

use October\Rain\Database\Model;

/**
 * @property int $id
 * @property string $hostname
 * @property string $username
 * @property string $password
 * @property string $realm
 * @property bool $is_enabled
 */
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
