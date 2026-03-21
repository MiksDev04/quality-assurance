<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../includes/db.php';
require_once '../includes/helpers.php';

$method = $_SERVER['REQUEST_METHOD'];
$db = getDB();

switch ($method) {
    case 'GET':
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;
        $survey_id = isset($_GET['survey_id']) ? intval($_GET['survey_id']) : null;
        if ($id) {
            $stmt = $db->prepare("SELECT sr.*, s.title as survey_title FROM survey_responses sr JOIN surveys s ON sr.survey_id = s.survey_id WHERE sr.response_id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            if (!$result) sendError('Response not found', 404);
            sendSuccess($result);
        } elseif ($survey_id) {
            $stmt = $db->prepare("SELECT sr.*, s.title as survey_title FROM survey_responses sr JOIN surveys s ON sr.survey_id = s.survey_id WHERE sr.survey_id = ? ORDER BY sr.response_date DESC");
            $stmt->bind_param('i', $survey_id);
            $stmt->execute();
            $rows = [];
            while ($row = $stmt->get_result()->fetch_assoc()) $rows[] = $row;
            sendSuccess($rows);
        } else {
            $result = $db->query("SELECT sr.*, s.title as survey_title FROM survey_responses sr JOIN surveys s ON sr.survey_id = s.survey_id ORDER BY sr.response_date DESC");
            $rows = [];
            while ($row = $result->fetch_assoc()) $rows[] = $row;
            sendSuccess($rows);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
        validateRequired(['survey_id', 'respondent_role', 'question', 'answer'], $data);
        $survey_id = intval($data['survey_id']);
        $role = trim($data['respondent_role']);
        $question = trim($data['question']);
        $answer = trim($data['answer']);
        $rating = isset($data['rating']) && $data['rating'] !== '' ? intval($data['rating']) : null;
        $date = !empty($data['response_date']) ? $data['response_date'] : date('Y-m-d');
        if ($rating !== null && ($rating < 1 || $rating > 5)) sendError('Rating must be between 1 and 5');
        $stmt = $db->prepare("INSERT INTO survey_responses (survey_id, respondent_role, question, answer, rating, response_date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('isssss', $survey_id, $role, $question, $answer, $rating, $date);
        if (!$stmt->execute()) sendError('Failed to create response');
        sendSuccess(['response_id' => $db->insert_id], 'Response submitted successfully');
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
        $id = isset($_GET['id']) ? intval($_GET['id']) : intval($data['response_id'] ?? 0);
        if (!$id) sendError('ID is required');
        validateRequired(['survey_id', 'respondent_role', 'question', 'answer'], $data);
        $survey_id = intval($data['survey_id']);
        $role = trim($data['respondent_role']);
        $question = trim($data['question']);
        $answer = trim($data['answer']);
        $rating = isset($data['rating']) && $data['rating'] !== '' ? intval($data['rating']) : null;
        $date = !empty($data['response_date']) ? $data['response_date'] : date('Y-m-d');
        $stmt = $db->prepare("UPDATE survey_responses SET survey_id=?, respondent_role=?, question=?, answer=?, rating=?, response_date=? WHERE response_id=?");
        $stmt->bind_param('isssssi', $survey_id, $role, $question, $answer, $rating, $date, $id);
        if (!$stmt->execute()) sendError('Failed to update response');
        sendSuccess([], 'Response updated successfully');
        break;

    case 'DELETE':
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if (!$id) sendError('ID is required');
        $stmt = $db->prepare("DELETE FROM survey_responses WHERE response_id=?");
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) sendError('Failed to delete response');
        sendSuccess([], 'Response deleted successfully');
        break;

    default:
        sendError('Method not allowed', 405);
}
$db->close();
