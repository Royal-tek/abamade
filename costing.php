<?php

    @session_start();

    require './php/funct.php';
    $fn = new funct();

    if(isset($_POST['shipBtn'])){
        $courier = $_POST['courier'];
        $city = $_POST['city'];
        $state = $_POST['state'];
    
        $cart = $fn->viewCart(session_id());
        $shipping = $ctotal = 0;

        foreach($cart as $key){
            $ct = (object) $key;
            $item = $fn->viewItem($ct->prod_id);

            $price = ($c = $fn->viewItemDiscount($ct->prod_id)) ? $fn->discount($item->price, $c->discount_rate) : $item->price;                                            
            $ctotal += ($price * $ct->qty); 
            
            $title = $fn->viewDeliveryTitles($state, $city, $item->id);
            $cost = $fn->viewDeliveryRating($courier, $title);
            $shipping += $cost->ratings;

        }
        $tax = ($ctotal*7.5)/100;                                    
        $gross = $ctotal+$shipping+$tax;
        
        
        $data = array('ship'=>number_format($shipping,2), 'total'=>number_format($gross, 2), 'pay'=>$gross);
       echo  json_encode($data);

    }

?>