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

$generators = [
    'color' => fn() => getRandomColor(),
    'email' => fn() => getRandomEmail($names, $emails),
    'name' => fn() => getRandomName($names),
    'phone' => fn() => getRandomPhoneNumber($phones),
];

if (!array_key_exists($type, $generators)) {
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
    $result[] = $generators[$type]();
}

http_response_code(200);

echo json_encode($result);

exit();
