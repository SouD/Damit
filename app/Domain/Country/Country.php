<?php
namespace Domain\Country;

use Infrastructure\Model\AbstractModel as Model;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'code',
        'shipping_enabled',
    ];

    protected $hidden = [
        'id',
    ];

    protected $appends = [
        'name',
    ];

    /**
     * @return bool
     */
    public function getShippingEnabledAttribute(): bool
    {
        return (bool) $this->attributes['shipping_enabled'];
    }

    /**
     * @return string
     */
    public function getNameAttribute(): string
    {
        return trans('country.code.' . $this->code);
    }
}
