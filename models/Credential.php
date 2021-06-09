<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Models;

use October\Rain\Database\Model;

/**
 * Class Credential
 *
 * @package Vdlp\BasicAuthentication\Models
 */
class Credential extends Model
{
    /**
     * {@inheritdoc}
     */
    public $table = 'vdlp_basic_authentication_credentials';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'hostname',
        'username',
        'password',
        'realm',
        'is_enabled',
    ];
}
