<?php
namespace Domain\User;

use Domain\User\Auth\AuthProvider;
use Domain\User\Role\Role;
use Domain\User\Role\RoleName;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Model\AbstractModel as Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, JWTSubject
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'email',
        'password',
        'logins',
        'last_login_at',
    ];

    protected $dates = [
        'last_login_at',
        'deleted_at',
    ];

    protected $hidden = [
        'id',
        'password',
        'authProviders',
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

    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
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
