<?php
include '../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);

// conflict check
$check = $pdo->prepare("
  SELECT COUNT(*) FROM duty_schedule
  WHERE personnel_id = (
    SELECT personnel_id FROM duty_schedule WHERE id = ?
  )
  AND duty_date = ?
  AND id != ?
");

$check->execute([$data['id'], $data['date'], $data['id']]);

if ($check->fetchColumn() > 0) {
  echo json_encode(['ok'=>false,'error'=>'conflict']);
  exit;
}

$stmt = $pdo->prepare("
  UPDATE duty_schedule 
  SET duty_post_id=?, duty_date=?
  WHERE id=?
");

$stmt->execute([$data['post_id'], $data['date'], $data['id']]);

echo json_encode(['ok'=>true]);