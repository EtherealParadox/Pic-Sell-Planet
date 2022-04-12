<?php 
    require('connection.php'); 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Login and Register</title>
    </head>
    <body>
        <header>
            <h2>Pic-Sell Planet</h2>
            <nav>
                <a href="#">Home</a>
                <a href="#">Services</a>
                <a href="#">About</a>
            </nav>
            <div class="sign-in-up">
            <div class="dropdown-login" style="float: left;">
                    <button type="button">Login</button>
                        <div class="dropdown-content-login" style="float: center;">
                            <a href="#" onclick="gotoPopup('login-popup')">Service Prov.</a>
                            <a href="#" onclick="gotoPopup('login-popup')">Client</a>
                        </div>
                </div>
                <div class="dropdown-register" style="float: right;">
                    <button type="button">Register</button>
                        <div class="dropdown-content-register">
                            <a href="#" onclick="gotoPopupRg('register-popup')">Service Prov.</a>
                            <a href="#" onclick="gotoPopupRg('register-popup')">Client</a>
                        </div>
                </div>
            </div>
        </header>

        <div class="popup-container" id="login-popup">
            <div class="popup">
                <form method="POST" action="login_register.php">
                    <h2>
                        <span>USER LOGIN</span>
                        <button type="reset" onclick="gotoPopup('login-popup')">X</button>
                    </h2>
                    <input type="text" placeholder="E-mail" name="email_username">
                    <input type="password" placeholder="Password" name="password">
                    <div class="errors" >
                    <h6 class="emp" id="emp-field">Some fields are empty</h6>
                    <h6 class="wp" id="wrong-pass">Incorrect Password</h6>
                    <h6 class="nr" id="not-regis">Email or Username not registered</h6>
                    <h6 class="crq" id="cr-query">Cannot Run Query</h6>
                    </div>
                    <button type="submit" class="login-button" name="login">LOGIN</button>
                </form>
            </div>
        </div>

        <div class="popup-container" id="register-popup">
            <div class="register popup">
                <form method="POST" action="login_register.php">
                    <h2>
                        <span>USER REGISTER</span>
                        <button type="reset" onclick="gotoPopupRg('register-popup')">X</button>
                    </h2>
                    <input type="text" placeholder="Full Name" name="fullname">
                    <input type="text" placeholder="Username" name="username">
                    <input type="email" placeholder="E-mail" name="email">
                    <input type="password" placeholder="Password" name="password">
                    <div class="errors" >
                    <h6 class="empr" id="emp-field-rg">Some fields are empty</h6>
                    <h6 class="au" id="alr-user">Username already registered</h6>
                    <h6 class="ae" id="alr-email">Email already registered</h6>
                    <h6 class="crq" id="cr-query">Cannot Run Query</h6>
                    </div>
                    <button type="submit" class="register-button" name="register">REGISTER</button>
                </form>
            </div>
        </div>

        <?php
            if(isset($_SESSION['inputErr']) && $_SESSION['inputErr']==true)
            {
                echo "
                <script type='text/javascript'>
                function popup(){
                    get_popup=document.getElementById($_SESSION[functioncall]);
                    get_popup2=document.getElementById($_SESSION[functioncall2]);
                    if(get_popup.style.display=='flex' && get_popup2.style.display=='flex')
                    {
                    get_popup.style.display='none';
                    get_popup2.style.display='none';
                    }
                    else
                    {
                    get_popup.style.display='flex';
                    get_popup2.style.display='flex';
                    }
                }
                window.onload = popup;
                </script>
                ";
                session_unset();
                session_destroy();
            }   
            else if(isset($_SESSION['failed_logged_in']) && $_SESSION['failed_logged_in']==true)
            {
                echo "
                <script type='text/javascript'>
                function popup(){
                    get_popup=document.getElementById($_SESSION[functioncall]);
                    get_popup2=document.getElementById($_SESSION[functioncall2]);
                    if(get_popup.style.display=='flex' && get_popup2.style.display=='flex')
                    {
                    get_popup.style.display='none';
                    get_popup2.style.display='none';
                    }
                    else
                    {
                    get_popup.style.display='flex';
                    get_popup2.style.display='flex';
                    }
                }
                window.onload = popup;
                </script>
                ";
                session_unset();
                session_destroy();
            }
            else if(isset($_SESSION['not_registered']) && $_SESSION['not_registered']==true)
            {
                echo "
                <script type='text/javascript'>
                function popup(){
                    get_popup=document.getElementById($_SESSION[functioncall]);
                    get_popup2=document.getElementById($_SESSION[functioncall2]);
                    if(get_popup.style.display=='flex' && get_popup2.style.display=='flex')
                    {
                    get_popup.style.display='none';
                    get_popup2.style.display='none';
                    }
                    else
                    {
                    get_popup.style.display='flex';
                    get_popup2.style.display='flex';
                    }
                }
                window.onload = popup;
                </script>
                ";
                session_unset();
                session_destroy();
            }
            else if(isset($_SESSION['cannot_run_query']) && $_SESSION['cannot_run_query']==true)
            {
                echo "
                <script type='text/javascript'>
                function popup(){
                    get_popup=document.getElementById($_SESSION[functioncall]);
                    get_popup2=document.getElementById($_SESSION[functioncall2]);
                    if(get_popup.style.display=='flex' && get_popup2.style.display=='flex')
                    {
                    get_popup.style.display='none';
                    get_popup2.style.display='none';
                    }
                    else
                    {
                    get_popup.style.display='flex';
                    get_popup2.style.display='flex';
                    }
                }
                window.onload = popup;
                </script>
                ";
                session_unset();
                session_destroy();
            }
            else if(isset($_SESSION['inputErr_rg']) && $_SESSION['inputErr_rg']==true)
            {
                echo "
                <script type='text/javascript'>
                function popup(){
                    get_popup=document.getElementById($_SESSION[functioncall]);
                    get_popup2=document.getElementById($_SESSION[functioncall2]);
                    if(get_popup.style.display=='flex' && get_popup2.style.display=='flex')
                    {
                    get_popup.style.display='none';
                    get_popup2.style.display='none';
                    }
                    else
                    {
                    get_popup.style.display='flex';
                    get_popup2.style.display='flex';
                    }
                }
                window.onload = popup;
                </script>
                ";
                session_unset();
                session_destroy();
            }

            else if(isset($_SESSION['alr_username']) && $_SESSION['alr_username']==true)
            {
                echo "
                <script type='text/javascript'>
                function popup(){
                    get_popup=document.getElementById($_SESSION[functioncall]);
                    get_popup2=document.getElementById($_SESSION[functioncall2]);
                    if(get_popup.style.display=='flex' && get_popup2.style.display=='flex')
                    {
                    get_popup.style.display='none';
                    get_popup2.style.display='none';
                    }
                    else
                    {
                    get_popup.style.display='flex';
                    get_popup2.style.display='flex';
                    }
                }
                window.onload = popup;
                </script>
                ";
                session_unset();
                session_destroy();
            }
        ?>

        <script type='text/javascript'>
            function gotoPopup(link_name){
                get_popup=document.getElementById(link_name);
                if(get_popup.style.display=="flex")
                {
                    get_popup.style.display="none";
                }
                else
                {
                    get_popup.style.display="flex";
                    const myElement = document.getElementById("emp-field");
                    myElement.style.display="none";
                    const myElement2 = document.getElementById("wrong-pass");
                    myElement2.style.display="none";
                    const myElement3 = document.getElementById("not-regis");
                    myElement3.style.display="none";
                    const myElement4 = document.getElementById("emp-field-rg");
                    myElement4.style.display="none";
                }
            }

            function gotoPopupRg(link_name){
                get_popup=document.getElementById(link_name);
                if(get_popup.style.display=="flex")
                {
                    get_popup.style.display="none";
                }
                else
                {
                    get_popup.style.display="flex";
                    const myElement = document.getElementById("emp-field-rg");
                    myElement.style.display="none";
                    const myElement2 = document.getElementById("alr-user");
                    myElement2.style.display="none";
                }
            }
        </script>

    </body>

</html>