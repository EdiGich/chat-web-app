<?php
    session_start();
    if(isset($_SESSION['unique_id'])){ //if user is logged in then come to this page otherwise go to login page.
                include_once "config.php";
                $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
                if(isset($logout_id)){ //if logout id id set.
                    $status = "Offline now";
                    //user status is updated to 'offline now' once user is logged out.
                    //Status is updated again to 'Online now' once user is logged in successfully.
                    $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id={$_GET['logout_id']}");
                    if($sql){
                        session_unset();
                        session_destroy();
                        header("location: ../login.php");
                    }
        }else{
            header("location: ../users.php");
        }
    }else{  
        header("location: ../login.php");
    }
?>