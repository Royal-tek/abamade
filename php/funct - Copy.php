<?php
@session_start();
require_once 'dbController.php';
require_once 'tables.php';

class funct {

    var $dbController;
    function _construct()
    {
        $this->dbController = new dbController();
    }

/* HELPER FUNCTION */
    private function paymentStatus($state){
        switch ($state){
            case 0:
            return 'canceled';
            break;
            case 1:
            return 'pending';
            break;
            case 2:
            return 'successful';
            break;
            case 3:
            return 'completed';
            break;
            default:
            return 'rejected';
            break;
        }
    }

    public function orderStatus($state){
        switch ($state){
            case 0:
            return 'pending';
            break;
            case 1:
            return 'successful';
            break;
            case 2:
            return 'completed';
            break;
            case 3:
            default:
            return 'rejected';
            break;
        }
    }

    private function userStatus($state){
        switch (state){
            case 0:
            return 'inactive';
            break;
            case 1:
            return 'active';
            break;
            case 2:
            return 'verified';
            break;
            default:
            return 'unverified';
            break;
        }
    }

    public function getUserStatus($state){
        return $this->userStatus($state);
    }

    private function usersRole($role){
        switch ($role){
            case 0:
            return 'customer';
            break;
            case 1:
            return 'vendor';
            break;
            case 2:
            return 'admin';
            break;
            default:
            return 'anonymous';
            break;
        }
    }

    public function getUserRole($value){
        return $this->usersRole($value);
    }

    private function priority($value){
        switch ($role){
            case 1:
            return 'Featured';
            break;
            case 2:
            return 'Hot Deal';
            break;
            default:
            return 'Normal';
            break;
        }
    }

    public function getProductPriority($value){
        return $this->priority($value);
    }

    public function paragraph($str){
        $value = "";
        $string = explode("\n", $str);
        foreach ($string as $text){
            $value .= "<p>$text</p>";
        }
        return $value;
    }

    public function limitedWords($string, $limit){
        $text = strip_tags($string);

        $pattern = "/[^(\w|\d|\'|\"|\.|\!|\?|;|,|\\|\/|\-\-|:|\&|@)]+/";
        $words = preg_replace ($pattern, " ", $text);
        $words = explode(' ', $text);
        return implode(' ', array_slice($words, 0, $limit));
    }

    public function alert($message, $type="info"){
        return "
                <div class='alert alert-".$type." alert-dismissible fade show' role='alert'>
                    ".$message."
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
    }

    public function discountValue($price, $rate){
        $dis = ($price * $rate)/100;
        return ($price - $dis);
    }

    //end of helper functions



