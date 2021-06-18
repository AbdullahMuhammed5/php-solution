<?php
namespace App;

require '../vendor/autoload.php';

use App\SQLiteConnection;

$pdo = (new SQLiteConnection())->connect();

if (!$pdo)
    echo 'Whoops, could not connect to the SQLite database!';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Allow-Headers: Content-Type");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

/**
 * Create a new router instance.
 */
//$router = new Route($_SERVER);
//
///**
// * Add a "hello" route that prints to the screen.
// */
//$router->addRoute('home', function() {
//    echo file_get_contents('views/table.php');
////    exit();
//});
//
///**
// * Run it!
// */
////$router->listen();
//
//die("Asd");


$requestMethod = $_SERVER["REQUEST_METHOD"];

$customerGateway = new \App\CustomerGateway($pdo);
$countryGateway = new \App\CountryGateway($pdo);

//echo '<pre>' . var_export($countryGateway->all(), true) . '</pre>';
//exit();

if ($uri[1] === 'countries') {
    echo json_encode($countryGateway->all());
    exit();
}

if (isset($_GET['q']) && $_GET['q']) {
    $customers = $customerGateway->findWhereLike($_GET['q']);
} else {
    $customers = $customerGateway->all();
}

$countryList = $countryGateway->all();

$countryRegex = [
    'Cameroon'  => '/\(237\)[2368]\d{7,8}$/',
    'Ethiopia' => '/\(251\)[1-59]\d{8}$/',
    'Morocco'  => '/\(212\)[5-9]\d{8}$/',
    'Mozambique' => '/\(258\)[28]\d{7,8}$/',
    'Uganda'   => '/\(256\)\d{9}$/'
];

$customers = array_map(function ($item) use ($countryList, $countryRegex){
    $phoneSplit = explode(' ', $item->phone);
    $item->country_code = "+$phoneSplit[0]";
    $fullPhone = str_replace(' ','',$item->phone);
    $item->country = $countryList[array_search(
        preg_replace('~[)(]~', '', $phoneSplit[0]),
        array_column($countryList, 'code')
    )]['name'];
    $item->phone_state = (int) preg_match($countryRegex[$item->country], $fullPhone);
    $item->phone = $phoneSplit[1];
    return $item;
}, $customers);

//echo '<pre>' . var_dump($customers, true) . '</pre>';

echo json_encode(['data' => $customers]);
die();

//include './views/table.php';

// render all with ajax
// first when page loaded fire ajax
// on filters changes fire ajax
// return json response

// make customer model
// add getter and setter
// add country getter
// add phone validity getter

// use template engine (tpl or plates)

