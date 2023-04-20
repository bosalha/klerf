<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$contacts = array();
if (isset($_GET['access']) && $_GET['access'] === 'true') {
  $contacts = json_decode(shell_exec('w.html'), true);
}
echo json_encode($contacts);
?>