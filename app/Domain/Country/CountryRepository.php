<?php
namespace Domain\Country;

use Infrastructure\Repository\AbstractRepository as Repository;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class CountryRepository extends Repository
{
    public function __construct(string $model = Country::class)
    {
        parent::__construct($model);
    }
}