    // product category
    private function allSubCategory($ref){
        $this->_construct();
        $where = "ref = '".$ref."'";
        $result = $this->dbController->retrieve(CATEGORY, $where);
        $return = array();
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result)){
                extract($row);
                array_push($return , $row);
            }
        }
        return $return;
    }

    public function viewAllSubCategory($ref){
        return $this->allSubCategory($ref);
    }



    private function categoryList($level=0, $ref=0){
        $this->_construct();
        $where = "level = ".$level." and ref = ".$ref." and status= 1";
        $result = $this->dbController->retrieve(CATEGORY, $where);
        $return = '';
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                //check for sub count
                $where2 = "ref = ".$row['id']. " and Level >".$row['level']." and status=1" ;
                $res = $this->dbController->retrieve(CATEGORY, $where2);
                
                if ($res != FALSE){
                    $sub_style = (strtolower($row['cat_name']) == "electronics") ?  "flex-wrap": "sub-menu-2";
                    // display category
                    $return .= "<li class='menu-item'>
                                    <a href='shop.php?cat=".$row['id']."'>".$row['cat_name']."
                                        <i class='icon-chevron-right'></i>
                                    </a>
                                    <ul class='sub-menu ".$sub_style."'>
                                    ";
                                    
                    
                                while($r = mysqli_fetch_array($res))
                                {
                                    extract($r);
                                    
                                    $return .="<li>
                                                <a href='shop.php?cat=".$r['id']."'>
                                                    <span> <strong>".$r['cat_name']." </strong></span>
                                                </a>";
                                    
                                    if($check = $this->subCategory($r['level'], $r['id'])){
                                        
                                        $return .="<ul class='submenu-item'>". $check."</ul>";
                                    }
                                    $return .="</li>";
                                }
                    $return .="</ul></li>";
                }
                else{
                    //get sub caegory
                    $return .= "<li class='menu-item'>
                                    <a href='shop.php?cat=".$row['id']."'>".$row['cat_name']."
                                    </a>
                                </li>";

                }
                
                //call subcategory
            }
        }
        return $return;

    }

    public function doCategory($level, $ref){
        return $this->categoryList($level, $ref);
    }


    public function subCategory($level=1, $ref, $li_class="", $a_class=""){
        $this->_construct();
        $where = "level > ".$level." and ref = ".$ref." and status= 1";
        $result = $this->dbController->retrieve(CATEGORY, $where);
        if($result != FALSE)
        {
            $value = "";
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                $value .=  "<li class='".$li_class."'><a class='".$a_class."' href='shop.php?cat=".$row['id']."'>".$row['cat_name']."</a></li>";
                //$return[$count] = $value;
                //$count++;
            }
            return $value;
        }
        else{
            return FALSE;
        }
    }

    public function allCategory(){
        $this->_construct();
        $where = " 1";
        $result = $this->dbController->retrieve(CATEGORY, $where);

        $value =array(); $count = 0;
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                $value[$count] = $row;
                $count++;
            }
        }
        return $value;
    }

    private function categoryList2($level=0, $ref=0){
        $this->_construct();
        $where = "level = ".$level." and ref = ".$ref." and status= 1";
        $result = $this->dbController->retrieve(CATEGORY, $where);
        $return = '';
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                //check for sub count
                $where2 = "ref = ".$row['id']. " and Level >".$row['level']." and status=1" ;
                $res = $this->dbController->retrieve(CATEGORY, $where2);
                
                if ($res != FALSE){
                    $sub_style = (strtolower($row['cat_name']) == "electronics") ?  "flex-wrap": "sub-menu-2";
                    // display category
                    $return .= "<div class='mega-menu__item-box'>
                                    <span class='mega-menu__title'>".$row['cat_name']."</span>
                                    ";
                                    
                    
                                while($r = mysqli_fetch_array($res))
                                {
                                    extract($r);
                                    
                                    
                                }
                    $return .="</div>";
                }
                else{
                    //get sub caegory
                    $return .= "<div class='mega-menu__item-box/>
                                    <span class='mega-menu__title'>".$row['cat_name']."</span>
                                </div>";

                }
                
                //call subcategory
            }
        }
        return $return;

    }

    public function getdropdownMenu($level=0, $ref=0){
        return $this->categoryList2($level=0, $ref=0);
    }

    private function categoryDetail1($id){
        $this->_construct();
        $where = " id = '".$id."'";
        $return = array(); $count = 0;
        $result = $this->dbController->retrieve(CATEGORY, $where);
        if($result !=FALSE){
            while($row = mysqli_fetch_array($result)){
                extract($row);
                if($row['ref']){
                    array_push($return,  $row);
                    $where2 = "id= '".$row['ref']."'";
                    $res = $this->dbController->retrieve(CATEGORY, $where2);
                    if($res !=FALSE){
                        while($r = mysqli_fetch_array($res)){
                            extract($r);
                            $return[$count]['ref'] = $r['cat_name'];
                        }
                    }
                }
                else{
                    array_push($return,  $row);
                }

            }
        }
        return $return;
    }

    private function categoryDetail($id){
        $this->_construct();
        $where = " id = '".$id."'";
        $return = False;
        $result = $this->dbController->retrieve(CATEGORY, $where);
        if($result !=FALSE){
            while($row = mysqli_fetch_array($result)){
                extract($row);
                return $row;   
            }
        }
        return $return;
    }

    public function viewCategoryDetail($id){
        return $this->categoryDetail($id);
    }

    public function viewBreadCrumb($id, $loop=6){
        return $this->breadcrumb($id, $loop);
    }

    private function breadcrumb($id, $loop){
        $return = array();        
        for($i = 0; $i<=$loop; $i++){
            $br = $this->categoryDetail($id);

            $return[$i] = $br;
            
            if($br['ref'] <1){
                break;
            }
            else{
                $id = $br['ref'];
            }
        }
        return $return;
    }

    private function menuCategory(){
        $this->_construct();
        $where = "ref = 0 AND level = 0";
        $result = $this->dbController->retrieve(CATEGORY, $where);
        $return = array();
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                array_push($return , $row);
            }
        }
        return $return;
    }

    public function viewMenuCategory(){
        return $this->menuCategory();
    }



    // product functions

    public function allItem($id){
        $where = "cat_id ='".$id."'";
        $result = $this->dbController->retrieve(PRODUCT, $where);
        $return = array();
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                array_push($return, $row);
            }
        }
        return $return; 
    }

    private function getProducts($cat, $perPage, $offset, $priority){
        $this->_construct();
        $where = (isset($cat)) ? "cat_id ='".$cat."'" : 1;
        //if(isset($priority)) { $where = "priority_rate ='".$priority."'"; }
        
        if(isset($offset) && isset($perPage)) { $where .= " LIMIT ".$offset." , ".$perPage;}
        if(isset($perPage) && ! isset($offset)) { $where .= " LIMIT  ".$perPage;}

        $result = $this->dbController->retrieve(PRODUCT, $where);
        $return = array();

        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                array_push($return, $row);
            }
        }
        return $return;
    }

    public function viewProducts($category, $perPage=6, $offset=0, $priority=0){
        return $this->getProducts($category, $perPage, $offset, $priority);
    }

    private function getItem($id){
        $this->_construct();
        $where = "id = '".$id."'";
        $result = $this->dbController->retrieve(PRODUCT, $where);
        $return = array();
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                return $row;
            }
        }
        return $return;
    }

    public function viewItem($id){
        return $this->getItem($id);
    }

    private function getProductImages($id){
        $this->_construct();
        $where = "prod_id = '".$id."'";
        $result = $this->dbController->retrieve(PRODIMAGE, $where);
        
        $return = array();
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                array_push($return, $row);
            }
        }
        return $return;
    }

    public function viewProductImages($id){
        return $this->getProductImages($id);
    }


    //discount and featured items
    private function getDiscountItems(){
        $this->_construct();
        $var = "product AS P INNER JOIN discount AS D ON prod_id=P.id ";
        $where = " end_date > now() ";
        $result = $this->dbController->retrieve($var, $where);
        
        $return = array();
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                array_push($return, $row);
            }
        }
        return $return;
    }

    public function viewDiscountItems(){
        return $this->getDiscountItems();
    }

    private function checkDiscount($id){
        $this->_construct();
        $where = "prod_id = '".$id."' AND end_date > now() ";
        $result = $this->dbController->retrieve(DISCOUNT, $where);
        $return = FALSE;
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                return $row;
            }
        }
        return $return;
    }

    public function viewItemDiscount($id){
        return $this->checkDiscount($id);
    }

    private function recentProduct($limit = 9){
        $where = "";
    }

    private function getItemByType($type, $limit){
        $this->_construct();
        $where = " priority_rate = '".$type."' ORDER BY id DESC LIMIT $limit";
        $result = $this->dbController->retrieve(PRODUCT, $where);
        
        $return = array();
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                array_push($return, $row);
            }
        }
        return $return;
    }
    
    public function viewItemsByType($type, $limit){
        return $this->getItemByType($type, $limit);
    }

    //cart functions 

    private function add2Cart($session, $item, $qty){
        $this->_construct();
        $where = "session_id ='".$session."' AND prod_id='".$item."'";
        $result = $this->dbController->retrieve(CART, $where);
        if($result){
            $row = mysqli_fetch_array($result);
            $qty +=$row['qty'];
            ///update
            $updateColumn = "qty";
            $result2 = $this->dbController->update(CART, $updateColumn, $qty, $where);
            if($result2){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        else{
            $aa = array("session_id, prod_id, qty");
            $bb = array("'$session'", "'$item'", "'$qty'");
            $res = $this->dbController->insert(CART, $aa, $bb);
            
            if($res){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
    }

    public function addCart($session, $item, $qty=1){
        return $this->add2Cart($session, $item, $qty);
    }

    private function getCart($session){
        $this->_construct();
        $where = "session_id ='".$session."'";
        $result = $this->dbController->retrieve(CART, $where);
        
        $return = array();
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                array_push($return, $row);
            }
        }
        return $return;
    }

    public function viewCart($session){
        return $this->getCart($session);
    }

    private function getCartFullDetail(){
        $total = 0;
        $cart = "";
    }

    private function cart2Order($session, $uid, $amt, $mode){
        $cart = $this->getCart($session);
        $orderNo = time();
        $order_id = "";


        if($cart){
            $aa = array("order_no, amount, user_id, payment_id");
            $bb = array("'$orderNo'", "'$amt'", "'$uid'", "'$mode'");
            $order_id = $this->dbController->insert(ORDERS, $aa, $bb);
            // create order
            foreach($cart as $order){
                $a = array("order_id, prod_id, qty");
                $b = array("'$order_id'", "'{$order['prod_id']}'", "'{$order['qty']}'");
                $result = $this->dbController->insert(DETAIL, $a, $b);
            }
        }
        if($order_id){
            $empty = $this->emptyCart($session);
        }
        return $order_id;
    }

    public function placeOrder($session, $uid, $amt, $mode){
        return $this->cart2Order($session, $uid, $amt, $mode);
    }

    private function emptyCart($session){
        $where = "session_id ='".$session."'";
        $result = $this->dbController->delete(CART, "", $where);
        if($result){
            return TRUE;
        }
        return FALSE;
    }

    // wishlist methods
private function add2Wish($session, $item){
    $this->_construct();
    $where = "session_id ='".$session."' AND prod_id='".$item."'";
    $result = $this->dbController->retrieve(WISH, $where);
    $user = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 0;
    if($result){
       return FALSE;
    }
    else{
        $aa = array("session_id, prod_id, user_id");
        $bb = array("'$session'", "'$item'", "'$user'");
        $res = $this->dbController->insert(WISH, $aa, $bb);
        
        if($res){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
}

public function addWish($session, $item){
    return $this->add2Wish($session, $item);
}

private function getwish($session){
    $this->_construct();
    $where = "session_id ='".$session."'";
    $result = $this->dbController->retrieve(WISH, $where);
    
    $return = array();
    if($result != FALSE)
    {
        while($row = mysqli_fetch_array($result))
        {
            extract($row);
            array_push($return, $row);
        }
    }
    return $return;
}

public function viewWish($session){
    return $this->getWish($session);
}

//order methods

private function getOrderDetail($id){
    $this->_construct();
    $where = "order_id ='".$id."'";
    $return = array();
    if($result = $this->dbController->retrieve(DETAIL, $where)){
        while($row = mysqli_fetch_array($result)){
            extract($row);
            array_push ($return, $row);
        }
    }
    return $return;
}

public function viewOrderDetail($id){
    return $this->getOrderDetail($id);
}

private function getOrder($id, $number){
    $this->_construct();
    $where = ($id) ? "id ='".$id."'" : "order_no ='".$number."'";
    
    if($result = $this->dbController->retrieve(ORDERS, $where)){
        while($row = mysqli_fetch_array($result)){
            extract($row);
            return $row;
        }
    }
    return FALSE;
}

public function viewOrder($id, $number=0){
    return $this->getOrder($id, $number);
}

private function getmyOrders($user){
    $this->_construct();
    $where = "user_id='".$user."'";
    $return = array();
    if($result = $this->dbController->retrieve(ORDERS, $where)){
        while($row = mysqli_fetch_array($result)){
            extract($row);
            array_push($return , $row);
        }
    }
    return $return;
}

public function viewMyOrders($user){
    return $this->getmyOrders($user);
}

private function createOrderTb($cols, $values){
    $this->_construct();
    if($order_id = $this->dbController->insert(ORDERS, $cols, $values)){
        return $order_id;
    }
    else{
        return FALSE;
    }
}

public function doCreateOrder($cols, $values){
    return $this->createOrderTb($cols, $values);
}

private function createODetail($session, $orderID){
    $this->_construct();
    $cart = $this->getCart($session);

    if($cart){
        foreach($cart as $ct){
            $a = array("order_id, prod_id, qty");
            $b = array("'$orderID'", "'{$ct['prod_id']}'", "'{$ct['qty']}'");
            $result = $this->dbController->insert(DETAIL, $a, $b);
        }
    }
    return $cart;
}

public function doCreateOdetail($session, $orderID){
    return $this->createODetail($session, $orderID);
}

private function deleteOrderedItemsinCart($orderID,  $session){
    $this->_construct();
    if($orderItems = $this->getOrderDetail($orderID)){
        foreach($orderItems as $OI){
            $where = "prod_id ='".$OI['prod_id']."' AND session_id ='".$session."'";
            $result = $this->dbController->delete(CART, "", $where);
        }
        return TRUE;
    }
    return FALSE;
}

public function doDeleteOItemInCart($orderID,  $session){
    return $this->deleteOrderedItemsinCart($orderID,  $session);
}

private function updateOrder($status, $payment, $shipment, $id){
    $this->_construct();
    $set = "status='".$status."', payment_id = '".$payment."', ship_id='".$shipment."'";
    $where = "id ='".$id."'" ;

    if($result = $this->dbController->edit(ORDERS, $set, $where))
    {
        return TRUE;
    }

    return FALSE;
}

public function orderContents($id){
    $tr = "";
    $n = 1;
    if($orders = $this->getOrderDetail($id)){
        foreach($orders as $o){
           $itm = $this->getItem($o['prod_id']);
           $tr .="<tr>
                        <td>".$n."</td>
                        <td>".$itm['prod_name']."</td>
                        <td>".number_format($itm['price'])."</td>
                        <td>".$o['qty']."</td>
                        <td>".number_format($itm['price']*$o['qty'])."</td>
                    </tr>";
            $n++;
        }
    }
    return $tr;
}
    
public function doUpdateOrder($status, $payment, $shipment, $id){
    return $this->updateOrder($status, $payment, $shipment, $id);
}

private function getShipment($id){
    $this->_construct();
    $where = "id ='".$id."'";
    if($result = $this->dbController->retrieve(SHIPMENT, $where)){
        while($row = mysqli_fetch_array($result)){
            extract($row);
            return $row;
        }
    }

    return FALSE;
}

public function viewShipment($id){
    return $this->getShipment($id);
}

//users activities
private function getUserby($by, $string){
    $this->_construct();
    $where = " ".$by." ='".$string."'";
    $result = $this->dbController->retrieve(USERS, $where);

    if($result){
        while($row = mysqli_fetch_array($result))
        {
            extract($row);
            return $row;
        }
    }
    return FALSE;
}

public function viewUserby($clause, $string){
    return $this->getUserby($clause, $string);
}

private function getAccess($username, $pwd){
    $this->_construct();
    $where = "username = '".$username."' OR email = '".$username."' AND password='".$pwd. "'";
    $result = $this->dbController->retrieve(USERS, $where);
    if($result){
        while($row = mysqli_fetch_array($result))
        {
            extract($row);
            return $row;
        }
    }
    return FALSE;
}

private function getPassword($user){
    $this->_construct();
    $where = "id = '".$user."'";
    $result = $this->dbController->retrieve(USERS, $where);
    if($result){
        while($row = mysqli_fetch_array($result))
        {
            extract($row);
            return $row['password'];
        }
    }
    return FALSE;
}

public function viewPasword($id){
    return $this->getPassword($id);
}

public function viewUser($user, $pwd){
    return $this->getAccess($user, $pwd);
}

private function getCustomer($userid){
    $this->_construct();
    $where = "user_id = '".$userid."'";
    $result = $this->dbController->retrieve(CUSTOMERS, $where);
    if($result){
        while($row = mysqli_fetch_array($result))
        {
            extract($row);
            return $row;
        }
    }
    return FALSE;
}

public function viewCustomer($id){
    return $this->getCustomer($id);
}

private function getBlogCategory(){
    $this->_construct();
    $where = "status = 1";
    $result = $this->dbController->retrieve(BLOGCAT, $where);
    $return = array();
    if($result){
        while($row = mysqli_fetch_array($result))
        {
            extract($row);
            array_push($return, $row);
        }
    }
    return $return;
}

public function viewBlogCategory(){
    return $this->getBlogCategory();
}

private function getBlogs($id, $perPage, $offset){
    $this->_construct();
    $where = (($id)) ? "blog_cat ='".$id."'" : 1;
    $where .=" ORDER BY (id) DESC";
    if(!empty($offset) || !empty($perPage)) { $where .= " LIMIT ".$offset." , ".$perPage;}

     
    $result = $this->dbController->retrieve(BLOG, $where);
    $return = array();

    if($result != FALSE)
    {
        while($row = mysqli_fetch_array($result))
        {
            extract($row);
            array_push($return, $row);
        }
    }
    return $return;
}

public function viewBlogs($id=0, $perPage=0, $offset=0){
    return $this->getBlogs($id, $perPage, $offset);
}

private function getABlog($id){
    $this->_construct();
    $where = "id ='".$id."'";
    $result = $this->dbController->retrieve(BLOG, $where);
    if($result != FALSE){
        while($row = mysqli_fetch_array($result))
        {
            extract($row);
            return  $row;
        }
    }
    return FALSE;
}

public function viewSingleBlog($id){
    return $this->getABlog($id);
}

private function getBlogComment($id){
    $this->_construct();
    $where = "blog_id ='".$id."' ORDER BY id DESC";
    $result = $this->dbController->retrieve(COMMENTS, $where);
    $return = array();
    if($result != FALSE){
        while($row = mysqli_fetch_array($result))
        {
            extract($row);
            array_push($return, $row);
        }
    }
    return $return;
}

public function viewBlogComment($id){
    return $this->getBlogComment($id);
}

private function recentBlog($id, $limit){
    $this->_construct();
    $where = (($id)) ? "blog_cat ='".$id."' ORDER BY (id) DESC" : "1 ORDER BY (id) DESC";
    $where .=" LIMIT ".$limit;

    $result = $this->dbController->retrieve(BLOG, $where);
    $return = array();

    if($result != FALSE)
    {
        while($row = mysqli_fetch_array($result))
        {
            extract($row);
            array_push($return, $row);
        }
    }
    return $return;
}

public function viewRecentBlog($id=0, $limit=4){
    return $this->recentBlog($id, $limit);
}




    



/*UNIQUE USER MENU AND DASHBOARD*/

public function getUserMenu($role)
{
  return $this->getUsrMenu($role);
}

private function getUsrMenu($role)
{
 switch ($role) {
    case '1':
      return "sidemenu.php";
      break;
    case '2':
      return "staffSide.php";
      break;    
    default:
      # code...
      break;
  }
}


public function getDashboardTab($role)
{
  return $this->getDashboard($role);
}

private function getDashboard($role)
{
 switch ($role) {
   case '1':
      return "admDash.php";
      break;
    case '2':
      return "staffDash.php";
      break;
    default:
      # code...
      break;
  }
}


//function to get active slides
public function getSlides(){ return $this->getSlides1(); }
private function getSlides1()
{
  $this->_construct();
  $where = "id > 0 and status= 0";
  $result = $this->dbController->retrieve(SLIDES, $where);
  if($result != FALSE)
  {
    $slides = array(); $count = 0;
   while($row = mysqli_fetch_array($result))
    {
       extract($row);
     
       $a = $b = ""; $c = $d = ""; 
       $a = $row['text1']; $b = $row['text2']; $d = $row['descr'];

       if(!empty($row['page']))
              { 
                $c = '<div class="main-slider-two__button-box text-center">
                        <a href="'.$row['page'].'" class="thm-btn">'.$row['descr'].'</a>
                        <a href="judgements.php" class="thm-btn-success" > <span class="icon-shopping-cart"></span> Quick Access to Supreme Court Decisions on Legal Issues</a>
                      </div>';
              }

       $value = '<div class="swiper-slide">
                        <div class="image-layer"
                            style="background-image: url(assets/images/backgrounds/'.$row['pix'].');"></div>
                        <div class="image-layer-overlay"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-slider-two__content text-center">
                                        <h2 class="main-slider-two__tagline">'.$a.'</h2>
                                        <h2 class="main-slider__title">'.$b.'</h2>
                                    </div>
                                    '.$c.'
                                    
                                </div>
                            </div>
                        </div>
                    </div>';
      $slides[$count] = $value;
      $count++;
    }
    return $slides;
  }  
}

//function to get download info
public function getFileDwnload($ref, $email){ return $this->getFileDwnloads($ref, $email); }
private function getFileDwnloads($ref, $email)
{
  $this->_construct();
  $where = "transaction = '$ref' and username = '$email'";
  $result = $this->dbController->retrieve("sales", $where);
  $abouts = array(); 
  if($result != FALSE)
  {
    $count = 0;
   while($row = mysqli_fetch_array($result))
    {
        extract($row);
        $did = $row['id'];
        $art = $row['game'];
        $stat =  $row['status']; 
        if($stat < 3){
        $dart = $this->getOneArt($art);
        $value = "<tr>
                  <td>".$dart['title']."</td>
                  <td><a href='www.lawyerosanakposan.com/assets/images/resources/'".$dart['scjs']." target='_blank'>GET FILE</a></td>
                  </tr>";
        $abouts[$count] = $value;
        //update the status
        $whe = "id = $did";
        $update = $this->dbController->update("sales", "status", "3", $whe);
      }
    }
    
  }
  return $abouts;
    
}


//function to get abount info
public function getAbtUs(){ return $this->getAbtUss(); }
private function getAbtUss()
{
  $this->_construct();
  $where = "id = 1";
  $result = $this->dbController->retrieve(ABT, $where);
  if($result != FALSE)
  {
    $abouts = array(); $count = 0;
   while($row = mysqli_fetch_array($result))
    {
       extract($row);
        $value = $row['about'];
        $abouts['0'] = $this->limit_words($value, 375);
        $abouts['1'] = $value;
    }
    return $abouts;
  }
    
}


//function to get active games
public function getGames($lim){ return $this->getGame($lim); }
private function getGame($lim)
{
  $this->_construct();
  $where = "id > 0 and status= 0 order by id ASC limit $lim";
  $result = $this->dbController->retrieve(GAM, $where);
  if($result != FALSE)
  {
    $slides = array(); $count = 0;
   while($row = mysqli_fetch_array($result))
    {
       extract($row);
        $value = ' <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="0ms"
                        data-wow-duration="1000ms">
                        <div class="courses-one__single">
                            <a href="practice_area.php"><div class="courses-one__single-img">
                                <img src="assets/images/resources/'.$row['pix'].'" alt="4tress" />
                                <div class="overlay-text">
                                    <p>Featured</p>
                                </div>
                            </div></a>
                            <div class="courses-one__single-content">
                                <h3 class="courses-one__single-content-title"><a href="practice_area.php">'.$this->limit_words($row['title'], 3).'</a></h3>
                                <!--<div class="courses-one__single-content-review-box">
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <div class="rateing-box">
                                        <span>(4)</span>
                                    </div>
                                </div>
                                <p class="courses-one__single-content-price">$30.00</p>
                                <ul class="courses-one__single-content-courses-info list-unstyled">
                                    <li><a href="game.php?id='.$row['id'].'" class="btn btn-primary btn-sm">Learn more</a></li>
                                    <li><a href="./assets/php/resolve.php?id='.$row['id'].'" class="btn btn-success btn-sm">Add To Cart</a></li>
                                </ul>-->
                            </div>
                        </div>
                    </div>';
      $slides[$count] = $value;
      $count++;
    }
    return $slides;
  }
    
}




//function to get active games
public function getGames2(){ return $this->getGame2(); }
private function getGame2()
{
  $this->_construct();
  $where = "id > 0 and status= 0 order by id ASC";
  $result = $this->dbController->retrieve(GAM, $where);
  if($result != FALSE)
  {
    $slides = array(); $count = 0; $var = TRUE;
   while($row = mysqli_fetch_array($result))
    {
       extract($row);
       if($var == TRUE)
       {
          $value = '<section class="welcome-one p-tb-100">
        <div class="container">
            <div class="row">               

                <div class="col-xl-7">
                    <div class="welcome-one__left p-r-50">
                        <div class="section-title">
                           <h2 class="section-title__title text-chili">'.$row['title'].'</h2>
                        </div>
                        <p class="welcome-one__left-text">
                            '.$row['descr'].'
                        </p>
                        <div class="row m-t-20">
                            '.$row['others'].'
                        </div>
                    </div>
                </div>
               
                <div class="col-xl-5">
                    <div class="welcome-one__right clearfix">
                        <div class="welcome-one__right-img1 wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
                            <div class="welcome-one__right-img1-inner">
                                <img src="assets/images/resources/'.$row['pix'].'" alt="'.$row['title'].'" />
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>';
                    $slides[$count] = $value;
                    $count++; $var = FALSE;

       }else
       {
        $value = '
    <section class="welcome-one p-tb-100" style="background: #f9f9f9">
        <div class="container">
            <div class="row">
                <!--Start Welcome One Right-->
                <div class="col-xl-5">
                    <div class="welcome-one__right clearfix">
                        <div class="welcome-one__right-img1 wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
                            <div class="welcome-one__right-img1-inner">
                                <img src="assets/images/resources/'.$row['pix'].'" alt="'.$row['title'].'" />
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Welcome One Right-->
                <div class="col-xl-7">
                    <div class="welcome-one__left p-l-50">
                        <div class="section-title">
                           <h2 class="section-title__title text-chili">'.$row['title'].'</h2>
                        </div>
                        <p class="welcome-one__left-text">
                            '.$row['descr'].'
                        </p>
                        <div class="row m-t-20">                           
                        '.$row['others'].'
                            
                    </div>
                </div>
              </div>
        </div>
    </section>';
        $slides[$count] = $value;
        $count++; $var = TRUE;
       }
        
      
    }
    return $slides;
  }
    
}





//function to get active index blogs
public function getIndBlogs1($lim){ return $this->getIndBlog1($lim); }
private function getIndBlog1($lim)
{
  $this->_construct();

  $where = "id > 0 order by id DESC limit $lim";  
  $result = $this->dbController->retrieve(NEWS, $where);
  $slides = array();
  if($result != FALSE)
  {
     $count = 0;
   while($row = mysqli_fetch_array($result))
    {
        extract($row);
         $value = ' <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="blog-one__single">
                            <div class="blog-one__single-img">
                                <img src="assets/images/blog/'.$row['image'].'" alt="" />
                            </div>
                            <div class="blog-one__single-content">
                                <div class="blog-one__single-content-overlay-mata-info">
                                    <ul class="list-unstyled">
                                        <li><a href="#"><span class="icon-clock"></span>'.date('d M, Y', strtotime($row['whens'])).'</a></li>
                                        <li><a href="#"><span class="icon-user"></span>Admin </a></li>
                                        <!--<li><a href="#"><span class="icon-chat"></span> Comments</a></li>-->
                                    </ul>
                                </div>
                                <h2 class="blog-one__single-content-title"><a href="blog_detail.php?id='.$row['id'].'">'.$row['title'].'</a></h2>
                                <!--<p class="blog-one__single-content-text">echo descr
                                </p>-->
                            </div>
                        </div>
                    </div>';
      $slides[$count] = $value;
      $count++;
    }
    
  }
  return $slides;
    
}


//function to get active index blogs
public function getIndBlogs($lim){ return $this->getIndBlog($lim); }
private function getIndBlog($lim)
{
  $this->_construct();

  $where = "id > 0 order by id DESC limit $lim";  
  $result = $this->dbController->retrieve(NEWS, $where);
  $slides = array();
  if($result != FALSE)
  {
     $count = 0;
   while($row = mysqli_fetch_array($result))
    {
        extract($row);
         $value = ' <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="blog-one__single">
                            <div class="blog-one__single-img">
                                <img src="assets/images/blog/'.$row['image'].'" alt="" />
                            </div>
                            <div class="blog-one__single-content">
                                <div class="blog-one__single-content-overlay-mata-info">
                                    <ul class="list-unstyled">
                                        <li><a href="#"><span class="icon-clock"></span>'.date('d M, Y', strtotime($row['whens'])).'</a></li>
                                        <li><a href="#"><span class="icon-user"></span>Admin </a></li>
                                        <!--<li><a href="#"><span class="icon-chat"></span> Comments</a></li>-->
                                    </ul>
                                </div>
                                <h2 class="blog-one__single-content-title"><a href="blog_detail.php?id='.$row['id'].'">'.$row['title'].'</a></h2>
                                <!--<p class="blog-one__single-content-text">echo descr
                                </p>-->
                            </div>
                        </div>
                    </div>';
      $slides[$count] = $value;
      $count++;
    }
    
  }
  return $slides;
    
}




//get single game given id
public function getOneGame($id)
{
  return $this->getOneGames($id);
}
private function getOneGames($id)
{
  $where = "id = '$id' and status = 0";
  $result = $this->dbController->retrieve(GAM, $where);
  $dGame = array();
  if($result != FALSE)
  {
    $row = mysqli_fetch_array($result);
    $dGame['id'] = $row['id'];
    $dGame['title'] = $row['title'];
    $dGame['descr'] = $row['descr'];
    $dGame['tagline'] = $row['tagline'];
    $dGame['pix'] = $row['pix'];
    $dGame['pix2'] = $row['pix2'];
    $dGame['page'] = $row['page'];
    $dGame['amount'] = $row['amount'];
    $dGame['duration'] = $row['duration'];
    $dGame['age'] = $row['age'];
    $dGame['player'] = $row['player'];
    $dGame['token'] = $row['token'];
    $dGame['gtype'] = $row['gtype'];
    $dGame['board'] = $row['board'];
    $dGame['others'] = $row['others'];
    $dGame['status'] = $row['status'];
    $dGame['whens'] = $row['whens'];
    return $dGame;
  }
}




//function to get other games
public function getOtherGam($id){ return $this->getOtherGams($id); }
private function getOtherGams($id)
{
  $this->_construct();
  $where = "id != '$id'";
  $result = $this->dbController->retrieve(GAM, $where);
  if($result != FALSE)
  {
    $slides = array(); $count = 0;
   while($row = mysqli_fetch_array($result))
    {
       extract($row);
      $value = '<li class="course-details__new-courses-list-item">
                                    <div class="course-details__new-courses-list-item-img">
                                        <img src="assets/images/resources/'.$row['pix'].'" alt="" width=66px height=66px/>
                                    </div>
                                    <div class="course-details__new-courses-list-item-content">
                                        <h4 class="course-details__new-courses-list-item-content-title"><a href="game.php?id='.$row['id'].'">'.$row['title'].'</a></h4>
                                        <div class="course-details__new-courses-rateing-box">
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                            </ul>
                                            <div class="course-details__new-courses-rateing-count">
                                                <span>(4)</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </li>';
      $slides[$count] = $value;
      $count++;
    }
    return $slides;
  }
    
}


//get single game given id
public function getOneBlog($id)
{
  return $this->getOneBlogs($id);
}
private function getOneBlogs($id)
{
  $where = "id = '$id'";
  $result = $this->dbController->retrieve(NEWS, $where);
  $dGame = array();
  if($result != FALSE)
  {
    $row = mysqli_fetch_array($result);
    $dGame['id'] = $row['id'];
    $dGame['title'] = $row['title'];
    $dGame['descr'] = $row['descr'];
    $dGame['image'] = $row['image'];
    $dGame['owner'] = $row['owner'];
    $dGame['whens'] = $row['whens'];
    return $dGame;
  }
}




//function to get other news
public function getOtherNew($id){ return $this->getOtherNews($id); }
private function getOtherNews($id)
{
  $this->_construct();
  $where = "id != '$id'";
  $result = $this->dbController->retrieve(NEWS, $where);
  if($result != FALSE)
  {
    $slides = array(); $count = 0;
   while($row = mysqli_fetch_array($result))
    {
       extract($row);
      $value = '<li>
                                    <div class="sidebar__post-image">
                                        <img src="assets/images/blog/'.$row['image'].'" alt="" width=66 height=66>
                                    </div>
                                    <div class="sidebar__post-content">
                                        <ul class="list-unstyled">
                                            <li>
                                                 <p><a href="blog_detail.php?id='.$row['id'].'"><i class="far fa-user-circle"></i>Admin</a></p>
                                              <h3><a href="blogs_details.php?id='.$row['id'].'">'.$this->limit_words($row['title'], 5).'</a></h3>
                                            </li>
                                        </ul>
                                    </div>
                                </li>';
      $slides[$count] = $value;
      $count++;
    }
    return $slides;
  }
    
}


//function to get game comments
public function getGameComms($id){ return $this->getGameComm($id); }
private function getGameComm($id)
{
  $this->_construct();
  $where = "id = '$id'";
  $result = $this->dbController->retrieve(COMM, $where);
   $slides = array();
  if($result != FALSE)
  {
   $count = 0;
   while($row = mysqli_fetch_array($result))
    {
       extract($row);
      $value = '<div class="course-details__comment-single">
                                    <div class="course-details__comment-img">
                                        <img src="assets/images/resources/comm.png" alt=""/>
                                    </div>
                                    <div class="course-details__comment-text">
                                        <div class="course-details__comment-text-top">
                                            <h3 class="course-details__comment-text-name">'.$row['user'].'</h3>
                                            <p>'.date("d M, Y", strtotime($row['whens'])).'</p>
                                            <div class="course-details__comment-review-stars">
                                                <i class="fas fa-star"></i><!-- /.fas fa-star -->
                                                <i class="fas fa-star"></i><!-- /.fas fa-star -->
                                                <i class="fas fa-star"></i><!-- /.fas fa-star -->
                                                <i class="fas fa-star"></i><!-- /.fas fa-star -->
                                                <i class="fas fa-star"></i><!-- /.fas fa-star -->
                                            </div>
                                        </div>
                                        <p class="course-details__comment-text-bottom">'.$row['comment'].'</p>
                                    </div>
                                </div>';
      $slides[$count] = $value;
      $count++;
    }
   
  }
   return $slides;
    
}


//function to get team
public function getTeam()
{
  return $this->getdTeam();
}
private function getdTeam()
{
  $this->_construct();
  $where = "id > 0 order by id ASC";
  $result = $this->dbController->retrieve(TEAM, $where);
  if($result != FALSE)
  {
    $dteam = array(); $count = 0;
   while($row = mysqli_fetch_array($result))
    {
       extract($row);
       $value = '<div class="col-xl-4 col-lg-4">
                   <div class="meet-teachers-one__single wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                       <div class="meet-teachers-one__single-img">
                           <img src="assets/images/team/'.$row['pix'].'" alt="'.$row['name'].'"/>
                       </div>

                       <div class="meet-teachers-one__single-content">
                           <div class="meet-teachers-one__single-middle-content">
                               <div class="title">
                                   <h4><a href="team_detail.php?id='.$row['id'].'">'.$row['name'].'</a></h4>
                                   <p>'.$row['title'].'</p>
                               </div>
                                <!-- <p class="meet-teachers-one__single-content-text">There are many varia of passages the free ipsum lorem.</p>-->
                           </div>
                       </div>
                   </div>
               </div>';
      $dteam[$count] = $value;
      $count++;
    }
    return $dteam;
  }
    
}



//get single team member given id
public function getOneTeam($id)
{
  return $this->getOneTeams($id);
}
private function getOneTeams($id)
{
  $where = "id = '$id'";
  $result = $this->dbController->retrieve(TEAM, $where);
  $dGame = array();
  if($result != FALSE)
  {
    $row = mysqli_fetch_array($result);
    extract($row);
    $dGame['id'] = $row['id'];
    $dGame['title'] = $row['title'];
    $dGame['descr'] = $row['descr'];
    $dGame['pix'] = $row['pix'];
    $dGame['name'] = $row['name'];
    $dGame['practice'] = $row['practice'];
    return $dGame;
  }
}



//function to get team
public function getTeam2($id)
{
  return $this->getdTeam2($id);
}
private function getdTeam2($id)
{
  $this->_construct();
  $where = "id != '$id'";
  $result = $this->dbController->retrieve(TEAM, $where);
  if($result != FALSE)
  {
    $dteam = array();
    $count = 0;
   while($row = mysqli_fetch_array($result))
    {
       extract($row);
       $value = '<div class="col-xl-4 col-lg-4">
                    <div class="meet-teachers-one__single wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <a href="team_detail.php?id='.$row['id'].'">
                        <div class="meet-teachers-one__single-img">
                            <img src="assets/images/team/'.$row['pix'].'" alt="'.$row['name'].'"/>
                        </div></a>
                        <div class="meet-teachers-one__single-content">
                            <div class="meet-teachers-one__single-middle-content">
                                <div class="title">
                                    <h4><a href="team_detail.php?id='.$row['id'].'">'.$row['name'].'</a></h4>
                                   <p>'.$row['title'].'</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>';
      $dteam[$count] = $value;
      $count++;
    }
    return $dteam;
  }
    
}



//function to get judgements
public function getArts()
{
  return $this->getArt();
}
private function getArt()
{
  $this->_construct();
  $where = "id > 0 order by id DESC";
  $result = $this->dbController->retrieve(ART, $where);
  if($result != FALSE)
  {
    $news = array(); $count = 0; $a = '<div class="overlay-text">
                                <p>New</p>
                            </div>';
   while($row = mysqli_fetch_array($result))
    {
       extract($row);
       if($count > 2){$a = "";}
       $value = '<div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="0ms"
                     data-wow-duration="1000ms">
                    <div class="courses-one__single mb-4">
                        <div class="courses-one__single-img">
                            <img src="assets/images/backgrounds/10.jpg" alt="" />
                            '.$a.'
                        </div>
                        <div class="courses-one__single-content">
                            <h4 class="courses-one__single-content-title"><a href="judgement_detail.php?id='.$row['id'].'">'.$row['title'].'</a></h4>
                            <!--<div class="courses-one__single-content-review-box">
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <div class="rateing-box">
                                    <span>(4)</span>
                                </div>
                            </div>-->
                            <p class="courses-one__single-content-price">&#8358;'.$row['amount'].'</p>
                            <ul class="courses-one__single-content-courses-info list-unstyled">
                                <li><a href="judgement_detail.php?id='.$row['id'].'" class="btn btn-sm btn-danger">See Details</a></li>
                                <li><a href="./assets/php/resolve.php?id='.$row['id'].'" class="btn btn-success btn-sm">Add To Cart</a></li>
                            </ul>
                        </div>
                    </div>
                </div> ';
      $news[$count] = $value;
      $count++;
    }
    return $news;
  }
    
}




//get single game given id
public function getOneArt($id)
{
  return $this->getOneArts($id);
}
private function getOneArts($id)
{
  $where = "id = '$id'";
  $result = $this->dbController->retrieve(ART, $where);
  $dGame = array();
  if($result != FALSE)
  {
    $row = mysqli_fetch_array($result);
    extract($row);
    $dGame['id'] = $row['id'];
    $dGame['title'] = $row['title'];
    $dGame['name'] = $row['name'];
    $dGame['descr'] = $this->limit_words($row['descr'], 100);
    $dGame['amount'] = $row['amount'];
    $dGame['scjs'] = $row['file'];
    $dGame['whens'] = $row['whens'];
   
    return $dGame;
  }
}






























//function to get testimonials
public function getTestimonials()
{
  return $this->getTestimonial();
}
private function getTestimonial()
{
  $this->_construct();
  $where = "id > 0 order by id DESC";
  $result = $this->dbController->retrieve(TESTI, $where);
  if($result != FALSE)
  {
    $dteam = array(); $count = 0;
   while($row = mysqli_fetch_array($result))
    {
       extract($row);
       if(empty($row['pix'])){$row['pix'] = "avatar.png";}
       $value = '<div class="review__item">
                  <div class="review__photo"><img src="assets/media-demo/testimonials/'.$row['pix'].'" alt="Testimonials" class="review__photo-img"></div>
                  <div class="review__details"><span class="review__name">'.$row['fullname'].'</span><span class="review__post">'.$row['position'].'</span>
                    <div class="review__stars"><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i></div>
                  </div>
                  <div class="review__info">
                    <div class="review__info-quote review__info-quote--open">&rdquo;</div>
                    <p>'.$row['testimony'].'
                    </p>
                    <div class="review__info-quote review__info-quote--close">&ldquo;</div>
                  </div>
                  <div class="clearfix"></div>
                  
                </div>';
      $dteam[$count] = $value;
      $count++;
    }
    return $dteam;
  }
    
}






/*ADMINISTRATIVE & GENERAL FUNCTIONS */

//function to get total number of persons
public function getTotalMembers(){ return $this-> gettmem(); }
private function gettmem()
{
  $this->_construct();
  $result = $this->dbController->counter(PEOPLE);
  return $result;
}

//function to get total number of properties
public function getTotalServices(){ return $this-> gettServ(); }
private function gettServ()
{
  $this->_construct();
  $result = $this->dbController->counter(PROPS);
  return $result;
}

//function to get total number of blogs
public function getTotalBlogs(){ return $this-> gettoBlg(); }
private function gettoBlg()
{
  $this->_construct();
  $result = $this->dbController->counter(NEWS);
  return $result;
}

//function to get total user reports
public function getTotalReports(){ return $this-> getTotalRpt(); }
private function getTotalRpt()
{
  $this->_construct();
  $result = $this->dbController->counter(REPT);
  return $result;
}

//function to get total cart count
public function getTotalCarts(){ return $this-> getTotalCart(); }
private function getTotalCart()
{
  $this->_construct();
  if(isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
    $wer = "username = '$username'";
    $result = $this->dbController->counter2(CARTS, $wer);

  }elseif(isset($_SESSION['cookie_name']))
  {
    $cookie_name = $_SESSION['cookie_name'];
    $sess = $_COOKIE[$cookie_name];
    $wer = "sess = '$sess'";
    $result = $this->dbController->counter2(CARTS, $wer);
  }else{
    $result = 0;
  }
  return $result;
}



//Get all cart
public function getAllCarts(){ return $this->getAllCart(); }
private function getAllCart()
{
   $this->_construct();
   if(isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
    $wer = "username = '$username'";
    $result = $this->dbController->retrieve(CARTS, $wer);

  }elseif(isset($_SESSION['cookie_name']))
  {
    $cookie_name = $_SESSION['cookie_name'];
    $sess = $_COOKIE[$cookie_name];
    $wer = "sess = '$sess'";
    $result = $this->dbController->retrieve(CARTS, $wer);
  }else{
    $result = FALSE;
  }
   
   $count = 0; $a = 1; $tot = 0;
   $dResult = array();  

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      $dart = $row['game'];
      $art = $this->getOneArts($dart);
     
      $value = '<tr>
                  <td class="p-3">'.$a.'</td>
                  <td class="p-3">'.$art['title'].'</td>
                  <td class="p-3">&#8358;'.$art['amount'].'</td>
                </tr>';
          $dResult[$count] = $value; 
          $count++; $a++; $tot = $tot + $art['amount'];
     }
 }
 $_SESSION['damnt'] = $tot;
 return $dResult;
}





//Get all activities
public function getAllActivities(){ return $this->getAllAct(); }
private function getAllAct()
{
   $this->_construct();
   $owner = $_SESSION['username'];
   $where = "id > 0 order by id DESC";   
   if($_SESSION['role']==2)
   {   
    $where = "username = '$owner' order by id DESC";
   }   

   $result = $this->dbController->retrieve(LOGS, $where);
   $count = 0; $a = 1;
   $dResult = array();

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      $person = $this->getUser($row['email']);
      $value = '<tr>                  
                  <th scope="row">'.$a.'</th>
                          <td>'.$person['name'].'</td>
                          <td>'.$row['descr'].'</td>
                          <td>'.date('d M, Y', strtotime($row['whens'])).'</td>
                      </tr>';
          $dResult[$count] = $value; 
          $count++; $a++;
     }
 }
 return $dResult;
}


