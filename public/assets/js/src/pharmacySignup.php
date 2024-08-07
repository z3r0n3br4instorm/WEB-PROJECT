<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    echo "Method Not Allowed";
    exit;
}

// $currentDateTime = date('Y-m-d H:i:s');

require '../../../../vendor/autoload.php';

$mongoUri = "mongodb://localhost:27017";
$dbName = "MEDIX";
$collectionName = "Pharmacy";

try {
    $mongoClient = new MongoDB\Client($mongoUri);
    $db = $mongoClient->$dbName;
    $collection = $db->$collectionName;

    $document = array(
        'PharmacyName' => $_POST['pharmacyName'],
        'OwnerName' => $_POST['ownName'],
        'PharmacyPhone' => $_POST['pharmaPhone'],
        'OwnerPhone' => $_POST['ownPhone'],
        'PharmacyAddress' => $_POST['Address'],
        'PharmacyEmail' => $_POST['Email'],
        'PharmacyPassword' => $_POST['Password']
    );

    $collection->insertOne($document);
    echo "Registration Successful.";
} catch (MongoDB\Driver\Exception\Exception $ex) {
    echo "Error: " . $ex->getMessage();
}
?>