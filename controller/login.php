<?php

    session_start();
    $_SESSION['data_user']=['info'=>'apa'];
    header("Location: ../views/home.php");

?>