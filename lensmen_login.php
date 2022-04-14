<?php

require('connection2.php');
session_start();

#for login
if(isset($_POST['login']))
{
    if(empty($_POST["email_username"]) || empty($_POST["password"]))
    {
        $_SESSION['inputErr']=true;
        $_SESSION['functioncall']="'login-popup'";
        $_SESSION['functioncall2']="'emp-field'";
        header("location: index.php");
    }
    else
    {
        $query = "SELECT * FROM `tbl_lensmen_user` WHERE `email`='$_POST[email_username]' ";
        $result = mysqli_query($con,$query);
        if($result)
        {
            if(mysqli_num_rows($result)==1)
            {
                $result_fetch = mysqli_fetch_assoc($result);
                if($result_fetch['is_verified'] == 1)
                {
                    if(password_verify($_POST['password'], $result_fetch['password']))
                    {
                        $_SESSION['logged_in']=true;
                        $_SESSION['full_name']=$result_fetch['full_name'];
                        $_SESSION['id_image_dir']=$result_fetch['id_image_dir'];
                        header("location: user_page.php");
                    }
                    else
                    {
                        $_SESSION['failed_logged_in']=true;
                        $_SESSION['functioncall']="'login-popup'";
                        $_SESSION['functioncall2']="'wrong-pass'";
                        header("location: index.php");
                    }
                }
                else
                {
                    echo "
                        <script>
                            alert('Email not verified');
                            window.location.href='index.php'
                        </script>
                    ";
                }
            }
            else
            {
                $_SESSION['not_registered']=true;
                $_SESSION['functioncall']="'login-popup'";
                $_SESSION['functioncall2']="'not-regis'";
                header("location: index.php");   
            }
        }
        else
        {
            $_SESSION['cannot_run_query']=true;
            $_SESSION['functioncall']="'login-popup'";
            $_SESSION['functioncall2']="'cr-query'";
            header("location: index.php"); 
        }
    }
    
}  