//get user given phone or id
public function getUser($user)
{
  return $this->getdUser($user);
}
private function getdUser($user)
{
  $where = "id = '$user' or email = '$user'";
  $result = $this->dbController->retrieve(PEOPLE, $where);
  $dUser = array();
  if($result != FALSE)
  {
    $row = mysqli_fetch_array($result);
    $dUser['id'] = $row['id'];
    $dUser['name'] = $row['fullname'];
    $dUser['bio'] = $row['summary'];
    $dUser['email'] = $row['email'];
    $dUser['phone'] = $row['phone'];
    $dUser['type'] = $row['type'];
    $dUser['image'] = $row['pix'];
    $dUser['regDate'] = $row['whens'];
    return $dUser;
  }
}



//get blog given phone or id
public function getBlog($user)
{
  return $this->getdBlog($user);
}
private function getdBlog($user)
{
  $where = "id = '$user'";
  $result = $this->dbController->retrieve(NEWS, $where);
  $dUser = array();
  if($result != FALSE)
  {
    $row = mysqli_fetch_array($result);
    $dUser['id'] = $row['id'];
    $dUser['title'] = $row['title'];
    $dUser['descr'] = $row['descr'];
    $dUser['image'] = $row['image'];
    $dUser['whens'] = $row['whens'];
    return $dUser;
  }
}



