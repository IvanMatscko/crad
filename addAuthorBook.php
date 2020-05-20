<?php

require_once('includes/initialize.php');

header('Content-Type: application/json; charset=UTF-8');

$response = array();

if(isset($_POST['id_book'])&&isset($_POST['author_name'])){
    $id_book = $_POST['id_book'];
    $author_name = $_POST['author_name'];
    $result = $api->addAuthorBook($id_book , $author_name);
    header("Location: http://crad/index.php");
    if($result){
        $response['status'] = "00";
        $response['message'] = "Book inserted successfully";
    }else{
        $response['status'] = "06";
        $response['message'] = "Error inserting book";
    }
    echo json_encode($response);

}else{
    $response['status'] = "99";
    $response['message'] = "Required Parameters missing";

    echo json_encode($response);
}
?>

