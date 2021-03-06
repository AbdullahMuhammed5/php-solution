<?php

namespace App\Controllers;

use App\Models\Customer;

class CustomerController
{
    public function index()
    {
        $customer = new Customer();
        $customers = $customer->getAll();

        if (isset($_GET['country_code']) && $_GET['country_code'] !== "") {
            $customers = $customer->findWhereLike($_GET['country_code']);
        }

        if (isset($_GET['phone_state']) && $_GET['phone_state'] !== "") {
            $customers = array_values(array_filter($customers, function ($item){
                return $item->getPhoneState() == $_GET['phone_state'];
            }));
        }
        shuffle($customers); // randomly sort the array
        return json_encode(['data' => $customers]);
    }
}