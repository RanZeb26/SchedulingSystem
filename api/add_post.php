<?php
include '../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);

$stmt = $pdo->prepare("
  INSERT INTO duty_post (post_name, location, shift)
  VALUES (?, ?, ?)
");

$stmt->execute([
  $data['post_name'],
  $data['location'],
  $data['shift']
]);

echo json_encode(['ok' => true]);