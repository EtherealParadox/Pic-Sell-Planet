<?php

require('connection2.php');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $v_code)
{
    require ("PHPMailer/PHPMailer.php");
    require ("PHPMailer/SMTP.php");
    require ("PHPMailer/Exception.php");

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'picsellplanet@gmail.com';                     //SMTP username
        $mail->Password   = 'picsellplanet11';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587 ;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        $mail->setFrom('picsellplanet@gmail.com', 'Pic-Sell Planet');
        $mail->addAddress($email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email Verification for Pic-Sell Planet Account';
        $mail->Body    = "Thanks for making an account on our website,
            Please click the link below to verify your account
            <a href='http://localhost/projects/Thesis/lensmen_verification.php?email=$email&v_code=$v_code'>Verify Account</a>";
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if(isset($_POST['register']))
{
    if(empty($_POST["fullname"]) || empty($_POST["email"]) || empty($_POST["address"]) || empty($_POST["birthday"]) || empty($_POST["c_number"]) || empty($_POST["password"]))
    {
        $_SESSION['inputErr_rg']=true;
        $_SESSION['functioncall']="'register-popup'";
        $_SESSION['functioncall2']="'emp-field-rg'";
        header("location: index.php");
    }
    else
    {
        $user_exist_query="SELECT * FROM `tbl_lensmen_user` WHERE `email`='$_POST[email]' ";
        $result = mysqli_query($con,$user_exist_query);
        if($result)
        {
            if(mysqli_num_rows($result)>0)
            {
                $result_fetch = mysqli_fetch_assoc($result);
                /*if($result_fetch['username']==$_POST['username'])
                {
                    #error if username is already taken
                    $_SESSION['alr_username']=true;
                    $_SESSION['functioncall']="'register-popup'";
                    $_SESSION['functioncall2']="'alr-user'";
                    header("location: index.php");
                }
                else*/
                if($result_fetch['email']==$_POST['email'])
                {
                    #error if email is already registered
                    $_SESSION['alr_email']=true;
                    $_SESSION['functioncall']="'register-popup-lm'";
                    $_SESSION['functioncall2']="'alr-email'";
                    header("location: index.php");
                }
            }
            else
            {
                if(isset($_FILES['img_upload']))
                {
                    $img_name = $_FILES['img_upload']['name'];
                    $img_size = $_FILES['img_upload']['size'];
                    $tmp_name = $_FILES['img_upload']['tmp_name'];
                    $error = $_FILES['img_upload']['error'];

                    if($error === 0)
                    {
                        if($img_size > 5242880)
                        {
                            #file is too big
                            
                        }
                        else
                        {
                            $img_exten = pathinfo($img_name, PATHINFO_EXTENSION);
                            $img_exten_lc = strtolower($img_exten);

                            $allowed_exten = array("jpg", "jpeg", "png");

                            if(in_array($img_exten_lc, $allowed_exten))
                            {
                                if($_POST["password"] == $_POST["confirm_password"])
                                {
                                    $new_img_name = uniqid("IMG-", true).".".$img_exten_lc;
                                    $img_upload_path = 'uploads/'.$new_img_name;
                                    move_uploaded_file($tmp_name, $img_upload_path);

                                    $v_code = bin2hex(random_bytes(16));

                                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                                    $query="INSERT INTO `tbl_lensmen_user`(`full_name`, `email`, `address`, `age`, `birthday`, `contact`, `id_type`, `id_image_dir`, `password`, `verification_code`, `is_verified`) VALUES ('$_POST[fullname]', '$_POST[email]', '$_POST[address]', '$_POST[age]', '$_POST[birthday]', '$_POST[c_number]', '$_POST[id_type]', '$new_img_name', '$password', '$v_code', '0')";
                                    $query2="INSERT INTO `tbl_lensmen_user`(`full_name`, `email`, `address`, `age`, `birthday`, `contact`, `id_type`, `id_image_dir`, `password`, `verification_code`, `is_verified`) VALUES ('$_POST[fullname]','$_POST[email]','$_POST[address]','$_POST[age]','$_POST[birthday]','$_POST[c_number]','$_POST[id_type]','$new_img_name','$password','$v_code','0')";
                                    if(mysqli_query($con, $query) && sendMail($_POST['email'],$v_code))
                                    {
                                        #if data is successfully inserted
                                        $_SESSION['success_res']=true;
                                        $_SESSION['functioncall']="'register-popup-lm'";
                                        $_SESSION['functioncall2']="'success-res-lm'";
                                        header("location: index.php");
                                    }
                                    else
                                    {
                                        #error if data cannot be inserted
                                        $_SESSION['cannot_run_query']=true;
                                        $_SESSION['functioncall']="'register-popup-lm'";
                                        $_SESSION['functioncall2']="'cr-query'";
                                        header("location: index.php");
                                    }
                                }
                                else
                                {
                                    $_SESSION['pass_not_match']=true;
                                    $_SESSION['functioncall']="'register-popup-lm'";
                                    $_SESSION['functioncall2']="'pass-not-match'";
                                    header("location: index.php");
                                }
                            }
                            else
                            {
                                #file type is not within the requirement

                            }
                        }
                    }
                    else
                    {
                        #Something went wrong
                    }

                }
                /*if($_POST["password"] != $_POST["confirm_password"])
                {
                    $_SESSION['pass_not_match']=true;
                    $_SESSION['functioncall']="'register-popup'";
                    $_SESSION['functioncall2']="'pass-not-match'";
                    header("location: index.php");
                }
                else if($_POST["password"] == $_POST["confirm_password"] && isset($_FILES['img_upload']))
                {
                    $img_name = $_FILES['img_upload']['name'];
                    $img_size = $_FILES['img_upload']['size'];
                    $tmp_name = $_FILES['img_upload']['tmp_name'];
                    $error = $_FILES['img_upload']['error'];

                    if($error === 0)
                    {
                        if($img_size > 5242880)
                        {
                            #file is too big
                            
                        }
                        else
                        {
                            $img_exten = pathinfo($img_name, PATHINFO_EXTENSION);
                            $img_exten_lc = strtolower($img_exten);

                            $allowed_exten = array("jpg", "jpeg", "png");

                            if(in_array($img_exten_lc, $allowed_exten))
                            {
                                $new_img_name = uniqid("IMG-", true).".".$img_exten_lc;
                                $img_upload_path = 'uploads/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);

                                $v_code = bin2hex(random_bytes(16));

                                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                                $query="INSERT INTO `tbl_lensmen_user`(`full_name`, `email`, `address`, `age`, `birthday`, `contact`, `id_type`, `id_image_dir`, `password`, `verification_code`, `is_verified`) VALUES ('$_POST[fullname]', '$_POST[email]', '$_POST[address]', '$_POST[age]', '$_POST[birthday]', '$_POST[c_number]', '$_POST[id_type]', '$new_img_name', '$password', '$v_code', '0')";
                                if(mysqli_query($con, $query))
                                {
                                    #if data is successfully inserted
                                    $_SESSION['success_res']=true;
                                    $_SESSION['functioncall']="'register-popup'";
                                    $_SESSION['functioncall2']="'success-res-lm'";
                                    header("location: index.php");
                                }
                            }   
                            else
                            {
                                #file type is not within the requirement

                            }
                        }
                    }
                    else
                    {

                    }

                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    $query="INSERT INTO `tbl_customer_user`(`full_name`, `email`, `address`, `age`, `birthday`, `contact`, `password`) VALUES ('$_POST[fullname]', '$_POST[email]', '$_POST[address]', '$_POST[age]', '$_POST[birthday]', '$_POST[c_number]', '$password')";
                    if(mysqli_query($con, $query))
                    {
                        #if data is successfully inserted
                        $_SESSION['success_res']=true;
                        $_SESSION['functioncall']="'register-popup'";
                        $_SESSION['functioncall2']="'success-res'";
                        header("location: index.php");
                    }*/
            }
        }
        else
        {
            $_SESSION['cannot_run_query']=true;
            $_SESSION['functioncall']="'register-popup-lm'";
            $_SESSION['functioncall2']="'cr-query'";
            header("location: index.php");
        }
    }
    
}