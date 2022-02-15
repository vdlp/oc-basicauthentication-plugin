<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Models;

use October\Rain\Database\Model;

/**
 * @property int $id
 * @property string $url
 */
final class ExcludedUrl extends Model
{
    public $table = 'vdlp_basic_authentication_excluded_urls';

    protected $fillable = [
        'url',
    ];
}
