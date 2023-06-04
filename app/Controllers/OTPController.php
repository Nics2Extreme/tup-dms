<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class OTPController extends BaseController
{
    
    function otp()
    {
        $email = \Config\Services::email();

        $con = mysqli_connect("localhost", "root", "", "tup-dms");
        $user = $this->request->getPost('email');

        $res = mysqli_query($con, "SELECT * FROM users WHERE email = '$user'");
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            $otp = rand(1111, 9999);
            mysqli_query($con, "UPDATE users SET otp = '$otp' WHERE email='$user'");

            $email->setFrom('jnics016@zohomail.com', 'Pokoy');
            $email->setTo($this->request->getPost('email'));
            $email->setSubject('OTP Confirmation');
            $email->setMessage('Your OTP is ' . $otp);
            if($email->send()){
                echo "yes";
            }else{
                echo "Email not sent";
            }
        } else {
            echo "User doesn't exist.";
        }
    }
}
