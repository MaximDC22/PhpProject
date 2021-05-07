<?php
include_once(__DIR__ . "/../classes/User.php");

if (!empty($_POST)) {

    $user = new User();

    $user->setUsername($_POST['username']);

    if ($user->uniqueCheck()) {
        //respond
        $response = [
            'status' => 'success',
            'body' => 'this username is unique'
            

        ];
        header('Content-Type: application/json');
        echo json_encode($response); // encode to json
    } else {
        $response = [
            'status' => 'failed',
            'body' => 'this username is not unique'
        ];
        header('Content-Type: application/json');
        echo json_encode($response); // encode to json
    }
}
