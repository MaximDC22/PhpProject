<?php
include_once("./classes/User.php");

if(!empty($_POST)){
       echo('ik werk');
        //CHECK USERNAME
        $u = new User();
        $u->setUsername($_POST['username']);
        if($u->uniqueCheck()){
            //respond
            $response = [
                'status' => 'succes',
                'message' =>'is unique'
                
            ];
            header('Content-Type: application/json');
            echo json_encode($response); // encode to json
        }else{
            $response = [
                'status' => 'failed',
                'message' =>'is already taken'
            ];
            header('Content-Type: application/json');
            echo json_encode($response); // encode to json
        }


}