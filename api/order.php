<?php

    include("../functions.php");

    $query = $sqlconnection->query("SELECT * FROM tbl_order");
    while ($row = mysqli_fetch_object($query)) {
        $data[] = $row;
    }

    $response = array(
            'status' => 1,
            'message' => 'Success',
            'data' => $data
    );
    header('Content-Type: application/json');
    echo json_encode($response);

?>