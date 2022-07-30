<?php

namespace App\Http\Controllers;

use App\Repositories\ISOCountry\ISOCountryInterface;
use Illuminate\Http\Request;

/**
 * @property ISOCountryInterface $ISOCountry
 */
class ISOCountriesController extends Controller
{
    public function __construct(ISOCountryInterface $ISOCountry)
    {
        $this->ISOCountry = $ISOCountry;
    }

    public function getISOCountries()
    {
        return $this->ISOCountry->getISO();
    }
}
