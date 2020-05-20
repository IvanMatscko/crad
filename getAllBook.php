<?php

    require_once('includes/initialize.php');

    header('Content-Type: application/json; charset=UTF-8');

    $response = array();
    $result = $api->getAllBook();

if(count($result) > 0 ){
    $response['status'] = "00";
    $response['message'] = "Operation successfully";
    $response['books'] = $result;
}else{
    $response['status'] = "06";
    $response['message'] = "Error get book";
}
echo json_encode($response);
?>