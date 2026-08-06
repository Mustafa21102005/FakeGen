<?php

declare(strict_types=1);

require_once '../helpers/helper.php';
require_once '../helpers/generator.php';
require_once '../helpers/object.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);

    echo json_encode([
        'message' => 'Method not allowed.'
    ]);

    exit;
}

$type = trim($_POST['type'] ?? '');
$quantity = (int) ($_POST['quantity'] ?? 0);

$passwordLength = (int) ($_POST['length'] ?? 16);

$uppercase = filter_var(
    $_POST['uppercase'] ?? true,
    FILTER_VALIDATE_BOOLEAN
);

$lowercase = filter_var(
    $_POST['lowercase'] ?? true,
    FILTER_VALIDATE_BOOLEAN
);

$numbers = filter_var(
    $_POST['numbers'] ?? true,
    FILTER_VALIDATE_BOOLEAN
);

$symbols = filter_var(
    $_POST['symbols'] ?? true,
    FILTER_VALIDATE_BOOLEAN
);

try {
    $result = generate(
        $type,
        $quantity,
        $passwordLength,
        $uppercase,
        $lowercase,
        $numbers,
        $symbols
    );

    http_response_code(200);

    echo json_encode($result);
} catch (InvalidArgumentException $e) {
    http_response_code(422);

    echo json_encode([
        'message' => $e->getMessage()
    ]);
}