//Get admin Properties
public function getAdmProps($role){ return $this->getAdmProp($role); }
private function getAdmProp($role)
{
   $this->_construct();
   $where = "type = $role order by id DESC";
   if(empty($role))
   {
     $where = "id > 0 order by id DESC";
   }
   $result = $this->dbController->retrieve(PROPS, $where);
   $count = 0; $a=1; $dResult = array();

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      extract($row);

      $typer = "Landed Property";
       extract($row);
       if($row['type']==1) {$typer = "Housing Property";}

      $oneProp = $this->getOneProp($row['title']);
      if(empty($row['pix'])){$row['pix'] = "default.jpg";}
    
        $value = '<div class="col-md-4">
                            <div class="card matchHeight">
                                <img class="card-img-top img-fluid" src="../assets/media-demo/properties/'.$row['pix'].'" alt="'.$row['title'].'">
                                <div class="card-body">
                                    <h5 class="card-title">'.$row['title'].'</h5>
                                    <p class="card-text">
                                        <small class="text-muted">Last updated '.date('d M, Y', strtotime($row['whens'])).'</small>
                                    </p>
                                </div>
                                <div class="card-footer text-center">
                                   <button class="btn btn-secondary waves-effect waves-light" data-toggle="modal" data-target=".view-proj'.$row['id'].'"><i class="fe-eye"></i> View</button>
                                    <a href="./php/del.php?ff='.$row['id'].'" class="btn btn-secondary waves-effect waves-light"><i class="fe-trash-2"></i> Delete</a>
                                    <a href="./properties-edit.php?id='.$row['id'].'" class="btn btn-secondary waves-effect waves-light"><i class="fe-edit-1"></i> Edit</a>
                                </div>
                            </div>
                        </div>

<!--  View Member -->
<div class="modal fade view-proj'.$row['id'].'  " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"><span class="mb-0 pb-0" style="display: block; margin-bottom: 0">Property Title </span>
                    <small class="mt-0">'.$row['title'].'</small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">   
                  <div class="col-md-3">
                        <img class="img-fluid img-thumbnail" src="../assets/media-demo/properties/'.$row['pix'].'">
                        <p><a href="gallery.php?id='.$row['id'].'">Property Gallery</a></p>
                    </div>                 
                    <div class="col-md-9">
                        <table class="table table-striped table-centered  table-nowrap m-0">
                        <tr>
                          <th>Address
                          <td>'.$row['address'].'
                        </tr>
                         <tr>
                          <th>Amount
                          <td>'.$row['amount'].'
                        </tr>
                         <tr>
                          <th>Property Type
                          <td>'.$typer.'
                        </tr>
                         <tr>
                          <th>Listing
                          <td>'.$row['optn'].'
                        </tr>
                        </table>
                        <h5>Description</h5>
                        <p class="text-dark">
                           '.$row['descr'].'
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';
          $dResult[$count] = $value; 
          $count++; $a++;
     }
 }
 return $dResult;
}




//Get admin Properties gallery
public function getAdmPropsGal($role){ return $this->getAdmPropGal($role); }
private function getAdmPropGal($role)
{
   $this->_construct();
   $where = "propid = $role order by id DESC";
   $result = $this->dbController->retrieve(PROPGAL, $where);
   $count = 0; $a=1; $dResult = array();

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      extract($row);

      $value = '<tr>
                          <th>'.$a.'</td>
                          <td>'.$row['filename'].'</td>
                          <td><a href="./php/del.php?yy='.$row['id'].'" class="btn btn-secondary waves-effect waves-light"><i class="fe-trash-2"></i> Delete</a>
                          </td>
                  </tr>
                   
';
          $dResult[$count] = $value; 
          $count++; $a++;
     }
 }
 return $dResult;
}



//get property given id
public function getOneProperty($id)
{
  return $this->getOneProp($id);
}
private function getOneProp($id)
{
  $where = "id = '$id'";
  $result = $this->dbController->retrieve(PROPS, $where);
  $props = array();
  if($result != FALSE)
  {
    $row = mysqli_fetch_array($result);
    $props['id'] = $id;
    $props['title'] = $row['title'];
    $props['descr'] = $row['descr'];
    $props['address'] = $row['address'];
    $props['pix'] = $row['pix'];
    $props['amount'] = $row['amount'];
    $props['others'] = $row['others']; 
    $props['type'] = $row['type'];
    if($row['type']==1){$props['typer'] = "Landed Property";}else{$props['typer']="Housing Property";}
    $props['optn'] = $row['optn'];  
    $props['state'] = $row['state'];
     $props['status'] = $row['status'];
       if($row['status']==0){$props['status1'] = "Available";}else{$props['status1']="Not Available";}
    $props['date_added'] = $row['whens'];  
    return $props;
  }
}



//Get admin news
public function getAdmNews(){ return $this->getAdmNew(); }
private function getAdmNew()
{
   $this->_construct();
   $where = "id > 0 order by id DESC";
   $result = $this->dbController->retrieve(NEWS, $where);
   $count = 0; $a=1;
   $dResult = array();

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      extract($row);
      //$dVen = $this->getOneNews($row['vendor']);
      if(empty($row['image'])){$row['image'] = "news.jpg";}
    
        $value = '<div class="col-md-4">
                            <div class="card matchHeight">
                                <img class="card-img-top img-fluid" src="../assets/media-demo/news/'.$row['image'].'" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">'.$row['title'].'</h5>
                                    
                                    <p class="card-text">
                                        <small class="text-muted">Last updated '.date('d M, Y', strtotime($row['whens'])).'</small>
                                    </p>
                                </div>
                                <div class="card-footer text-center">
                                   <button class="btn btn-secondary waves-effect waves-light" data-toggle="modal" data-target=".view-news'.$row['id'].'"><i class="fe-eye"></i> View</button>
                                    <a href="./php/del.php?gg='.$row['id'].'" class="btn btn-secondary waves-effect waves-light"><i class="fe-trash-2"></i> Delete</a>
                                    <a href="./news-event-edit.php?code='.$row['id'].'" class="btn btn-secondary waves-effect waves-light"><i class="fe-edit-1"></i> Edit</a>
                                </div>
                            </div>
                        </div>

<!--  View Member -->
<div class="modal fade view-news'.$row['id'].'  " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"><span class="mb-0 pb-0" style="display: block; margin-bottom: 0">News Title </span>
                    <small class="mt-0">'.$row['title'].'</small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">   
                  <div class="col-md-3">
                        <img class="img-fluid img-thumbnail" src="../assets/media-demo/news/'.$row['image'].'">
                    </div>                 
                    <div class="col-md-9">                       
                        <h5>Description</h5>
                        <p class="text-dark">
                           '.$row['descr'].'
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';
          $dResult[$count] = $value; 
          $count++; $a++;
     }
 }
 return $dResult;
}



