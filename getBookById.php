<?php

require_once('includes/initialize.php');

header('Content-Type: application/json; charset=UTF-8');

$response = array();

if(isset($_GET['id_book']) && $_GET['id_author']){

    $id_book = $_GET['id_book'];
    $id_author = $_GET['id_author'];

    $result = $api->getBookById($id_book , $id_author);
    if($result){
        $response['status'] = "00";
        $response['message'] = "Book modified successfully";
    }else{
        $response['status'] = "06";
        $response['message'] = "Error modifying book";
    }

    echo json_encode($response);
}else{
    $response['status'] = "99";
    $response['message'] = "Required Parameters missing";

    echo json_encode($response);
}
?>
