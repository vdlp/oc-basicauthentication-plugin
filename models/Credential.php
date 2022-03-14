<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Hashable;
use October\Rain\Database\Traits\Purgeable;
use October\Rain\Database\Traits\Validation;

/**
 * @property int $id
 * @property string $hostname
 * @property string $username
 * @property string $password
 * @property string $password_confirmation
 * @property string $realm
 * @property bool $is_enabled
 * @property ?array $whitelist
 */
final class Credential extends Model
{
    use Hashable;
    use Purgeable;
    use Validation;

    public $table = 'vdlp_basic_authentication_credentials';

    public array $rules = [
        'hostname' => 'required|unique:vdlp_basic_authentication_credentials',
        'username' => 'required',
        'realm' => 'required',
        'password' => 'required:create|confirmed',
        'password_confirmation' => 'required_with:password',
    ];

    public array $attributeNames = [
        'hostname' => 'vdlp.basicauthentication::lang.input.hostname_label',
        'username' => 'vdlp.basicauthentication::lang.input.username_label',
        'realm' => 'vdlp.basicauthentication::lang.input.realm_label',
        'password' => 'vdlp.basicauthentication::lang.input.password_label',
        'password_confirmation' => 'vdlp.basicauthentication::lang.input.password_confirmation_label',
    ];

    public array $customMessages = [
        'hostname.unique' => 'vdlp.basicauthentication::lang.validation.hostname_unique',
    ];

    protected $fillable = [
        'hostname',
        'username',
        'password',
        'realm',
        'is_enabled',
    ];

    protected $jsonable = [
        'whitelist',
    ];

    /**
     * @var array List of attribute names which should be hashed using the Bcrypt hashing algorithm.
     */
    protected $hashable = [
        'password',
    ];

    /**
     * @var array List of attribute names which should not be saved to the database.
     */
    protected $purgeable = [
        'password_confirmation'
    ];

    /**
     * setPasswordAttribute protects the password from being reset to null
     */
    public function setPasswordAttribute(?string $value = null): void
    {
        if ($this->exists && empty($value)) {
            unset($this->attributes['password']);
        } else {
            $this->attributes['password'] = $value;
        }
    }
}
