<?php

namespace App\Controllers;

use App\Models\Country;

class CountryController
{
    public function index()
    {
        $countries = new Country();
        return json_encode($countries->getAll());
    }
}