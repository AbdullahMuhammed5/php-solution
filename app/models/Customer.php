<?php


namespace App\models;


class Customer
{
    private $id;
    private $name;
    private $phone;

    public function setName($value)
    {
        $this->name = $value;
    }

    public function setPhone($value)
    {
        $this->phone = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPhone()
    {
        return $this->phone;
    }
}