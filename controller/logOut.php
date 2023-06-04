<?php

    if(isset($_COOKIE['data_courses'])){
        setcookie('data_courses','',time()-1);
        header("Location: ../");
    }else{
        header("Location: ../");
    }

?>