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
        if ($id) {
            $stmt = $db->prepare("SELECT s.*, COUNT(sr.response_id) as response_count FROM surveys s LEFT JOIN survey_responses sr ON s.survey_id = sr.survey_id WHERE s.survey_id = ? GROUP BY s.survey_id");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            if (!$result) sendError('Survey not found', 404);
            sendSuccess($result);
        } else {
            $result = $db->query("SELECT s.*, COUNT(sr.response_id) as response_count FROM surveys s LEFT JOIN survey_responses sr ON s.survey_id = sr.survey_id GROUP BY s.survey_id ORDER BY s.created_date DESC");
            $rows = [];
            while ($row = $result->fetch_assoc()) $rows[] = $row;
            sendSuccess($rows);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
        validateRequired(['title'], $data);
        $title = trim($data['title']);
        $desc = trim($data['description'] ?? '');
        $date = !empty($data['created_date']) ? $data['created_date'] : date('Y-m-d');
        $stmt = $db->prepare("INSERT INTO surveys (title, description, created_date) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $title, $desc, $date);
        if (!$stmt->execute()) sendError('Failed to create survey');
        sendSuccess(['survey_id' => $db->insert_id], 'Survey created successfully');
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
        $id = isset($_GET['id']) ? intval($_GET['id']) : intval($data['survey_id'] ?? 0);
        if (!$id) sendError('ID is required');
        validateRequired(['title'], $data);
        $title = trim($data['title']);
        $desc = trim($data['description'] ?? '');
        $date = !empty($data['created_date']) ? $data['created_date'] : date('Y-m-d');
        $stmt = $db->prepare("UPDATE surveys SET title=?, description=?, created_date=? WHERE survey_id=?");
        $stmt->bind_param('sssi', $title, $desc, $date, $id);
        if (!$stmt->execute()) sendError('Failed to update survey');
        sendSuccess([], 'Survey updated successfully');
        break;

    case 'DELETE':
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if (!$id) sendError('ID is required');
        $check = $db->prepare("SELECT COUNT(*) as cnt FROM survey_responses WHERE survey_id=?");
        $check->bind_param('i', $id);
        $check->execute();
        $cnt = $check->get_result()->fetch_assoc()['cnt'];
        if ($cnt > 0) sendError('Cannot delete: survey has associated responses. Delete responses first.');
        $stmt = $db->prepare("DELETE FROM surveys WHERE survey_id=?");
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) sendError('Failed to delete survey');
        sendSuccess([], 'Survey deleted successfully');
        break;

    default:
        sendError('Method not allowed', 405);
}
$db->close();
