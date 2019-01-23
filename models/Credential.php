<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Models;

use Eloquent;
use October\Rain\Database\Model;

/** @noinspection ClassOverridesFieldOfSuperClassInspection */
/** @noinspection LongInheritanceChainInspection */

/**
 * Class Credential
 *
 * @package Vdlp\BasicAuthentication\Models
 * @mixin Eloquent
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
