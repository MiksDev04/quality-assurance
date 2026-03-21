<?php
function sendJSON($data, $code = 200) {
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

function sendSuccess($data = [], $message = 'Success') {
    sendJSON(['success' => true, 'message' => $message, 'data' => $data]);
}

function sendError($message = 'Error', $code = 400) {
    sendJSON(['success' => false, 'message' => $message], $code);
}

function validateRequired($fields, $data) {
    foreach ($fields as $field) {
        if (!isset($data[$field]) || trim($data[$field]) === '') {
            sendError("Field '$field' is required.");
        }
    }
}
