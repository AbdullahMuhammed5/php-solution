<?php

namespace App\Models;

use App\Config\SQLiteConnection;

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = SQLiteConnection::connect();
    }
}