<?php

namespace App\controllers;

use App\models\Country;

class CountryController
{
    public function index()
    {
        $countries = new Country();
        return json_encode($countries->getAll());
    }
}