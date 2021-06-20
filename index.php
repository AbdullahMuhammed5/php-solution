<?php
namespace App;

require 'vendor/autoload.php';

use App\Config\SQLiteConnection;
use App\Controllers\CountryController;
use App\Controllers\CustomerController;

$pdo = (new SQLiteConnection())->connect();

if (!$pdo)
    echo 'Something went wrong while connecting to the SQLite database!';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Allow-Headers: Content-Type");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

switch ($uri[1]){
    case 'countries':
        $countryController = new CountryController();
        echo $countryController->index();
        break;
    case 'customers':
        $customerController = new CustomerController();
        echo $customerController->index();
        break;
    default:
        header('Location: app/views');
        break;
}

