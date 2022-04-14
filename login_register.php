<?php

require('connection.php');
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
        $query = "SELECT * FROM `registered_users` WHERE `email`='$_POST[email_username]' OR `username`='$_POST[email_username]' ";
        $result = mysqli_query($con,$query);
        if($result)
        {
            if(mysqli_num_rows($result)==1)
            {
                $result_fetch = mysqli_fetch_assoc($result);
                if(password_verify($_POST['password'], $result_fetch['password']))
                {
                    $_SESSION['logged_in']=true;
                    $_SESSION['username']=$result_fetch['username'];
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




#for register
if(isset($_POST['register']))
{
    if(empty($_POST["fullname"]) || empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"]))
    {
        $_SESSION['inputErr_rg']=true;
        $_SESSION['functioncall']="'register-popup'";
        $_SESSION['functioncall2']="'emp-field-rg'";
        header("location: index.php");
    }
    else
    {
        $user_exist_query="SELECT * FROM `registered_users` WHERE `username`='$_POST[username]' OR `email`='$_POST[email]' ";
        $result = mysqli_query($con,$user_exist_query);
        if($result)
        {
            if(mysqli_num_rows($result)>0)
            {
                $result_fetch = mysqli_fetch_assoc($result);
                if($result_fetch['username']==$_POST['username'])
                {
                    #error if username is already taken
                    $_SESSION['alr_username']=true;
                    $_SESSION['functioncall']="'register-popup'";
                    $_SESSION['functioncall2']="'alr-user'";
                    header("location: index.php");
                }
                else
                {
                    #error if email is already registered
                    $_SESSION['alr-email']=true;
                    $_SESSION['functioncall']="'register-popup'";
                    $_SESSION['functioncall2']="'alr-email'";
                    header("location: index.php");
                    echo "
                        <script>
                            alert('$result_fetch[email] - E-mail already registered');
                            window.location.href='index.php';
                        </script>
                    ";
                }
        }
        else
        {
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $query="INSERT INTO `registered_users`(`full_name`, `username`, `email`, `password`) VALUES ('$_POST[fullname]', '$_POST[username]', '$_POST[email]', '$password')";
            if(mysqli_query($con, $query))
            {
                #if data is successfully inserted
                echo "
                    <script>
                        alert('Registration Successful');
                        window.location.href='index.php';
                    </script>
                ";
            }
            else
            {
                #error if data cannot be inserted
                $_SESSION['cannot_run_query']=true;
                $_SESSION['functioncall']="'login-popup'";
                $_SESSION['functioncall2']="'cr-query'";
                header("location: index.php");
            }
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
    



       