<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$contacts = array();
if (isset($_GET['access']) && $_GET['access'] === 'true') {
  $contacts = json_decode(file_get_contents('php://input'), true);
}
echo json_encode($contacts);
?>
