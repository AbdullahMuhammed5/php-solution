<?php

namespace App\Models;

use App\DatabaseGateways\CountryGateway;
use JsonSerializable;

class Country extends Model implements JsonSerializable
{
    private $id;
    private $name;
    private $code;

    const REGEX = [
        'Cameroon'  => '/\(237\)[\ ][2368]\d{7,8}$/',
        'Ethiopia' => '/\(251\)[\ ][1-59]\d{8}$/',
        'Morocco'  => '/\(212\)[\ ][5-9]\d{8}$/',
        'Mozambique' => '/\(258\)[\ ][28]\d{7,8}$/',
        'Uganda'   => '/\(256\)[\ ]\d{9}$/'
    ];

    public function setName($value)
    {
        $this->name = $value;
    }

    public function setCode($value)
    {
        $this->code = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setModel($data)
    {
        $country = new Country();
        $country->id   = $data['id']   ?? null;
        $country->name = $data['name'] ?? null;
        $country->code = $data['code'] ?? null;
        return $country;
    }

    public function getAll()
    {
        $countryGateway = new CountryGateway($this->db);
        $countries = $countryGateway->all();
        return array_map(function ($country) {
            return $this->setModel($country);
        }, $countries);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'code' => $this->getCode(),
        ];
    }
}