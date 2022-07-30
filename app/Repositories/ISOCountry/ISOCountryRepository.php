<?php

namespace App\Repositories\ISOCountry;

use App\Models\ISOCountry;

/**
 * @property ISOCountry $ISOCountry
 */
class ISOCountryRepository implements ISOCountryInterface
{
    public function __construct(ISOCountry $ISOCountry)
    {
        $this->ISOCountry = $ISOCountry;
    }

    public function getISO()
    {
        return $this->ISOCountry->getCountries();
    }
}
