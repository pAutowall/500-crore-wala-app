<?php
    include("connection.php");
    session_start();
    if( !isset($_SESSION['id']) ) {
        http_response_code(403);
        echo json_encode (
            array("message" => "Unautorized request")
        );
    }
    $foodId = $_POST['foodId'] ?? null;
    $message = $_POST['message'] ?? null;
    if (!$foodId) {
        http_response_code(500);
        echo json_encode(
            array("message" => "Invalid request")
        );
    } else {
        try {
            $query = "INSERT INTO requests VALUES (NULL,".$foodId.",".$message.",0,".$_SESSION['id'].");";
            $result = $con->query($query);
            http_response_code(201);
            echo json_encode(
                array("message" => "Request submitted successfully!")
            );
        } catch(Exception $e) {
            http_response_code(500);
            echo json_encode(
                array("message" => e->getMessage())
            );
        }
    }
?>