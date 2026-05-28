<?php

require_once '../helpers/helper.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);

    echo json_encode([
        'message' => 'Method not allowed.'
    ]);

    exit();
}

$type = trim($_POST['type'] ?? '');
$quantity = (int) ($_POST['quantity'] ?? 0);

$allowedTypes = ['name', 'email', 'phone'];

if (!in_array($type, $allowedTypes)) {
    http_response_code(422);

    echo json_encode([
        'message' => 'Type is not accepted.'
    ]);

    exit();
}

if ($quantity < 1 || $quantity > 10000) {
    http_response_code(422);

    echo json_encode([
        'message' => 'Quantity must be between 1 and 10000.'
    ]);

    exit();
}

$result = [];

for ($i = 0; $i < $quantity; $i++) {

    switch ($type) {

        case 'name':
            $result[] = getRandomName($names);
            break;

        case 'email':
            $result[] = getRandomEmail($names, $emails);
            break;

        case 'phone':
            $result[] = getRandomPhoneNumber($phones);
            break;
    }
}

http_response_code(200);

echo json_encode($result);

exit();
