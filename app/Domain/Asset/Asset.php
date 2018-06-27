<?php
namespace Domain\Asset;

use Infrastructure\Model\AbstractModel as Model;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class Asset extends Model
{
    protected $table = 'assets';

    protected $fillable = [
        'uri',
        'disk',
        'size',
        'original_name',
    ];

    protected $hidden = [
        'id',
    ];
}
