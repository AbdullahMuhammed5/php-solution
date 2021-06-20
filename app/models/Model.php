<?php

namespace App\models;

use App\SQLiteConnection;

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = SQLiteConnection::connect();
    }
}