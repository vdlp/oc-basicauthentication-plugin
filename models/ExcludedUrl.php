<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Models;

use Eloquent;
use October\Rain\Database\Model;

/** @noinspection ClassOverridesFieldOfSuperClassInspection */
/** @noinspection LongInheritanceChainInspection */

/**
 * Class ExcludedUrl
 *
 * @package Vdlp\BasicAuthentication\Models
 * @mixin Eloquent
 */
class ExcludedUrl extends Model
{
    /**
     * {@inheritdoc}
     */
    public $table = 'vdlp_basic_authentication_excluded_urls';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'url',
    ];
}
