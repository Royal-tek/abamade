<?php
@session_start();
include 'dbController.php';
$controller = new dbController();
$controllers = $controller->connect();

if(isset($_POST))
{
    $today = date('d-m-Y', time());
        
    if(isset($_SESSION['username']) || isset($_SESSION['cookie_name']))
    {
       if(isset($_SESSION['username']))
        {
            $username = $_SESSION['username'];
            $cookie_name = $_SESSION['username'];
            $sess = $_COOKIE[$cookie_name];
        }elseif(isset($_SESSION['cookie_name']))
        {
            $cookie_name = $_SESSION['cookie_name'];
            $sess = $_COOKIE[$cookie_name];
        }

        //codes here
        $ref = $_SESSION['ref'] =  dechex(time()); 
        $noCart = $_SESSION['noCart'];

        $email = addslashes($_POST['email']);
        $_SESSION['demail'] = $email;

       
        $amount = $_SESSION['damnt'];
         if($amount < 2500)
           {
               $damnt = $amount / 0.985;
               $_SESSION['damnt'] = $damnt * 100;
           }else
           {
               $damnt1 = $amount+100;
               $damnt = $damnt1 / 0.985;
               $_SESSION['damnt'] = $damnt * 100;
           }  


           //Send ref to transaction table             
          $a = array("transaction", "sess", "username", "amount", "qty", "status");
          $b = array("'$ref'", "'$sess'", "'$email'", "'$amount'", "'$noCart'", "'0'");
          $result = $controller->insert("transactions", $a, $b);
      
       
           header('Location: ./ppay/index.php');
           exit();

    }else{
      //Redirect
         $_SESSION['errMsg'] = "Something went wrong, please add items to cart to proceed";
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit(); 
    }
    }else{
     header('Location: ../../index.php');
      exit(); 
    }

      
    
    