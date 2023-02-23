<?php
@session_start();
require_once 'dbController.php';
require_once 'loggers.php';

//add column to access column for active/inacive users


$controller = new dbController();
$curLogger = new loggers();

$controllers = $controller->connect();

//get mail control
include_once 'alert.php';
$alert = new Alert();

//Table Name definitions
define ("LOGIN","access");
define ("PEOPLE","members");
$ranks = array(1=>"Admin", 2=>"Members");


if(isset($_POST) && isset($_GET['code']))
{
    $code = $_GET['code'];
    
    //Login Form
    if($code=='1')
    {

    	 $username = $_POST['username'];
       $password = md5($_POST['password']); //encrypted passwords!!! 

        if(empty($username) || empty($password))
        {
            $_SESSION['errMsg'] = "Fields cannot be empty";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else
        {
        	  $wer = "username = '$username' and password = '$password'";
            $result = $controller->retrieve(LOGIN, $wer);
            if($result==FALSE)
            {
                $_SESSION['errMsg'] = "Invalid Login Credentials";
                header('Location: ' . $_SERVER['HTTP_REFERER']);                
            }
            else
            {
                unset($_SESSION['errMsg']);

                 //change status...
                  $a = "status"; $b = '1'; $c = " username = '". $username ."'";
                  $changeStatus = $controller->update(LOGIN, $a, $b, $c);

                  $row = mysqli_fetch_array($result);
                
                    extract($row);                   
                    $_SESSION["username"] = $username;
                    $_SESSION['status'] = $row['status'];
                    $_SESSION['role'] = $row['rank'];
                    $role =   $_SESSION['role'];
                    
                    
                    $curLogger = new loggers();

                    switch ($role) {
                      case '1':
                         $curLogger->admLoggers();
                        break;
                        /*
                      case '2':
                        $curLogger->staffLoggers();
                        break;                
                      */
                      default:
                        header("Location: ../login.php");
                        break;
                    }     
              }
        }
    }
    
    //Register a new user
    elseif ($code=='2') 
    {
        $fname = addslashes($_POST['fname']); 
        $lname = addslashes($_POST['lname']);  
        $email = addslashes($_POST['email']);
        $phone = addslashes($_POST['phone']);
        $gender = addslashes($_POST['gender']); 

        $password1 = addslashes($_POST['password1']); 
        $password2 = addslashes($_POST['password2']); 

        $wer = "username = '$email'";
        $result = $controller->retrieve(LOGIN, $wer);
          if($result)
            {
                $_SESSION['errMsg'] = "User already exists";
                header('Location: ' . $_SERVER['HTTP_REFERER']); 
                exit();               
            }


        if($password1 != $password2)
        {
          $_SESSION['errMsg'] = "Password mismatch"; 
          header('Location: ' . $_SERVER['HTTP_REFERER']); 
        }else
        {
          $a = array("fname", "lname", "email", "phone", "summary", "pix", "type");
          $b = array("'$fname'", "'$lname'", "'$email'", "'$phone'", "''", "''", "'2'");
          $result = $controller->insert(PEOPLE, $a, $b);

          if($result)
          {
            //$pass = dechex(time()); 
            $passes = md5($password1); 
            $aa = array("username", "password", "status", "rank");
            $bb = array("'$email'", "'$passes'", "'0'", "'2'");   
            $result = $controller->insert("access", $aa, $bb);
          }

          //send notifcation and other messages
          $descr = "New user added with username <b>" .$email."</b>";
          $ijk = array("email", "descr");
          $kji = array("'$email'", "'$descr'");        
          $controller->insert(LOGS, $ijk, $kji);

             $message = '<html>
                          <head>
                            <title>Mail from Louis Chambers</title>
                              <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

                              <style>
                                  body{
                                      font-family: "open sans", "Helvetica", "Arial", sans-serif;
                                  }
                                  .set_table tr th{
                                      /*padding: 5px 0;*/
                                      width: 30%;
                                      text-align: left;
                                  }
                                  table {
                                      border: 1px solid #ddd;
                                      width: 100%;
                                      margin-bottom: 30px;
                                  }
                                  th, td {
                                      padding: 15px;
                                      text-align: left;
                                  }
                                  tr:nth-child(even) {background-color: #f2f2f2;}

                              </style>
                          </head>
                        <body>
                          <img src="http://www.lawyerosanakposan.com/assets/images/learning_mind_c.png" style="width: 200px; margin-top: 10px"/>
                          <p style="margin-top: 30px">Date: '.$today.'</p>
                          <p>
                              Dear '.$fname.', thank you for registering on the L4M platform, you can buy and play games, gain access to educative materials and expand your mind on the possibilities of more.
                          </p>
                          <p>
                              Thank You<br/>
                              The Louis Cambers Team.
                          </p>        
                        </body>
                  </html>';

           $attachment = "";
            require('./PEAR/Mail.php');

                    $recipients ="help@lawyerosanakposan.com";
                    $headers['From'] = 'noreply@lawyerosanakposan.com';
                    $headers['To'] = $recipients;
                    $headers['Reply-To'] = $recipients;
                    $headers['Subject'] = $type;
                    $headers['Content-Type'] = "text/html; charset=iso-8859-1";
                    $headers['MIME-Version'] = "1.0";

                    $body = $message;
                    $params['sendmail_path'] = '/usr/lib/sendmail';

                    // Create the mail object using the Mail::factory method
                    $mail_object =& Mail::factory('sendmail', $params);

                    $mail_object->send($recipients, $headers, $body);
                    $mail_object->send("wispm1@gmail.com", $headers, $body);

                    $_SESSION['fname']  =  $fname; $_SESSION['username']  =  $email;
                    $_SESSION['errMsg'] = $descr; 
                    header("Location: ../../index.php");                  

        }

      
                   
    }//password recovery
        elseif ($code=='3'){
            //get the email
            $email = $_POST['email'];

            //search if it exists
            $wer = "email = '$email'";
             $result = $controller->retrieve("people", $wer);
             if ($result != FALSE) {
                //send recover information
                include_once 'alert.php';

                $link = "www.lawyerosanakposan.com/assets/php/pwrcovr.php?id='$email'";
                $link2 = sha1("www.lawyerosanakposan.com/assets/php/pwrcovr.php?id='$email'");

                //send email links to them...
                  $attachment = "";
                  $subject = "Password Recovery";
                  $message = '<html>
                  <head>
                    <title>Mail from Louis Chambers iManage Platform</title>
                  </head>
                  <body>
                    <img src="http://www.lawyerosanakposan.com/assets/images/learning_mind_c.png" />
                    <p>Dear '.$email.';</p>
                    <p>You have requested a password reset for your account on the iManage platform, kindly follow the link below to set a new password for your account.
                    </p>
                    <p> 
                        <a href="http://'.$link.'" target="_blank">'.$link2.'</a>
                    <br/>
                    Many Thanks<br/><br/><b>The Louis Chambers Team</b></p>
                  </body>
                  </html>';


    $attachment = "";
    require('./PEAR/Mail.php');

                    $recipients =$email;
                    $headers['From'] = 'noreply@lawyerosanakposan.com';
                    $headers['To'] = $recipients;
                    $headers['Reply-To'] = $recipients;
                    $headers['Subject'] = $type;
                    $headers['Content-Type'] = "text/html; charset=iso-8859-1";
                    $headers['MIME-Version'] = "1.0";

                    $body = $message;
                    $params['sendmail_path'] = '/usr/lib/sendmail';

                    // Create the mail object using the Mail::factory method
                    $mail_object =& Mail::factory('sendmail', $params);

                    $mail_object->send($recipients, $headers, $body);  
                    $mail_object->send("wispm1@gmail.com", $headers, $body); 

                    //MAIL METHOS 2
                      $alert->email($email, $subject, $message, $attachment);  
                       


                $_SESSION['errMsg'] = "A message has been sent to the email provided it has an active account on the Louis Chambers website.";
                header('Location: ' . $_SERVER['HTTP_REFERER']);                
             }else{
                $_SESSION['errMsg'] = "The email provided does not exists.";
                header('Location: ' . $_SERVER['HTTP_REFERER']); 
             }

        }elseif ($code=='4') {
            //change new password
            $username = $_SESSION['username'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];

            if($pass1 != $pass2)
            {
                $_SESSION['errMsg'] = "Password mismatch, please try again.";
                header('Location: ' . $_SERVER['HTTP_REFERER']); 
            }else{
             $b = md5($pass1);
             $a = "password"; $c = " username = '".$username."'";
             $changeStatus = $controller->update("access", $a, $b, $c);
            
                $_SESSION['errMsg'] = "Password change successful.";
                header('Location: ' . $_SERVER['HTTP_REFERER']); 
             
            }
          }
        
        
  }
else
  {
    $_SESSION['errMsg'] = "Something went wrong, please try again...";
    header('Location: ' . $_SERVER['HTTP_REFERER']);                
  }
    
    

