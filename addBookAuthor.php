<?php

require_once('includes/initialize.php');

header('Content-Type: application/json; charset=UTF-8');

$response = array();

if(isset($_POST['book_name'])&&isset($_POST['id_author'])){
    $book_name = $_POST['book_name'];
    $id_author = $_POST['id_author'];
    $result = $api->addBookAuthor($book_name , $id_author);
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

