<?php
include '../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);

$stmt = $pdo->prepare("
  UPDATE duty_post 
  SET post_name=?, location=?, shift=?
  WHERE id=?
");

$stmt->execute([
  $data['post_name'],
  $data['location'],
  $data['shift'],
  $data['id']
]);

echo json_encode(['ok' => true]);