<?php
namespace Domain\User\Role;

use Domain\User\User;
use Infrastructure\Model\AbstractModel as Model;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class Role extends Model
{
    protected $table = 'user_roles';

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'id',
        'pivot',
    ];

    /***************************************************************************
     * Relationships
     **************************************************************************/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
