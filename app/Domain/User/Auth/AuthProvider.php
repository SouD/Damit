<?php
namespace Domain\User\Auth;

use Domain\User\User;
use Infrastructure\Model\AbstractModel as Model;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class AuthProvider extends Model
{
    protected $table = 'user_auth_providers';

    protected $fillable = [
        'user_id',
        'provider',
        'provider_id',
    ];

    protected $hidden = [
        'id',
        'user_id',
        'provider_id',
    ];

    /***************************************************************************
     * Relationships
     **************************************************************************/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
