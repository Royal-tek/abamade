<?php 
@session_start();
    include_once './funct.php';
    $funct = new funct();
    $funct->_construct();
   
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $pageLink = $_SERVER['HTTP_REFERER'];
        $username = ""; $sess = "";
        if(isset($_SESSION['username']))
        {
            $username = $_SESSION['username'];
            $cookie_name = $_SESSION['username'];
            $cookie_value = rand();
            $sess = setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        }elseif(isset($_SESSION['cookie_name']))
        {
            $cookie_name = $_SESSION['cookie_name'];
            $sess = $_COOKIE[$cookie_name];
        }else{
            $cookie_name = hexdec(rand(0,1000));
            $cookie_value = rand();
            $sess = setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            $_SESSION['cookie_name'] = $cookie_name;
        }


        $wer = "game = $id and sess = '$sess'";
        $result = $funct->dbController->retrieve("cart", $wer);
        if($result)
        {
            $_SESSION['cartErr'] = "This item has already been added to cart";
            header('Location: '.$pageLink);
        }else
        {
            $a = array("sess", "username", "game", "amount", "qty");
            $b = array("'$sess'", "'$username'", "'$id'", "''", "'1'");
            $result = $funct->dbController->insert("cart", $a, $b);
            $_SESSION['cartErr'] = "Item added to cart";
            header('Location: '.$pageLink);
        }


       
              
    }else{
        header('Location: ../index.php');
    }
    ?>