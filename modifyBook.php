<?php

    require_once('includes/initialize.php');

    header('Content-Type: application/json; charset=UTF-8');

    $response = array();

if(isset($_POST['book_name']) &&
    isset($_POST['author_name']) &&
    isset($_POST['id_book']) &&
    isset($_POST['id_author'])
){
    $name = $_POST['book_name'];
    $author_name = $_POST['author_name'];
    $id_book = $_POST['id_book'];
    $id_author = $_POST['id_author'];

    $result = $api->modifyBook($name, $author_name, $id_book, $id_author);
    header("Location: http://crad/index.php");
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
