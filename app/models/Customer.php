<?php

namespace App\models;

use App\CustomerGateway;
use JsonSerializable;

class Customer extends Model implements JsonSerializable
{
    private $id;
    private $name;
    private $phone;
    private $country_code;
    private $country;
    private $phone_state;

    public function setName($value)
    {
        $this->name = $value;
    }

    public function setPhone($value)
    {
        $this->phone = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPhone()
    {
        return explode(' ', $this->phone)[1];
    }

    public function getFullPhone()
    {
        return $this->phone;
    }

    public function getCountryCode()
    {
        return preg_replace('~[)(]~', '',  $this->getFullCountryCode());
    }

    public function getFullCountryCode()
    {
        return explode(' ', $this->getFullPhone())[0];
    }

    public function getCountry()
    {
        // preg_grep returns array, so we need to get the key of first match
        return array_keys(preg_grep("/".$this->getCountryCode()."/", Country::REGEX))[0];
    }

    public function setCountry($value)
    {
        return $this->country = $value;
    }

    public function setCountryCode($value)
    {
        return $this->country_code = $value;
    }

    public function getPhoneState()
    {
        return (int) preg_match(Country::REGEX[$this->getCountry()], $this->getFullPhone());
    }

    public function setModel($data)
    {
        $customer = new Customer();
        $customer->id = $data->id ?? null;
        $customer->name = $data->name ?? null;
        $customer->phone = $data->phone ?? null;
        $customer->country = $this->getCountry();
        $customer->country_code = $this->getCountryCode();
        $customer->phone_state = $this->getPhoneState();
        return $customer;
    }

    public function getAll()
    {
        $customerGateway = new CustomerGateway($this->db);
        $customers = $customerGateway->all();
        return array_map(function ($customer) {
            return $this->setModel($customer);
        }, $customers);
    }

    public function findWhereLike($value)
    {
        $customerGateway = new CustomerGateway($this->db);
        $customers = $customerGateway->findWhereLike($value);
        return array_map(function ($customer) {
            return $this->setModel($customer);
        }, $customers);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'phone' => $this->getPhone(),
            'name' => $this->getName(),
            'country_code' => "+".$this->getCountryCode(),
            'country' => $this->getCountry(),
            'phone_state' => $this->getPhoneState(),
        ];
    }
}