<?php
namespace Domain\User\Auth;

use Domain\User\User;
use Infrastructure\Model\AbstractModel as Model;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class AuthToken extends Model
{
    protected $table = 'user_auth_tokens';

    protected $fillable = [
        'user_id',
        'token',
        'expires_at',
    ];

    protected $dates = [
        'expires_at',
    ];

    protected $hidden = [
        'id',
        'user_id',
    ];

    /***************************************************************************
     * Relationships
     **************************************************************************/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsTo(User::class);
    }
}
