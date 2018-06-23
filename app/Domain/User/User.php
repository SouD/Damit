<?php
namespace Domain\User;

use Domain\User\Auth\AuthProvider;
use Domain\User\Auth\AuthToken;
use Domain\User\Role\Role;
use Domain\User\Role\RoleName;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Model\AbstractModel as BaseModel;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class User extends BaseModel implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'email',
        'password',
    ];

    protected $dates = [
        'deleted_at',
    ];

    protected $hidden = [
        'id',
        'password',
        'authProviders',
        'authTokens',
    ];

    protected $appends = [
        'is_admin',
    ];

    /**
     * @param string $role
     *
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->roles->where('name', $role)
            ->count() > 0;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(RoleName::ADMIN);
    }

    /***************************************************************************
     * Relationships
     **************************************************************************/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function authProviders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AuthProvider::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function authTokens(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AuthToken::class);
    }

    /**
     * @return AuthToken|null
     */
    public function newestAuthToken(): ?AuthToken
    {
        return $this->authTokens()
            ->orderBy('created_at', 'desc')
            ->first();
    }

    /***************************************************************************
     * Mutators
     **************************************************************************/

    /**
     * @param string|null $password
     */
    public function setPasswordAttribute(string $password = null)
    {
        $this->attributes['password'] = $password ? Hash::make($password) : null;
    }

    /**
     * @return bool
     */
    public function getIsAdminAttribute(): bool
    {
        return $this->isAdmin();
    }
}
