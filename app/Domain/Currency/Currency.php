<?php
namespace Domain\Currency;

use Infrastructure\Model\AbstractModel as Model;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class Currency extends Model
{
    protected $table = 'currencies';

    protected $fillable = [
        'code',
        'symbol',
        'factor',
        'decimals',
    ];

    protected $hidden = [
        'id',
    ];
}
