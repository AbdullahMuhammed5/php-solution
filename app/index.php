<?php
namespace App;

require '../vendor/autoload.php';

use App\controllers\CustomerController;
use App\models\Country;

$pdo = (new SQLiteConnection())->connect();

if (!$pdo)
    echo 'Whoops, could not connect to the SQLite database!';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Allow-Headers: Content-Type");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

switch ($uri[1]){
    case 'countries':
        $countries = new Country();
        echo json_encode($countries->getAll());
        exit();
    case 'customers':
        $customerController = new CustomerController();
        $customerController->index();
        exit();
    default:
        header('Location: views/index');
        break;
}

