<?php 
    require('connection2.php'); 
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
                            <a href="#" onclick="gotoPopup('login-popup')">Customer</a>
                            <a href="#" onclick="gotoPopup('login-popup-lm')">Lensman</a>
                        </div>
                </div>
                <div class="dropdown-register" style="float: right;">
                    <button type="button">Register</button>
                        <div class="dropdown-content-register">
                            <a href="#" onclick="gotoPopupRg('register-popup')">Customer</a>
                            <a href="#" onclick="gotoPopupRg('register-popup-lm')">Lensman</a>
                        </div>
                </div>
            </div>
        </header>

        <div class="popup-container" id="login-popup">
            <div class="popup">
                <form method="POST" action="login.php">
                    <h2>
                        <span>CUSTOMER LOGIN</span>
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

        <div class="popup-container" id="login-popup-lm">
            <div class="popup">
                <form method="POST" action="lensmen_login.php">
                    <h2>
                        <span>LENSMAN LOGIN</span>
                        <button type="reset" onclick="gotoPopup('login-popup-lm')">X</button>
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
                <form method="POST" action="register.php">
                    <h2>
                        <span>CUSTOMER REGISTER</span>
                        <button type="reset" onclick="gotoPopupRg('register-popup')">X</button>
                    </h2>
                    <input type="text" placeholder="Full Name" name="fullname">
                    <!--<input type="text" placeholder="Username" name="username">-->
                    <input type="email" placeholder="E-mail" name="email">
                    <input type="text" placeholder="Address" name="address">
                    <input type="number" placeholder="Age" name="age">
                    <input type="date" name="birthday" style="color: grey;">
                    <input type="number" placeholder="Contact Number" name="c_number">
                    <input type="password" placeholder="Password" name="password">
                    <input type="password" placeholder="Confirm Password" name="confirm_password">
                    <div class="errors" >
                    <h6 class="empr" id="emp-field-rg">Some fields are empty</h6>
                    <h6 class="ae" id="alr-email">Email already registered</h6>
                    <h6 class="pnm" id="pass-not-match">Password not match</h6>
                    <h6 class="sr" id="success-res" style="color: green;">Successfully registered</h6>
                    <h6 class="crq" id="cr-query">Cannot Run Query</h6>
                    </div>
                    <button type="submit" class="register-button" name="register">REGISTER</button>
                </form>
            </div>
        </div>

        <div class="popup-container" id="register-popup-lm">
            <div class="register popup">
                <form method="POST" action="lensmen_register.php" enctype="multipart/form-data">
                    <h2>
                        <span>LENSMAN REGISTER</span>
                        <button type="reset" onclick="gotoPopupRg('register-popup-lm')">X</button>
                    </h2>
                    <input type="text" placeholder="Full Name" name="fullname" required>
                    <!--<input type="text" placeholder="Username" name="username">-->
                    <input type="email" placeholder="E-mail" name="email" required>
                    <input type="text" placeholder="Address" name="address" required>
                    <input type="number" placeholder="Age" name="age" required>
                    <input type="date" name="birthday" style="color: grey;" required>
                    <input type="number" placeholder="Contact Number" name="c_number" required>
                    <span>Type of ID</span>
                    <select name="id_type" id="" required>
                        <option value="Student ID" selected>Student ID</option>
                        <option value="National ID">National ID</option>
                        <option value="Drivers License">Driver's License</option>
                        <option value="Passport">Passport</option>
                    </select>
                    <br>
                    <br>
                    <input type="file" name="img_upload" id="" style="color: grey;" required>
                    <input type="password" placeholder="Password" name="password" required>
                    <input type="password" placeholder="Confirm Password" name="confirm_password" required>
                    <div class="errors" >
                    <h6 class="empr" id="emp-field-rg">Some fields are empty</h6>
                    <h6 class="ae" id="alr-email">Email already registered</h6>
                    <h6 class="pnm" id="pass-not-match">Password not match</h6>
                    <h6 class="sr" id="success-res-lm" style="color: green;">Successfully registered</h6>
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
            else if(isset($_SESSION['alr_email']) && $_SESSION['alr_email']==true)
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
            else if(isset($_SESSION['pass_not_match']) && $_SESSION['pass_not_match']==true)
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
            else if(isset($_SESSION['success_res']) && $_SESSION['success_res']==true)
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
                    const myElement2 = document.getElementById("alr-email");
                    myElement2.style.display="none";
                    const myElement3 = document.getElementById("pass-not-match");
                    myElement3.style.display="none";
                    const myElement4 = document.getElementById("success-res");
                    myElement4.style.display="none";
                }
            }
  

        </script>

         

    </body>

</html>