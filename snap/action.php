<?php 

    $action = $_POST['action'];
    if($action == "kirimOrder") {
        $checkout = json_decode($_POST['checkout'],true);
        echo "<pre>";
        var_dump($checkout);
        echo "</pre>";
    }