//get news given id
public function getOneNews($id)
{
  return $this->getOneNew($id);
}
private function getOneNew ($id)
{
  $where = "id = '$id'";
  $result = $this->dbController->retrieve(NEWS, $where);
  $project = array();
  if($result != FALSE)
  {
    $row = mysqli_fetch_array($result);
    $project['id'] = $id;
    $project['title'] = $row['title'];
    $project['descr'] = $row['descr'];
    $project['image'] = $row['image'];
    $project['dateAdded'] = $row['whens'];
    return $project;
  }
}


//get slider given id
public function getOneSlider($id)
{
  return $this->getOneSlide($id);
}
private function getOneSlide ($id)
{
  $where = "id = '$id'";
  $result = $this->dbController->retrieve(SLIDES, $where);
  $project = array();
  if($result != FALSE)
  {
    $row = mysqli_fetch_array($result);
    $project['id'] = $id;
    $project['text1'] = $row['text1'];
    $project['text2'] = $row['text2'];
    $project['amount'] = $row['amount'];
    $project['descr'] = $row['descr'];
    $project['pix'] = $row['pix'];
    return $project;
  }
}





//function to get active slides
public function getAdSlides(){ return $this->getAdSlides1(); }
private function getAdSlides1()
{
  $this->_construct();
  $where = "id > 0 and status= 0";
  $result = $this->dbController->retrieve(SLIDES, $where);
  if($result != FALSE)
  {
    $slides = array(); $count = 0;
   while($row = mysqli_fetch_array($result))
    {
       extract($row);
       $value = '             <div class="col-3">
                                    <a href="#" title="Project 1">
                                        <div class="img-responsive">
                                            <img src="../assets/media-demo/banner/'.$row['pix'].'" alt="" class="img-fluid">
                                        </div>
                                    </a>
                                    <a href="./php/del.php?ast='.$row['id'].'">Delete Slide</a> 
                                    <div>
                                    <a href="./slider-edit.php?id='.$row['id'].'">Edit Slide</a>
                                    </div>
                                </div>
';
      $slides[$count] = $value;
      $count++;
    }
    return $slides;
  }
    
}



//Get admin Staff
public function getAdmStaff(){ return $this->getAdmStaffs(); }
private function getAdmStaffs()
{
   $this->_construct();
   $where = "id > 0 order by id DESC";
   $result = $this->dbController->retrieve(PEOPLE, $where);
   $count = 0; $a=1; 
   $dResult = array();

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      $typer = "Staff";
      extract($row);
      if($row['type']==1){ $typer = "Admin";} 
      if($row['type']==3){ $typer = "Client";}
      //<a href="#" class="btn btn-light btn-sm"><i class="fe-edit-1"></i> Edit</a>
        $value = ' <tr>
                                <th scope="row">'.$a.'</th>
                                <td>'.$row['fullname'].'</td>
                                <td>'.$row['email'].'</td>
                                <td>'.$row['phone'].'</td>
                                <td>'.$typer.'</td>
                                <td>
                                    <div class="btn-group">
                                    <button class="btn btn-light btn-sm" data-toggle="modal" data-target=".view-comm'.$row['id'].'"><i class="fe-eye"></i> View</button>
                                        <a href="./php/del.php?id='.$row['id'].'" class="btn btn-light btn-sm"><i class="fe-trash-2"></i> Delete</a>
                                        
                                    </div>


                                </td>
                            </tr>
      
                        

<!--  View Member -->
<div class="modal fade view-comm'.$row['id'].'  " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"><span class="mb-0 pb-0" style="display: block; margin-bottom: 0">Member`s Name </span>
                    <small class="mt-0">'.$row['fullname'].'</small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">                    
                    <div class="col-md-12">
                        <h5>Testimony</h5>
                        <p class="text-dark">
                           '.$row['summary'].'
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';
          $dResult[$count] = $value; 
          $count++; $a++;
     }
 }
 return $dResult;
}



//Get admin Staff
public function getAdmEsps(){ return $this->getAdmEsp(); }
private function getAdmEsp()
{
   $this->_construct();
   $where = "id > 0 order by id DESC";
   $result = $this->dbController->retrieve(ESP, $where);
   $count = 0; $a=1; 
   $dResult = array();

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      extract($row);
          $value = ' <tr>
                                <th scope="row">'.$row['regCode'].'</th>
                                <td>'.$row['fullname'].'</td>
                                <td>'.$row['email'].'</td>
                                <td>'.$row['phone'].'</td>
                                <td>Diamond Level</td>
                                <td>
                                    <div class="btn-group">
                                    <button class="btn btn-light btn-sm" data-toggle="modal" data-target=".view-comm'.$row['id'].'"><i class="fe-eye"></i> View</button>
                                        <a href="#" class="btn btn-light btn-sm"><i class="fe-trash-2"></i> Delete</a>
                                        
                                    </div>


                                </td>
                            </tr>
      
                        

<!--  View Member -->
<div class="modal fade view-comm'.$row['id'].'  " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"><span class="mb-0 pb-0" style="display: block; margin-bottom: 0">ESP`s Name </span>
                    <small class="mt-0">'.$row['fullname'].'</small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">                    
                    <div class="col-md-12">
                        <h5>Address</h5>
                        <p class="text-dark">
                           '.$row['address'].'
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';
          $dResult[$count] = $value; 
          $count++; $a++;
     }
 }
 return $dResult;
}




//Get admin Testimonials
public function getAdmTests(){ return $this->getAdmTest(); }
private function getAdmTest()
{
   $this->_construct();
   $where = "id > 0 order by id DESC";
   $result = $this->dbController->retrieve(TESTI, $where);
   $count = 0; $a=1;
   $dResult = array();

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      extract($row);
    
        $value = ' <tr>
                                <th scope="row">'.$a.'</th>
                                <td>'.$row['fullname'].'</td>
                                <td>'.$row['position'].'</td>
                                <td>
                                    <div class="btn-group">
                                    <button class="btn btn-light btn-sm" data-toggle="modal" data-target=".view-comm'.$row['id'].'"><i class="fe-eye"></i> View</button>
                                        <a href="./php/del.php?ee='.$row['id'].'" class="btn btn-light btn-sm"><i class="fe-trash-2"></i> Delete</a>
                                    
                                    </div>


                                </td>
                            </tr>
                        

<!--  View Member -->
<div class="modal fade view-comm'.$row['id'].'  " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"><span class="mb-0 pb-0" style="display: block; margin-bottom: 0">Testifier`s Name </span>
                    <small class="mt-0">'.$row['fullname'].'</small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">                    
                    <div class="col-md-12">
                        <h5>Testimony</h5>
                        <p class="text-dark">
                           '.$row['testimony'].'
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';
          $dResult[$count] = $value; 
          $count++; $a++;
     }
 }
 return $dResult;
}



//Get admin Clients
public function getAdmClient(){ return $this->getAdmClients(); }
private function getAdmClients()
{
   $this->_construct();
   $where = "id > 0 order by id DESC";
   $result = $this->dbController->retrieve(CLIENT, $where);
   $count = 0; $a=1; 
   $dResult = array();

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      $typer = "Staff";
      extract($row);
      $prop = $this->getOneProp($row['interest']);
             $value = ' <tr>
                                <th scope="row">'.$a.'</th>
                                <td>'.$row['member'].'</td>
                                <td>'.$row['email'].'</td>
                                <td>'.$row['phone'].'</td>
                                <td>'.$prop['title'].'</td>
                                <td>
                                    <div class="btn-group">
                                    <button class="btn btn-light btn-sm" data-toggle="modal" data-target=".view-comm'.$row['id'].'"><i class="fe-eye"></i> View</button>
                                        <a href="./php/del.php?dd='.$row['id'].'" class="btn btn-light btn-sm"><i class="fe-trash-2"></i> Delete</a>
                                        
                                    </div>


                                </td>
                            </tr>
      
                        

<!--  View Member -->
<div class="modal fade view-comm'.$row['id'].'  " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"><span class="mb-0 pb-0" style="display: block; margin-bottom: 0">Client`s Details </span>
                    <small class="mt-0">'.$row['member'].'</small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">                    
                    <div class="col-md-12">
                        <h5>Contacts</h5>
                        <p class="text-dark">Email: '.$row['email'].' </p>
                        <p class="text-dark">Phone: '.$row['phone'].' </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';
          $dResult[$count] = $value; 
          $count++; $a++;
     }
 }
 return $dResult;
}



//Get admin Subscribers
public function getAdmSubs(){ return $this->getAdmSub(); }
private function getAdmSub()
{
   $this->_construct();
   $where = "id > 0 order by id DESC";
   $result = $this->dbController->retrieve(SUBS, $where);
   $count = 0; $a=1; 
   $dResult = array();

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
   
      extract($row);
      
             $value = ' <tr>
                                <th scope="row">'.$a.'</th>
                                <td>'.$row['email'].'</td>
                                <td>
                                    <div class="btn-group">
                                     <a href="./php/del.php?ass='.$row['id'].'" class="btn btn-light btn-sm"><i class="fe-trash-2"></i> Delete</a>                                        
                                    </div>


                                </td>
                            </tr>';
          $dResult[$count] = $value; 
          $count++; $a++;
     }
 }
 return $dResult;
}



//Get admin Reports
public function getAdmReports(){ return $this->getAdmReport(); }
private function getAdmReport()
{
   $this->_construct();
   $where = "id > 0 order by id DESC";
   $result = $this->dbController->retrieve(REPT, $where);
   $count = 0; $a=1; 
   $dResult = array();

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      extract($row);
      $prop = $this->getdUser($row['sender']);
             $value = ' <tr>
                                <th scope="row">'.$a.'</th>
                                <td>'.$prop['name'].'</td>
                                <td>'.$row['type'].'</td>
                                <td>'.$row['title'].'</td>
                                <td>'.date('d M, Y',strtotime($row['whens'])).'</td>
                                <td>
                                    <div class="btn-group">
                                    <button class="btn btn-light btn-sm" data-toggle="modal" data-target=".view-comm'.$row['id'].'"><i class="fe-eye"></i> View</button>
                                        <a href="./php/del.php?as='.$row['id'].'" class="btn btn-light btn-sm"><i class="fe-trash-2"></i> Delete</a>
                                        
                                    </div>


<!--  View Member -->
<div class="modal fade view-comm'.$row['id'].'  " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"><span class="mb-0 pb-0" style="display: block; margin-bottom: 0">Report`s Details </span>
                    <small class="mt-0">'.$row['title'].'</small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">   
                    <div class="col-md-9">
                      ATTACHMENT
                    </div>                
                    <div class="col-md-9">
                        <table class="table table-striped table-centered  table-nowrap m-0">
                        <tr>
                          <th>Sender
                          <td>'.$prop['name'].'
                        </tr>
                         <tr>
                          <th>Type
                          <td>'.$row['type'].'
                        </tr>
                         
                        </table>
                        <h5>Description</h5>
                        <p class="text-dark">
                           '.$row['descr'].'
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


                                </td>
                            </tr>
      
                        

';
          $dResult[$count] = $value; 
          $count++; $a++;
     }
 }
 return $dResult;
}



//about  address 
public function getAbout()
{
  return $this->getAbt();
}
private function getAbt()
{
  $where = "id = 1";
  $result = $this->dbController->retrieve(ABT, $where);
  if($result != FALSE)
  {
    $project = array();
    $row = mysqli_fetch_array($result);
    $project[0] = $row['about'];
    $project[1] = $this->limit_words($row['about'], 150);
    //$project['image'] = $row['image'];
    return $project;
  }
}

//Get about content
public function getAbtCont(){ return $this->getAbtConts(); }
private function getAbtConts()
{
   $this->_construct();
   $where = "id = 1";
   $result = $this->dbController->retrieve(ABT, $where);
    if($result != FALSE) {     
    $row = mysqli_fetch_array($result);
      extract($row);
      $abt = $row['about'];
     return $abt; 
   }
 }






















//function to get services
public function getServices()
{
  return $this->getdServices();
}
private function getdServices()
{
  $this->_construct();
  $where = "id > 0 order by id ASC";
  $result = $this->dbController->retrieve(SERVICES, $where);
  if($result != FALSE)
  {
    $dService = array(); $count = 0;
   while($row = mysqli_fetch_array($result))
    {
       extract($row);
       $dService[$count][0] = $row['title'];
       $dService[$count][1] = $row['descr'];
       $dService[$count][2] = $row['image'];      
      $count++;
    }
    return $dService;
  }
    
}


//function to get comm
public function getComm()
{
  return $this->getdComm();
}
private function getdComm()
{
  $this->_construct();
  $where = "id > 0 order by id ASC";
  $result = $this->dbController->retrieve(COMM, $where);
  if($result != FALSE)
  {
    $dteam = array(); $count = 0;
   while($row = mysqli_fetch_array($result))
    {
       extract($row);
       $value = ' <tr>
                        <td>'.$row['name'].'</td>
                        <td></td>
                        <td>'.$row['lga'].'</td>
                        <td></td>
                        <td></td>
                       
                    </tr>';
      $dteam[$count] = $value;
      $count++;
    }
    return $dteam;
  }
    
}



