<?php
namespace Domain\Category;

use Infrastructure\Model\AbstractModel as Model;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class CategoryTranslation extends Model
{
    protected $table = 'category_translations';

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'id',
        'category_id',
    ];
}
