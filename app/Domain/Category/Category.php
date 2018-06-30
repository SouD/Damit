<?php
namespace Domain\Category;

use Dimsav\Translatable\Translatable;
use Infrastructure\Model\AbstractModel as Model;
use Kalnoy\Nestedset\NodeTrait as Nodes;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class Category extends Model
{
    use Nodes, Translatable;

    protected $table = 'categories';

    protected $fillable = [
        'slug',
    ];

    protected $hidden = [
        'id',
        '_lft',
        '_rgt',
    ];

    /**
     * @var array
     */
    public $translatedAttributes = [
        'name',
    ];
}