//function to get projects
public function getProjects($type)
{
  return $this->getdProjects($type);
}
private function getdProjects($type)
{
  $this->_construct();
  $where = "status = $type order by id DESC";
  $result = $this->dbController->retrieve(PROJECTS, $where);
  if($result != FALSE)
  {
    $dteam = array(); $count = 0;
   while($row = mysqli_fetch_array($result))
    {
       extract($row);
       $dVendor = $this->getOneVend($row['id']);
       $value = '<div class="col-md-4 mb-4">
                <div class="project-item matchHeight">
                    <img src="img/projects/'.$row['image'].'" alt="project">
                    <div class="project-item-overlay">
                        <div class="project-item-content">
                            <span>'.$row['title'].'</span>
                            <h6>'.$dVendor['name'].'</h6>
                            <a href="project_detail.php?id='.$row['id'].'">View More</a>
                        </div>
                    </div>
                </div>
            </div>';
      $dteam[$count] = $value;
      $count++;
    }
    return $dteam;
  }
    
}





//function to get vend
public function getVend()
{
  return $this->getdVend();
}
private function getdVend()
{
  $this->_construct();
  $where = "id > 0 order by id DESC";
  $result = $this->dbController->retrieve(VENDORS, $where);
  if($result != FALSE)
  {
    $dteam = array(); $count = 0;
   while($row = mysqli_fetch_array($result))
    {
      $stat = "Active"; if($row['status']==1){$stat = "Inactive";}
       extract($row);
       $value = ' <tr>
                        <td>'.$row['name'].'</td>
                        <td></td>
                        <td>'.$row['contact'].'</td>
                        <td>'.$stat.'</td>
                       
                    </tr>';
      $dteam[$count] = $value;
      $count++;
    }
    return $dteam;
  }
    
}



//function to get Li vend
public function getLiVend()
{
  return $this->getdVendss();
}
private function getdVendss()
{
  $this->_construct();
  $where = "id > 0 order by id DESC";
  $result = $this->dbController->retrieve(VENDORS, $where);
  if($result != FALSE)
  {
    $dteam = array(); $count = 0;
   while($row = mysqli_fetch_array($result))
    {
       extract($row);
       $value = ' <option value="'.$row['id'].'">'.$row['name'].'</option>';
      $dteam[$count] = $value;
      $count++;
    }
    return $dteam;
  }
    
}


//get project given id
public function getOneProject($id)
{
  return $this->getOneProj($id);
}
private function getOneProj ($id)
{
  $where = "id = '$id'";
  $result = $this->dbController->retrieve(PROJECTS, $where);
  $project = array();
  if($result != FALSE)
  {
    $row = mysqli_fetch_array($result);
    $vend = $row['vendor'];
    $vendor = $this->getOneVend($id);
    $project['id'] = $id;
    $project['title'] = $row['title'];
    $project['descr'] = $row['descr'];
    $project['location'] = $row['location'];
    $project['image'] = $row['image'];
    $project['status'] = $row['status'];    
    $project['start_date'] = $row['start_date'];
    $project['end_date'] = $row['end_date'];
    $project['vendor'] = $vendor['name'];
    $project['ven-con'] = $vendor['contact'];
    return $project;
  }
}



//function to get rand projects
public function getRandProjects()
{
  return $this->getdrProjects();
}
private function getdrProjects()
{
  $this->_construct();
  $wer = "id > 0";
  $quantity = $this->dbController->counter2(PROJECTS, $wer);

  $dteam = array(); $count = 0;
  for($i=0; $i<3; $i++)
  {
    $id = rand(1, $quantity);
    $where = "id = $id";
    $result = $this->dbController->retrieve(PROJECTS, $where);
    $row = mysqli_fetch_array($result);
    extract($row);
    $dVendor = $this->getOneVend($row['id']);
    $var = '<div class="project-item matchHeight">
                        <img src="img/projects/'.$row['image'].'" alt="project">
                        <div class="project-item-overlay">
                            <div class="project-item-content">
                                <span>'.$row['title'].'</span>
                                <h6>'.$dVendor['name'].'</h6>
                                <a href="project_detail.php?id='.$row['id'].'">View More</a>
                            </div>
                        </div>
                    </div>';
     $dteam[$i] = $var;
  }
    return $dteam;    
}




//function to get rand News
public function getRandNews()
{
  return $this->getdrNews();
}
private function getdrNews()
{
  $this->_construct();
  $wer = "id > 0";
  $quantity = $this->dbController->counter2(NEWS, $wer);

  $dteam = array(); $count = 0;
  for($i=0; $i<3; $i++)
  {
    $id = rand(1, $quantity);
    $where = "id = $id";
    $result = $this->dbController->retrieve(NEWS, $where);
    $row = mysqli_fetch_array($result);
    extract($row);
    $var = '<div class="latest-posts ">
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-4 latest-posts-img">
                                <img src="img/news/'.$row['image'].'" alt="blog-img">
                            </div>

                            <div class="col-md-7 col-sm-7 col-8 latest-posts-text pl-0">
                                <a href="./news_details.php?id='.$row['id'].'">'.$row['title'].'</a>
                                <span>'.$row['dateAdded'].'</span>
                            </div>
                        </div>
                    </div>';
     $dteam[$i] = $var;
  }
    return $dteam;    
}


//welcome address 
public function getwelcome()
{
  return $this->getWel();
}
private function getWel()
{
  $where = "id = 1";
  $result = $this->dbController->retrieve(ADDONS, $where);
  $project = array();
  if($result != FALSE)
  {
    $row = mysqli_fetch_array($result);
    $project['descr'] = $row['content'];
    $project['image'] = $row['image'];
    return $project;
  }
}







//Get Users
public function getAllUsers($role){ return $this->getAllUse($role); }
private function getAllUse($role)
{
   $this->_construct();
   $dRole = $_SESSION['role'];
   $where = "id > 1 and type = ".$role." and accountStat = '0' order by id DESC";   
   $result = $this->dbController->retrieve(PEOPLE, $where);
   $count = 1; $dResult = array(); $a = ""; $b= "";
   
    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
         if($dRole==1)
         {
          $b = '<a href="./php/del.php?dd='.$row['id'].'" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="Delete User">
                        <i class="fas fa-trash"></i>
                    </a>';
         }
         if($role==4)
         {
          $a = '<a href="user-tenant-detail.php?id='.$row['id'].'" class="table-action" data-toggle="tooltip" data-original-title="View Record">
                                    <i class="fas fa-eye"></i>
                                  </a>';
         }

         $value = '<tr>
                  <td>'.$row['surname'].' '.$row['othernames'].'</td>
                  <td>'.$row['phone'].'</td>
                  <td>'.$row['email'].'</td>
                  <td>'.$row['gender'].'</td>
                  <td>'.$row['dob'].'</td>
                  <td>'.date('d M, Y', strtotime($row['regDate'])).'</td>
                  <td class="table-actions">
                  '.$a.'
                    <a href="editUser.php?id='.$row['id'].'" class="table-action" data-toggle="tooltip" data-original-title="Edit User">
                        <i class="fas fa-user-edit"></i>
                    </a>'.$b.'                    
                  </td>
                  </tr>';
          $dResult[$count] = $value; 
          $count++;
     }
 }
 return $dResult;
}


//Get admin Boards
public function getAdmBoards(){ return $this->getAdmBd(); }
private function getAdmBd()
{
   $this->_construct();
   $where = "type = 1 order by id DESC";
   $result = $this->dbController->retrieve(PEOPLE, $where);
   $count = 0; 
   $dResult = array();

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      extract($row);
      if(empty($row['image'])){ $row['image'] = "avatar.png"; }
      
        if($count != 0){ $act = ""; }
        $value = '<div class="col-lg-4">
                <div class="text-center card-box matchHeight">
                    <div class="pt-2 pb-2">
                        <img src="../img/people/'.$row['image'].'" class="rounded-circle img-thumbnail avatar-xl"
                             alt="profile-image">

                        <h4 class="mt-3"><a href="#" class="text-dark">'.$row['name'].'</a></h4>
                        <p class="text-muted"><i class="mdi mdi-briefcase"></i>'.$row['title'].'</p>
                    </div> 

                    <button class="btn btn-secondary waves-effect waves-light" data-toggle="modal" data-target=".view-member'.$row['id'].'"><i class="fe-eye"></i> View</button>
                    <a href="./php/del.php?id='.$row['id'].'" class="btn btn-secondary"><i class="fe-trash-2"></i> Delete</a>
                    <a href="about-edit-board.php?id='.$row['id'].'" class="btn btn-secondary"><i class="fe-edit-1"></i> Edit</a>
                </div>
            </div>


<!--  View Member -->
<div class="modal fade view-member'.$row['id'].'  " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"><span class="mb-0 pb-0" style="display: block; margin-bottom: 0">Service Title </span>
                    <small class="mt-0">'.$row['title'].'</small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <img class="img-fluid img-thumbnail" src="../img/people/'.$row['image'].'">
                    </div>
                    <div class="col-md-9">
                        <h5>Bio</h5>
                        <p class="text-dark">
                           '.$row['bio'].'
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';
          $dResult[$count] = $value; 
          $count++;
     }
 }
 return $dResult;
}



 //Get welcom content
public function getWelCont(){ return $this->getWelConts(); }
private function getWelConts()
{
   $this->_construct();
   $where = "id = 1";
   $result = $this->dbController->retrieve(ADDONS, $where);
    if($result != FALSE) {     
    $row = mysqli_fetch_array($result);
      extract($row);
      $abt = $row['content'];
     return $abt; 
   }
 }
 

//Get admin services
public function getAdmServices(){ return $this->getAdmService(); }
private function getAdmService()
{
   $this->_construct();
   $where = "id > 0 order by id DESC";
   $result = $this->dbController->retrieve(SERVICES, $where);
   $count = 0; 
   $dResult = array();

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      extract($row);
      if(empty($row['image'])){ $row['image'] = "3.jpg"; }
     
        if($count != 0){ $act = ""; }
        $value = '<div class="col-md-4">
                            <div class="card matchHeight">
                                <img class="card-img-top img-fluid" src="../img/services/'.$row['image'].'" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">'.$row['title'].'</h5>
                                    <p class="card-text">'.$this->limit_words($row['descr'], 10).'</p>
                                    <p class="card-text">
                                        <small class="text-muted">Last updated '.date('d M, Y', strtotime($row['whens'])).'</small>
                                    </p>
                                </div>
                                <div class="card-footer text-center">
                                    <button class="btn btn-secondary waves-effect waves-light" data-toggle="modal" data-target=".view-serv'.$row['id'].'"><i class="fe-eye"></i> View</button>
                                    <a href="./php/del.php?dd='.$row['id'].'" class="btn btn-secondary waves-effect waves-light"><i class="fe-trash-2"></i> Delete</a>
                                    <a href="services-edit.php?id='.$row['id'].'" class="btn btn-secondary waves-effect waves-light"><i class="fe-edit-1"></i> Edit</a>
                                </div>
                            </div> <!-- end card-box-->
                        </div>


<!--  View Member -->
<div class="modal fade view-serv'.$row['id'].'  " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"><span class="mb-0 pb-0" style="display: block; margin-bottom: 0">Service Title </span>
                    <small class="mt-0">'.$row['title'].'</small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <img class="img-fluid img-thumbnail" src="../img/services/'.$row['image'].'">
                    </div>
                    <div class="col-md-9">
                        <h5>Description</h5>
                        <p class="text-dark">
                           '.$row['descr'].'
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';
          $dResult[$count] = $value; 
          $count++;
     }
 }
 return $dResult;
}


public function getOneServ($id)
{
  $where = "id =$id";
  $result = $this->dbController->retrieve(SERVICES, $where);
  if($result != FALSE)
  {
   $notice = array();
   $row = mysqli_fetch_array($result);
   extract($row);
   
    $notice['title'] = $row['title'];
    $notice['descr'] = $row['descr'];
    $notice['image'] = $row['image'];
   
    return $notice;
  }
  
}





//Get admin vendors
public function getAdmVends(){ return $this->getAdmVend(); }
private function getAdmVend()
{
   $this->_construct();
   $where = "id > 0 order by id DESC";
   $result = $this->dbController->retrieve(VENDORS, $where);
   $count = 0; $a=1;
   $dResult = array();

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      extract($row);
      $stat = "Active"; $stats = "Deactivate";
      if($row['status']==1){$stat = "Expired"; $stats = "Activate";}

       $typ = "Limited Liability";
      if($row['type']==1){$typ = "Partnership";}
      if($row['type']==2){$typ = "Business Name";}

      //get other table data
      //<br/><a href="">'.$row['address'].'</a>     
    
        $value = ' <tr>
                                <th scope="row">'.$a.'</th>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['email'].'<br/>'.$row['phone'].'</td>
                                <td>'.$typ.'</td>
                                <td>'.$stat.'</td>
                                <td>
                                    <div class="btn-group">
                                    <button class="btn btn-light " data-toggle="modal" data-target=".view-ven'.$row['id'].'"><i class="fe-eye"></i> View</button>
                                        <a href="./php/resolve.php?id='.$row['id'].'" class="btn btn-light"><i class="fe-arrow-up-right"></i>'.$stats.'</a>
                                    <a href="#" class="btn btn-light"><i class="fe-edit-1"></i> Edit</a>
                                    </div>


                                </td>
                            </tr>
                        

<!--  View Member -->
<div class="modal fade view-ven'.$row['id'].'  " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"><span class="mb-0 pb-0" style="display: block; margin-bottom: 0">Vendor Name </span>
                    <small class="mt-0">'.$row['name'].'</small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row"> 
                 <div class="col-md-3">
                      <img class="img-fluid img-thumbnail" src="../img/vendors/'.$row['logo'].'"/>
                 </div>                    
                    <div class="col-md-9">
                        <h5>Details</h5>
                         <b>Vin Number: </b>'.$row['vin_number'].'<br/>
                         <b>Address: </b>'.$row['address'].'                        
                        <p class="text-dark">
                           '.$row['descr'].'
                        </p>
                        <p>
                         <b><a href="vendor-view.php?id='.$row['id'].'">See More Details</a></b>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';
          $dResult[$count] = $value; 
          $count++; $a++;
     }
 }
 return $dResult;
}


