<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../includes/db.php';
require_once '../includes/helpers.php';

$db = getDB();

$summary = [];

// Count indicators
$r = $db->query("SELECT COUNT(*) as cnt FROM qa_indicators");
$summary['total_indicators'] = $r->fetch_assoc()['cnt'];

// Count surveys
$r = $db->query("SELECT COUNT(*) as cnt FROM surveys");
$summary['total_surveys'] = $r->fetch_assoc()['cnt'];

// Count responses
$r = $db->query("SELECT COUNT(*) as cnt FROM survey_responses");
$summary['total_responses'] = $r->fetch_assoc()['cnt'];

// Count records
$r = $db->query("SELECT COUNT(*) as cnt FROM qa_records");
$summary['total_records'] = $r->fetch_assoc()['cnt'];

// Indicators meeting target (latest record >= target)
$r = $db->query("
    SELECT COUNT(*) as cnt FROM (
        SELECT i.indicator_id, i.target_value,
            (SELECT actual_value FROM qa_records WHERE indicator_id = i.indicator_id ORDER BY year DESC LIMIT 1) AS latest
        FROM qa_indicators i
        HAVING latest IS NOT NULL AND latest >= target_value
    ) t
");
$summary['indicators_meeting_target'] = $r->fetch_assoc()['cnt'];

// Recent records (last 5)
$r = $db->query("SELECT r.*, i.name as indicator_name, i.target_value FROM qa_records r JOIN qa_indicators i ON r.indicator_id = i.indicator_id ORDER BY r.record_id DESC LIMIT 5");
$summary['recent_records'] = [];
while ($row = $r->fetch_assoc()) $summary['recent_records'][] = $row;

// Chart data: all indicators with latest values
$r = $db->query("
    SELECT i.name, i.target_value,
        (SELECT actual_value FROM qa_records WHERE indicator_id = i.indicator_id ORDER BY year DESC LIMIT 1) AS actual_value
    FROM qa_indicators i
    ORDER BY i.indicator_id
    LIMIT 8
");
$summary['chart_data'] = [];
while ($row = $r->fetch_assoc()) $summary['chart_data'][] = $row;

// Average rating by survey
$r = $db->query("SELECT s.title, AVG(sr.rating) as avg_rating, COUNT(sr.response_id) as cnt FROM surveys s JOIN survey_responses sr ON s.survey_id = sr.survey_id WHERE sr.rating IS NOT NULL GROUP BY s.survey_id ORDER BY s.created_date DESC LIMIT 5");
$summary['survey_ratings'] = [];
while ($row = $r->fetch_assoc()) $summary['survey_ratings'][] = $row;

sendSuccess($summary);
$db->close();
