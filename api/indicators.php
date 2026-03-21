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
            $stmt = $db->prepare("SELECT * FROM qa_indicators WHERE indicator_id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            if (!$result) sendError('Indicator not found', 404);
            sendSuccess($result);
        } else {
            $result = $db->query("SELECT i.*, 
                (SELECT actual_value FROM qa_records r WHERE r.indicator_id = i.indicator_id ORDER BY r.year DESC LIMIT 1) AS latest_value,
                (SELECT year FROM qa_records r WHERE r.indicator_id = i.indicator_id ORDER BY r.year DESC LIMIT 1) AS latest_year
                FROM qa_indicators i ORDER BY i.indicator_id DESC");
            $rows = [];
            while ($row = $result->fetch_assoc()) $rows[] = $row;
            sendSuccess($rows);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
        validateRequired(['name', 'target_value'], $data);
        $name = trim($data['name']);
        $desc = trim($data['description'] ?? '');
        $target = floatval($data['target_value']);
        $stmt = $db->prepare("INSERT INTO qa_indicators (name, description, target_value) VALUES (?, ?, ?)");
        $stmt->bind_param('ssd', $name, $desc, $target);
        if (!$stmt->execute()) sendError('Failed to create indicator: ' . $db->error);
        sendSuccess(['indicator_id' => $db->insert_id], 'Indicator created successfully');
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
        $id = isset($_GET['id']) ? intval($_GET['id']) : intval($data['indicator_id'] ?? 0);
        if (!$id) sendError('ID is required');
        validateRequired(['name', 'target_value'], $data);
        $name = trim($data['name']);
        $desc = trim($data['description'] ?? '');
        $target = floatval($data['target_value']);
        $stmt = $db->prepare("UPDATE qa_indicators SET name=?, description=?, target_value=? WHERE indicator_id=?");
        $stmt->bind_param('ssdi', $name, $desc, $target, $id);
        if (!$stmt->execute()) sendError('Failed to update indicator');
        sendSuccess([], 'Indicator updated successfully');
        break;

    case 'DELETE':
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if (!$id) sendError('ID is required');
        $check = $db->prepare("SELECT COUNT(*) as cnt FROM qa_records WHERE indicator_id=?");
        $check->bind_param('i', $id);
        $check->execute();
        $cnt = $check->get_result()->fetch_assoc()['cnt'];
        if ($cnt > 0) sendError('Cannot delete: indicator has associated records. Delete records first.');
        $stmt = $db->prepare("DELETE FROM qa_indicators WHERE indicator_id=?");
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) sendError('Failed to delete indicator');
        sendSuccess([], 'Indicator deleted successfully');
        break;

    default:
        sendError('Method not allowed', 405);
}
$db->close();