//vendor registrations
public function getVendRegs($id)
{
  $where = "vendor =$id";
  $result = $this->dbController->retrieve(VENDEREGS, $where);
  if($result != FALSE)
  {
   $notice = array(); $count = 0;
   while($row = mysqli_fetch_array($result))
   {
     extract($row);
   
    $notice[$count]['reggov'] = $row['reggov'];
    $notice[$count]['regdate'] = $row['regdate'];
    $notice[$count]['regno'] = $row['regno'];
    $notice[$count]['regcat'] = $row['regcat'];
    $notice[$count]['exp'] = $row['experience'];
    $count++;    
   }
    return $notice;
  }
  
}

//vendor executives
public function getVendExec($id)
{
  $where = "vendor =$id";
  $result = $this->dbController->retrieve(VENDEXEC, $where);
  if($result != FALSE)
  {
   $notice = array(); $count = 0;
   while($row = mysqli_fetch_array($result))
   {
     extract($row);
   
    $notice[$count]['name'] = $row['name'];
    $notice[$count]['position'] = $row['position'];
    $notice[$count]['qualification'] = $row['qualification'];
    $count++;    
   }
    return $notice;
  }
  
}

//vendor equipments
public function getVendEquip($id)
{
  $where = "vendor =$id";
  $result = $this->dbController->retrieve(VENDEQUIP, $where);
  if($result != FALSE)
  {
   $notice = array(); $count = 0;
   while($row = mysqli_fetch_array($result))
   {
     extract($row);
   
    $notice['bulldozer'] = $row['bulldozer'];    
    $notice['crane'] = $row['crane'];  
    $notice['conmixer'] = $row['conmixer'];
    $notice['hoist'] = $row['hoist'];    
    $notice['roller'] = $row['roller'];  
    $notice['driller'] = $row['driller'];  
    $notice['pump'] = $row['pump'];  
    $notice['graders'] = $row['graders'];  
    $notice['bitumen'] = $row['bitumen'];  
    $notice['sprayers'] = $row['sprayers'];  
    $notice['compressor'] = $row['compressor'];  
    $notice['otherma'] = $row['otherma'];  
    $notice['barrows'] = $row['barrows'];  
    $notice['dumpers'] = $row['dumpers'];  
    $notice['handmix'] = $row['handmix'];  
    $notice['handto'] = $row['handto'];  
    $notice['electeq'] = $row['electeq'];  
    $notice['scaffold'] = $row['scaffold'];  
    $notice['weld'] = $row['weld'];  
    $notice['maother'] = $row['maother'];  
    $notice['lorry'] = $row['lorry'];  
    $notice['van'] = $row['van'];  
    $notice['tipper'] = $row['tipper'];  
    $count++;    
   }
    return $notice;
  }
  
}

//vendor contracts
public function getVendCont($id)
{
  $where = "vendor =$id";
  $result = $this->dbController->retrieve(VENDECONT, $where);
  if($result != FALSE)
  {
   $notice = array(); $count = 0;
   while($row = mysqli_fetch_array($result))
   {
     extract($row);
   
    $notice[$count]['type'] = $row['type'];
    $notice[$count]['contval'] = $row['contval'];
    $notice[$count]['clasow'] = $row['clasow'];
    $notice[$count]['comdate'] = $row['comdate'];
    $notice[$count]['partners'] = $row['partners'];
    $count++;    
   }
    return $notice;
  }
  
}


//vendor particulars
public function getVendPart($id)
{
  $where = "vendor = '$id'";
  $result = $this->dbController->retrieve(VENDPART, $where);
  if($result != FALSE)
  {
   $notice = array(); 
   $row = mysqli_fetch_array($result);
   
     extract($row);   
    $notice['comdoi'] = $row['comdoi'];
    $notice['compoi'] = $row['compoi'];
   $notice['comcap'] = $row['comcap'];
    $notice['comdir'] = $row['comdir'];
   $notice['banker'] = $row['banker'];
    $notice['comacc'] = $row['comacc'];
     $notice['comauth'] = $row['comauth'];
     $notice['cac'] = $row['cac'];
     $notice['tax'] = $row['tax'];
     $notice['xtz'] = "XYZ";
     
    return $notice;
  }
  
}



































public function getNotification($id)
{
  $where = "id =$id";
  $result = $this->dbController->retrieve(NOTIFICATIONS, $where);
  if($result != FALSE)
  {
   $notice = array();
   $row = mysqli_fetch_array($result);
   extract($row);
   
    $notice['user'] = $row['user'];
    $notice['user2'] = $row['user2'];
    $notice['activity'] = $row['activity'];
    $notice['pageLink'] = $row['pageLink'];
    $notice['status'] = $row['status'];    
    return $notice;
  }
  
}



//Get top notifications
public function gettopNotify(){ return $this->gettopNotif(); }
private function gettopNotif()
{
   $this->_construct();
   $username = $_SESSION['username'];
   $user = $_SESSION['user_id'];
   $where = "user2 = $username or user2 = $user and status = 0 order by id DESC";
   $result = $this->dbController->retrieve(NOTIFICATIONS, $where);
   $count = 0; $dResult = array();

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      extract($row);
       $person1 = $this->getdUser($row['user']);
       $person2 = $this->getdUser($row['user2']);
         $value = ' <a href="'.$row['pageLink'].'" class="list-group-item list-group-item-action">
                                <div class="row align-items-center">
                                    <div class="col pl--3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="text-left">
                                                <p class="text-sm mb-0 pb-0">'.$row['activity'].'</p>
                                                <small class="text-muted text-italic">'.$person1['name'].'</small>
                                            </div>
                                            <div class="text-right text-muted">
                                                <small>'.date('d M, Y',strtotime($row['whens'])).'</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>';
          $dResult[$count] = $value; 
          $count++; 
     }
 }
 return $dResult;
}


//Get all notifications
public function gettopNotify2(){ return $this->gettopNotif2(); }
private function gettopNotif2()
{
   $this->_construct();
   $username = $_SESSION['username'];
   $user = $_SESSION['user_id'];
   $where = "user2 = $username or user2 = $user order by id DESC";
   if($_SESSION['role']==1){
     $where = "id > 0 order by id DESC";
   }
   $result = $this->dbController->retrieve(NOTIFICATIONS, $where);
   $count = 0; $dResult = array();  $a="<td>NA</td>";

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      extract($row);
      $stat = "Unattended";
       $person1 = $this->getdUser($row['user']);
       $person2 = $this->getdUser($row['user2']);

       if($row['status'] == 1){ $stat = "Request Recieved"; }
       if($row['status'] == 2){ $stat = "Request In Process"; }
       if($row['status'] == 3){ $stat = "Task Completed"; }

       if($_SESSION['role']==1 || $_SESSION['role']==2)
       {
        $a ='<td><a href="./php/resolve.php?id='.$row['id'].'">Page Link</a></td>';
       }
         $value = '  <tr>
                                <td><a href="#">'.$person1['name'].'</a></td>
                                <td><a href="#">'.$person2['name'].'</a></td>
                                <td>'.$row['activity'].'</td>
                                '.$a.'
                                <td>'.$stat.'</td>
                                <td>'.date('d M, Y',strtotime($row['whens'])).'</td>
                    </tr>';
          $dResult[$count] = $value; 
          $count++; 
     }
 }
 return $dResult;
}


//Get all all activity Logs
public function gettopNotify3(){ return $this->gettopNotif3(); }
private function gettopNotif3()
{
   $this->_construct();
   $username = $_SESSION['username'];
   $where = "username = $username order by id DESC";
   $result = $this->dbController->retrieve(LOGS, $where);
   $count = 0; $a = 1; $dResult = array();

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      extract($row);           
         $value = '  <tr>
                                <td>'.$a.'</a></td>
                                <td>'.$row['activity'].'</td>                                
                                <td>'.date('d M, Y',strtotime($row['whens'])).'</td>
                    </tr>';
          $dResult[$count] = $value; 
          $count++; $a++;
     }
 }
 return $dResult;
}


//Get all notifications
public function gettopNotify4(){ return $this->gettopNotif4(); }
private function gettopNotif4()
{
   $this->_construct();
   $username = $_SESSION['username'];
   $user = $_SESSION['user_id']; $cc = "";
   $where = "recievers = $user or recievers = $username and type=99 order by id DESC";
   if($_SESSION['role']==1){
     $where = "id > 0 and type=99 order by id DESC";
   }
   $result = $this->dbController->retrieve(INQUISITIONS, $where);
   $count = 0; $dResult = array(); 

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      extract($row);
       $stat = "Unattended";
       $person1 = $this->getdUser($row['sender']);
       $person2 = $this->getdUser($row['recievers']);
       $desc = $row['content']; 
       if(!empty($row['attachment']))
       {
        $cc = '<a href="./assets/img/others/'.$row['attachment'].'" target="_blank">Click to view uploaded file</a>';
       }
       if($row['status'] == 1){ $stat = "Request Recieved"; }
       if($row['status'] == 2){ $stat = "Request In Process"; }
       if($row['status'] == 3){ $stat = "Task Completed"; }
         $value = '  <tr>
                                <td><a href="#">'.$person1['name'].'</a></td>
                                <td><a href="#">'.$person2['name'].'</a></td>
                                <td>'.$row['actual'].'</td>
                                <td>'.$this->limit_words($desc, 15).' <a href="#"  data-toggle="modal" data-target="#notifyer'.$row['id'].'"> <strong>... See more</strong></a>
                                <div class="modal" id="notifyer'.$row['id'].'">
                                  <div class="modal-dialog modal-lg">
                                      <div class="modal-content">

                                          <!-- Modal Header -->
                                          <div class="modal-header">
                                              <h4 class="modal-title">User Request Details</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>

                                          <!-- Modal body -->
                                          <div class="modal-body">
                                            '.$row['content'].'

                                            <p>'.$cc.'</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                                </td>
                                <td><a href="./php/resolve2.php?id='.$row['id'].'">'.$stat.'</a></td>
                                <td>'.date('d M, Y',strtotime($row['whens'])).'</td>
                    </tr>';
          $dResult[$count] = $value; 
          $count++; 
     }
 }
 return $dResult;
}
/*<!-- The Modal for Gallery -->
    */



//Get all display boards
public function getDisplayBoard(){ return $this->getDisplayBod(); }
private function getDisplayBod()
{
   $this->_construct();  
   $where = "type = 0 order by id DESC"; $del = "";
   $result = $this->dbController->retrieve(DOCS, $where);
   $count = 0; $a = 1; $dResult = array();

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      extract($row);    
       if($_SESSION['role']==1)       
       {
        $del = '<a href="./php/del.php?ff='.$row['id'].'" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="Delete Record">
                                    <i class="fas fa-trash"></i>
                                  </a>';
       }
         $value = '  <tr>
                                <td>'.$a.'</a></td>
                                <td>'.$row['title'].'</td>                                
                                <td>'.$this->limit_words($row['content'], 10).'</td> 
                                <td>'.date('d M, Y',strtotime($row['whens'])).'</td>
                                <td class="table-actions"> 
                                 <span data-toggle="modal" data-target="#board-det'.$row['id'].'">
                                  <a href="#!" class="table-action" data-toggle="tooltip" data-original-title="View/Edit Details">
                                    <i class="fas fa-eye fa-user-edit"></i>
                                  </a>   
                                </span>  
                                <div class="modal" id="board-det'.$row['id'].'">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Display Board Details</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                   <form method="POST" action="./php/edits.php?code=4">
                                                   <input type="hidden" name="id" value="'.$row['id'].'"/>
                                                       <div class="row">
                                                           <div class="col-md-12">
                                                               <div class="form-group">
                                                                   <label class="form-control-label">Title*</label>
                                                                   <input type="text" class="form-control" name="title" value="'.$row['title'].'">
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="row">
                                                           <div class="col-md-12">
                                                               <textarea name="content" class="form-control" col="5">
                                                                '.$row['content'].'
                                                               </textarea>
                                                           </div>
                                                       </div>
                                                       <div class="clearfix"></div>
                                                       <div class="row mt-6">
                                                           <div class="col-md-12">
                                                               <button type="submit" class="btn btn-success">Edit Board Content </button>
                                                           </div>
                                                       </div>
                                                   </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>                            
                                  '.$del.'
                             </td>
                    </tr>';
          $dResult[$count] = $value; 
          $count++; $a++;
     }
 }
 return $dResult;
}




//Get all property type
public function getPropTypes(){ return $this->getPropType(); }
private function getPropType()
{
   $this->_construct();  $del = "";
   $where = "id > 0 order by id DESC";
   $result = $this->dbController->retrieve(PROPCATS, $where);
   $count = 0; $a = 1; $dResult = array();

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      extract($row);          
      if($_SESSION['role']==1) 
      {
        $del = '<a href="./php/del.php?gg='.$row['id'].'" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="Delete Record">
                                    <i class="fas fa-trash"></i>
                                  </a>';
      }
         $value = '  <tr>
                                <td>'.$a.'</a></td>
                                <td>'.$row['title'].'</td>                                
                                <td>'.$this->limit_words($row['description'], 10).'</td> 
                                <td>'.date('d M, Y',strtotime($row['whens'])).'</td>
                                <td class="table-actions">                               
                                   <span data-toggle="modal" data-target="#cat-det'.$row['id'].'">
                                  <a href="#!" class="table-action" data-toggle="tooltip" data-original-title="View/Edit Details">
                                    <i class="fas fa-eye fa-user-edit"></i>
                                  </a>   
                                </span>  
                                <div class="modal" id="cat-det'.$row['id'].'">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Property Categories</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                   <form method="POST" action="./php/edits.php?code=5">
                                                   <input type="hidden" name="id" value="'.$row['id'].'"/>
                                                       <div class="row">
                                                           <div class="col-md-12">
                                                               <div class="form-group">
                                                                   <label class="form-control-label">Title*</label>
                                                                   <input type="text" class="form-control" name="title" value="'.$row['title'].'">
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="row">
                                                           <div class="col-md-12">
                                                               <textarea name="content" class="form-control" col="5">
                                                                '.$row['description'].'
                                                               </textarea>
                                                           </div>
                                                       </div>
                                                       <div class="clearfix"></div>
                                                       <div class="row mt-6">
                                                           <div class="col-md-12">
                                                               <button type="submit" class="btn btn-success">Edit Category </button>
                                                           </div>
                                                       </div>
                                                   </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>                            
                                  '.$del.'
                             </td>
                    </tr>';
          $dResult[$count] = $value; 
          $count++; $a++;
     }
 }
 return $dResult;
}




