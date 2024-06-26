<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $roomID = $_POST['roomID'] ?? '';
    $roomType = $_POST['roomType'] ?? '';
    $roomDesc = $_POST['roomDesc'] ?? '';
    $roomPax = $_POST['roomPax'] ?? '';
    $roomPrice = $_POST['roomPrice'] ?? '';

    $query = "INSERT INTO room (room_type, room_desc, room_pax, room_price) VALUES ('$roomType', '$roomDesc', '$roomPax', '$roomPrice')";
    $result = mysqli_query($link, $query) or die("Query failed");

    if ($result) {
        echo json_encode(['status' => true, 'message' => 'Room created successfully.']);
    } else {
        // mysqli_error($link) can provide more insight into why the query failed
        echo json_encode(['status' => false, 'message' => 'Failed to create room.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}