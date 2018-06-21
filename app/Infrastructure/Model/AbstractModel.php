<?php
namespace Infrastructure\Model;

use DateTime;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
abstract class AbstractModel extends BaseModel
{
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(DateTime::ATOM);
    }
}