//Get all rent stats for one prop
public function getRentPayStat($id){ return $this->getRentPayStats($id); }
private function getRentPayStats($id)
{
   $this->_construct();  
   $where = "property = $id order by id DESC";
   $result = $this->dbController->retrieve(RENTPAYMENTS, $where);
   $count = 0; $a = 1; $dResult = array(); $sum = 0;

    if($result != FALSE) {     
    while ($row = mysqli_fetch_array($result)) { 
      extract($row);   
         $dPropVal = $this->getOneProperty($row['property']);
         $dTenant = $this->getdUser($row['peopleID']); 
         if($row['propSub'] !=0)
         {
           $proSub = $row['propSub']; $propee = $row['property']; $sum=0;          
           $subDet = $this->getOneSub($proSub);
           $wher = "property = $propee and propSub = $proSub";
           $results = $this->dbController->retrieve(RENTPAYMENTS, $wher);
           while ($rows = mysqli_fetch_array($results)) {
             $sum = $sum + $rows['amountPaid'];
           }
            $bal = $subDet['rent'] - $sum;
            $value = '  <tr>
                                <td>'.$a.'</a></td>
                                <td>'.$dPropVal['title'].'</td>  
                                <td>'.$subDet['title'].'</td>  
                                <td>'.$dTenant['name'].'</td>
                                <td>'.$subDet['rent'].'</td> 
                                <td>'.$sum.'</td> 
                                <td>'.$bal.'</td> 
                                <td>'.date('d M, Y',strtotime($row['datePaid'])).'</td>
                        </tr>';
         }else{
          $bal2 = $dPropVal['rent'] - $row['amountPaid'];
          $value = '  <tr>
                                <td>'.$a.'</a></td>
                                <td>'.$dPropVal['title'].'</td>  
                                <td> No Subs </td>  
                                <td>'.$dTenant['name'].'</td>
                                <td>'.$dPropVal['rent'].'</td> 
                                <td>'.$row['amountPaid'].'</td> 
                                <td>'.$bal2.'</td> 
                                <td>'.date('d M, Y',strtotime($row['datePaid'])).'</td>
                        </tr>';
         }

        
          $dResult[$count] = $value; 
          $count++; $a++;
     }
 }
 return $dResult;
}


public function getTenantAgent()
{
  $tenant = $_SESSION['user_id'];
  $where = "tenant =$tenant";
  $result = $this->dbController->retrieve(PROPTENANTS, $where);
  if($result != FALSE)
  {
    $details = array();
   while($row = mysqli_fetch_array($result))
    {
       extract($row);
       $dProp = $row['property'];
       $dPropSub = $row['sub'];
       $dMainProp = $this->getOneProperty($dProp);
       $details['0'] = $dMainProp['title'];
       $details['1'] = $dMainProp['owner2'];
       $details['2'] = $dMainProp['image'];
       $details['3'] = $dMainProp['address'];
       if(!empty($dPropSub))
       {
        $dMainSub = $this->getOneSub($dPropSub);
        $details['4'] = $dMainSub['title'];
       }

    }
    return $details;
  }
  
}



public function getTenantStaff()
{
  $tenant = $_SESSION['user_id'];
  $where = "tenant = $tenant order by id DESC limit 1";
  $result = $this->dbController->retrieve(PROPTENANTS, $where);
  if($result !=FALSE){
    $row = mysqli_fetch_array($result); extract($row); 
    $propID = $row['property']; $sub = $row['sub'];

    $wheres = "propID = $propID order by id DESC limit 1";
    $results = $this->dbController->retrieve(PROPSTAFF, $wheres);
    if($results !=FALSE){
        $rows = mysqli_fetch_array($results); extract($rows); 
        $staff = $rows['staff']; 
      }else{
        //use admin since no assignment is made
        $staff = "1";
      }
      $manager = $this->getdUser($staff);
       return $manager;
  }
  
}






/*HELPER FUNCTIONS */

//li prop types
public function getLiPropTypes()
{
  return $this->getLiPropType();
}
private function getLiPropType()
{
  $where = "id > 0 ";
  $result = $this->dbController->retrieve(PROPCATS, $where);
  if($result != FALSE)
  {
    $dProps = array(); $count = 0;
    while ($row = mysqli_fetch_array($result)) {
      $value = '<option value="'.$row['title'].'">'.$row['title'].'</option>';
      $dProps[$count] = $value;
      $count++;
    }        
    return $dProps;
  }
}

//Get Select Country
public function getLiCountry()
{
  return $this->getCountry();
}
private function getCountry()
{
  $where = "id > 0 ";
  $result = $this->dbController->retrieve(COUNTRY, $where);
  if($result != FALSE)
  {
    $dCountry = array(); $count = 0;
    while ($row = mysqli_fetch_array($result)) {
      $value = '<option value="'.$row['id'].'">'.$row['country'].'</option>';
      $dCountry[$count] = $value;
      $count++;
    }
        
    return $dCountry;
  }
}

//Get One Country
public function getOneCountry($id)
{
  return $this->getonCountry($id);
}
private function getonCountry($id)
{
  $dCountry = "";
  $where = "id = $id ";
  $result = $this->dbController->retrieve(COUNTRY, $where);
  if($result != FALSE)
  {     
      $row = mysqli_fetch_array($result);
      extract($row);      
      $dCountry = $row['country'];       
    }
        
    return $dCountry;
  }


//Get Select states
public function getLiStates()
{
  return $this->getstate();
}
private function getstate()
{
  $where = "id > 0 ";
  $result = $this->dbController->retrieve(STATE, $where);
  if($result != FALSE)
  {
    $dStates = array(); $count = 0;
    while ($row = mysqli_fetch_array($result)) {
      $value = '<option value="'.$row['name'].'">'.$row['name'].'</option>';
      $dStates[$count] = $value;
      $count++;
    }
        
    return $dStates;
  }
}

//Get One State
public function getOneState($id)
{
  return $this->getonState($id);
}
private function getonState($id)
{
  $dStates = array();
  $where = "id = $id ";
  $result = $this->dbController->retrieve(STATE, $where);
  if($result != FALSE)
  {     
      $row = mysqli_fetch_array($result);
      extract($row);      
      $dStates[0] = $row['city'];
      $dStates[1] = $row['country'];      
    }
        
    return $dStates;
  }

  //Get li property owners
  public function getLiPropOwners()
{
  return $this->getLiPropOwner();
}
private function getLiPropOwner()
{
  $where = "type = 3 and accountStat = '0'";
  $result = $this->dbController->retrieve(PEOPLE, $where);
  if($result != FALSE)
  {
    $dProps = array(); $count = 0;
    while ($row = mysqli_fetch_array($result)) {
      $name = $row['surname'] . " " . $row['othernames'];
      $value = '<option value="'.$row['id'].'">'.$name.'</option>';
      $dProps[$count] = $value;
      $count++;
    }        
    return $dProps;
  }
}

//Get li property owners
  public function getLiProps()
{
  return $this->getLiProp();
}
private function getLiProp()
{
  $where = "id > 0 and accountStat = '0'";
  $result = $this->dbController->retrieve(PROPERTIES, $where);
  if($result != FALSE)
  {
    $dProps = array(); $count = 0;
    while ($row = mysqli_fetch_array($result)) {
      $value = '<option value="'.$row['id'].'">'.$row['title'].'</option>';
      $dProps[$count] = $value;
      $count++;
    }        
    return $dProps;
  }
}


//Get li tenants
  public function getLiTenants()
{
  return $this->getLiTenant();
}
private function getLiTenant()
{
  $where = "type = 4 and accountStat = '0'";
  $result = $this->dbController->retrieve(PEOPLE, $where);
  if($result != FALSE)
  {
    $dProps = array(); $count = 0;
    while ($row = mysqli_fetch_array($result)) {
      $value = '<option value="'.$row['id'].'">'.$row['surname'].' '.$row['othernames'].'</option>';
      $dProps[$count] = $value;
      $count++;
    }        
    return $dProps;
  }
}



//Get li Staff
  public function getLiStaff()
{
  return $this->getLiStaf();
}
private function getLiStaf()
{
  $where = "type = 2 and accountStat = '0'";
  $result = $this->dbController->retrieve(PEOPLE, $where);
  if($result != FALSE)
  {
    $dProps = array(); $count = 0;
    while ($row = mysqli_fetch_array($result)) {
      $value = '<option value="'.$row['id'].'">'.$row['surname'].' '.$row['othernames'].'</option>';
      $dProps[$count] = $value;
      $count++;
    }        
    return $dProps;
  }
}



//Get li Lawyer
  public function getLiLawyer()
{
  return $this->getLiLawye();
}
private function getLiLawye()
{
  $where = "type = 5 and accountStat = '0'";
  $result = $this->dbController->retrieve(PEOPLE, $where);
  if($result != FALSE)
  {
    $dProps = array(); $count = 0;
    while ($row = mysqli_fetch_array($result)) {
      $value = '<option value="'.$row['id'].'">'.$row['surname'].' '.$row['othernames'].'</option>';
      $dProps[$count] = $value;
      $count++;
    }        
    return $dProps;
  }
}




//Get li Worker
  public function getLiWorker()
{
  return $this->getLiWorke();
}
private function getLiWorke()
{
  $where = "type = 6 and accountStat = '0'";
  $result = $this->dbController->retrieve(PEOPLE, $where);
  if($result != FALSE)
  {
    $dProps = array(); $count = 0;
    while ($row = mysqli_fetch_array($result)) {
      $value = '<option value="'.$row['id'].'">'.$row['surname'].' '.$row['othernames'].'</option>';
      $dProps[$count] = $value;
      $count++;
    }        
    return $dProps;
  }
}




    //Index search function
     public function search($title, $cat, $course)  
    {
       $this->_construct();
       
        if(!empty($title))    
        {
            $wer= "title LIKE '%$title%'";
        }else{
            $wer= "course_cat = '$cat' and course_id= '$course'";
        }

       $result = $this->dbController->retrieve(PROJECT, $wer);
       if($result != FALSE)
       {
           $projects = array();
           $count = 0; 
          while($row = mysqli_fetch_array($result))
          {
              extract($row);
              //student inf
              $std = $this->getStd($row['std_id']);
              //sch info
              $sch = $this->getSch($row['sch_id']);
              //level

                 $value = '<div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <div class="product-thumb">
                    <div class="image">
                      <a href="#">
                        <img src="images/09.jpg" class="img-responsive" alt="img" title="img" />
                      </a>
                    </div>
                    <div class="caption">
                      <h3>Owner: '.$std['lName'].' '.$std['fName'].'</h3>
                      <h4 style="margin-top:-15px; margin-bottom:-15px;"><a href="./project.php?id='.$row['id'].'">'.$row['title'].'</a></h4>
                       <span class="level" style="margin-left:15px;">'.$row['level'].' | '.$sch['name'] .'</span>
                      <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla interdum ipsum malesuada arcu tristique, sit amet fringilla metus volutpat.</p>
                      <ul class="list-inline">
                        <li>
                          <a href="#"><i class="icofont icofont-ui-user"></i>15</a>
                        </li>
                        <li>
                          <a href="#"><i class="icofont icofont-comment"></i>10</a>
                        </li>
                        <li>
                          <i class="icofont icofont-star"></i>
                          <i class="icofont icofont-star"></i>
                          <i class="icofont icofont-star"></i>
                          <i class="icofont icofont-star"></i>
                          <i class="icofont icofont-star"></i>
                        </li>
                      </ul>-->
                    </div>
                  </div>
                </div>';                               
              $projects[$count] = $value;
              $count++;
          }    
              return $projects;      
       }
       else{ return 0;}
    }


    //Index search function
     public function search1($title, $cat, $course, $school)  
    {
       $this->_construct();
       
        if(!empty($title))    
        {
            $wer= "title LIKE '%$title%";
        }else{
            $wer= "sch_id = '$school' course_cat = '$cat' and course_id= '$course'";
        }

       $result = $this->dbController->retrieve(PROJECT, $wer);
       if($result != FALSE)
       {
           $projects = array();
           $count = 0; 
          while($row = mysqli_fetch_array($result))
          {
              extract($row);
                  $value = '<dt>
                              <i class="fa fa-caret-right page-ui-icon"></i>
                                <span class="level">'.$row['level'].'</span>
                                 <a href="./project.php?id='.$row['id'].'">'.$row['title'].'</a>
                              </dt>';                                  
              $projects[$count] = $value;
              $count++;
          }    
              return $projects;      
       }
       else{ return 0;}
    }


    
    //EXTRA FUNCTIONALITIES
    function limit_words($dString, $dLimit)
    {
        $words = explode(" ", $dString);
         return implode(" ", array_splice($words, 0 ,$dLimit));
    }
    
    //EXTRA FUNCTIONALITIES
    function split_words($dString)
    {
        $words = explode("%", $dString);
        return $words;        
    }

}

