<?php
// Your data array (replace this with your actual data or fetch it from a database)
$data = array(2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2);

// Return data as JSON
header('Content-Type: application/json');
echo json_encode(array('series' => array(array('name' => 'Electric', 'data' => $data))));
?>