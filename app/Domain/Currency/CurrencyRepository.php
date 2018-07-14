<?php
namespace Domain\Currency;

use Infrastructure\Repository\AbstractRepository as Repository;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class CurrencyRepository extends Repository
{
    public function __construct(string $model = Currency::class)
    {
        parent::__construct($model);
    }
}
