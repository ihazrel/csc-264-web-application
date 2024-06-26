<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $clientID = isset($_POST['clientID']) ? $_POST['clientID'] : '';
    $clientUsername = isset($_POST['clientUsername']) ? $_POST['clientUsername'] : 'NULL';
    $clientPassword = isset($_POST['clientPassword']) ? $_POST['clientPassword'] : 'NULL';
    $clientName = isset($_POST['clientName']) ? $_POST['clientName'] : 'NULL';
    $clientPhone = isset($_POST['clientPhone']) ? $_POST['clientPhone'] : 'NULL';


    $search = "SELECT client_username, client_id FROM client";
    $result = mysqli_query($link, $search) or die("Query failed");
    while($row = mysqli_fetch_array($result)) {
        if ($clientUsername == $row['client_username'] && $clientID != $row['client_id']) {
            echo json_encode(['status' => false, 'message' => 'Failed to edit client! Username already exists.']);
            exit;
        }
    }

    $query = "UPDATE client 
              SET client_username = '$clientUsername',
                  client_password = '$clientPassword',
                  client_name = '$clientName',
                  client_phone = '$clientPhone'
                  WHERE client_id = '$clientID'";
    $result = mysqli_query($link, $query) or die("Query failed");

    if ($result) {
        echo json_encode(['status' => true, 'message' => 'Client edited succesfully.']);
    } else {
        // mysqli_error($link) can provide more insight into why the query failed
        echo json_encode(['status' => false, 'message' => 'Failed to edit client.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}