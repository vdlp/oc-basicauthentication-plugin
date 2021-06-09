<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Models;

use October\Rain\Database\Model;

/**
 * Class ExcludedUrl
 *
 * @package Vdlp\BasicAuthentication\Models
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
