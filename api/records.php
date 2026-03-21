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
        $indicator_id = isset($_GET['indicator_id']) ? intval($_GET['indicator_id']) : null;
        if ($id) {
            $stmt = $db->prepare("SELECT r.*, i.name as indicator_name, i.target_value FROM qa_records r JOIN qa_indicators i ON r.indicator_id = i.indicator_id WHERE r.record_id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            if (!$result) sendError('Record not found', 404);
            sendSuccess($result);
        } elseif ($indicator_id) {
            $stmt = $db->prepare("SELECT r.*, i.name as indicator_name, i.target_value FROM qa_records r JOIN qa_indicators i ON r.indicator_id = i.indicator_id WHERE r.indicator_id = ? ORDER BY r.year DESC");
            $stmt->bind_param('i', $indicator_id);
            $stmt->execute();
            $rows = [];
            while ($row = $stmt->get_result()->fetch_assoc()) $rows[] = $row;
            sendSuccess($rows);
        } else {
            $result = $db->query("SELECT r.*, i.name as indicator_name, i.target_value FROM qa_records r JOIN qa_indicators i ON r.indicator_id = i.indicator_id ORDER BY r.year DESC, r.record_id DESC");
            $rows = [];
            while ($row = $result->fetch_assoc()) $rows[] = $row;
            sendSuccess($rows);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
        validateRequired(['indicator_id', 'year', 'actual_value'], $data);
        $ind_id = intval($data['indicator_id']);
        $year = intval($data['year']);
        $actual = floatval($data['actual_value']);
        if ($year < 2000 || $year > 2100) sendError('Invalid year');
        $dup = $db->prepare("SELECT record_id FROM qa_records WHERE indicator_id=? AND year=?");
        $dup->bind_param('ii', $ind_id, $year);
        $dup->execute();
        if ($dup->get_result()->num_rows > 0) sendError("A record for this indicator and year already exists.");
        $stmt = $db->prepare("INSERT INTO qa_records (indicator_id, year, actual_value) VALUES (?, ?, ?)");
        $stmt->bind_param('iid', $ind_id, $year, $actual);
        if (!$stmt->execute()) sendError('Failed to create record: ' . $db->error);
        sendSuccess(['record_id' => $db->insert_id], 'Record created successfully');
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
        $id = isset($_GET['id']) ? intval($_GET['id']) : intval($data['record_id'] ?? 0);
        if (!$id) sendError('ID is required');
        validateRequired(['indicator_id', 'year', 'actual_value'], $data);
        $ind_id = intval($data['indicator_id']);
        $year = intval($data['year']);
        $actual = floatval($data['actual_value']);
        $dup = $db->prepare("SELECT record_id FROM qa_records WHERE indicator_id=? AND year=? AND record_id != ?");
        $dup->bind_param('iii', $ind_id, $year, $id);
        $dup->execute();
        if ($dup->get_result()->num_rows > 0) sendError("A record for this indicator and year already exists.");
        $stmt = $db->prepare("UPDATE qa_records SET indicator_id=?, year=?, actual_value=? WHERE record_id=?");
        $stmt->bind_param('iidi', $ind_id, $year, $actual, $id);
        if (!$stmt->execute()) sendError('Failed to update record');
        sendSuccess([], 'Record updated successfully');
        break;

    case 'DELETE':
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if (!$id) sendError('ID is required');
        $stmt = $db->prepare("DELETE FROM qa_records WHERE record_id=?");
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) sendError('Failed to delete record');
        sendSuccess([], 'Record deleted successfully');
        break;

    default:
        sendError('Method not allowed', 405);
}
$db->close();
