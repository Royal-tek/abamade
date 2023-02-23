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
    public function paymentStatus($state){
        $result = "";
        switch ($state){
            case 0:
            $result =  'canceled';
            break;
            case 1:
            $result =   'pending';
            break;
            case 2:
            $result =   'successful';
            break;
            case 3:
            $result =   'completed';
            break;
            default:
            $result =   'rejected';
            break;
        }
        return $result;
    }

    public function orderStatus($state){
        $result =  "";
        switch ($state){
            case 0:
            $result =   'pending';
            break;
            case 1:
            $result =   'successful';
            break;
            case 2:
            $result =   'completed';
            break;
            case 3:
            default:
            $result =   'rejected';
            break;
        }
        return $result;
    }

    public function viewUserStatus($state){
        $result =  "";
        switch ($state){
            case 0:
            $result =   'inactive';
            break;
            case 1:
            $result =   'active';
            break;
            case 2:
            $result =   'verified';
            break;
            default:
            $result =   'unverified';
            break;
        }
        return $result;
    }

    public function viewUsersRole($role){
        $result =  "";
        switch ($role){
            case 0:
            $result =    'customer';
            break;
            case 1:
            $result =   'vendor';
            break;
            case 2:
            $result =   'admin';
            break;
            default:
            $result =   'anonymous';
            break;
        }
        return $result;
    }

    public function viewPriority($value){
        $result =  "";
        switch ($value){
            case 1:
            $result =   'Featured';
            break;
            case 2:
            $result =   'Hot Deal';
            break;
            default:
            $result =   'Normal';
            break;
        }
        return $result;
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

    public function nairaValue($amt){
        $value = number_format($amt, 2);
        return "&#8358;".$value;
    }

    public function alert($message, $type="info"){
        return "
                <div class='alert alert-".$type." alert-dismissible show' role='alert'>
                    ".$message."
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
    }

    public function discount($price, $rate){
        $dis = ($rate/100)*$price;
        return ($price - $dis);
    }

    //end of helper functions



    // product category
    private function subCategory($ref){
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

    public function viewSubCategory($ref){
        return $this->subCategory($ref);
    }



    private function category($level, $ref){
        $this->_construct();
        $where = "level = '{$level}'  AND ref = '{$ref}' AND status= 1";
        $result = $this->dbController->retrieve(CATEGORY, $where);
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

    public function viewCategory($level=0, $ref=0){
        return $this->category($level, $ref);
    }

    private function category2($level=0, $ref=0, $limit){
        $this->_construct();
        $where = "level = '{$level}'  AND ref = '{$ref}' AND status= 1 LIMIT {$limit}";
        $result = $this->dbController->retrieve(CATEGORY, $where);
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

    public function viewCategory2($level, $ref, $limit){
        return $this->category2($level, $ref, $limit);
    }

    private function allCategory(){
        $this->_construct();
        $where = " 1";
        $result = $this->dbController->retrieve(CATEGORY, $where);

        $value = array(); 
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                array_push($value, $row);
            }
        }
        return $value;
    }

    public function viewAllCAtegory(){
      return $this->allCategory();
    }

    private function getCategory($id){
      $this->_construct();
      $where = "id = '{$id}'";
      $result = $this->dbController->retrieve(CATEGORY, $where);

      if($result != FALSE)
      {
          while($row = mysqli_fetch_array($result))
          {
              extract($row);
              return (object) $row;
          }
      }
      return FALSE;
   }

   public function viewCategoryDetail($id){
    return $this->getCategory($id);
   }
    


/*
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
    } */



    // product functions

    public function allItem($id){
        $this->_construct();
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
        $where = (($cat > 0)) ? "cat_id ='".$cat."'" : 1;
        if(isset($priority) && ($where == 1 )) { $where = " ( priority_rate ='{$priority}')  ORDER BY id DESC "; }

        if(isset($priority) && ($cat > 0)) { $where .= " AND ( priority_rate ='{$priority}')  ORDER BY id DESC "; }
        
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

    public function viewProducts($category=0, $perPage=6, $offset=0, $priority=0){
        return $this->getProducts($category, $perPage, $offset, $priority);
    }

    private function getAllProducts($cat, $perPage, $offset, $priority){
        $this->_construct();
        $where = (($cat > 0)) ? "cat_id ='".$cat."'" : 1;
        if(($where != 1 )) { $where .= "  ORDER BY id DESC "; }
        
        if(isset($offset) && isset($perPage)) { $where .= " LIMIT ".$offset." , ".$perPage;}
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

    public function viewAllProducts($category=0, $perPage=6, $offset=0, $priority=0){
        return $this->getAllProducts($category, $perPage, $offset, $priority);
    }

    private function topSelling($limit){
        $this->_construct();
        $attr ="prod_id";
        $result = $this->dbController->groupbyRetrieve(DETAIL, $attr, $limit);
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

    public function viewTopSelling($limit){
        return $this->topSelling($limit);
    }

    private function getItem($id){
        $this->_construct();
        $where = "id = '".$id."'";
        $result = $this->dbController->retrieve(PRODUCT, $where);

        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                return (object) $row;
            }
        }
        return False;
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
    private function getDiscountedItems($limit){
        $this->_construct();
        $var = "product AS P INNER JOIN discount AS D ON prod_id=P.id ";
        $where = " end_date > now() ORDER BY (D.id) DESC LIMIT {$limit} ";
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

    public function viewDiscountItems($limit=6){
        return $this->getDiscountedItems($limit);
    }

    //discount and featured items
    private function topDiscount(){
        $this->_construct();
        $var = "product AS P INNER JOIN discount AS D ON prod_id=P.id ";
        $where = " end_date > now() ORDER BY (discount_rate) DESC LIMIT 1 ";
        $result = $this->dbController->retrieve($var, $where);
        
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                return (object) $row;
            }
        }
        return FALSE;
    }

    public function viewTopDiscount(){
        return $this->topDiscount();
    }


    private function checkDiscount($id){
        $this->_construct();
        $where = "prod_id = '".$id."' AND end_date > now() ";
        $result = $this->dbController->retrieve(DISCOUNT, $where);
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                return (object) $row;
            }
        }
        return false;
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
            $update = $this->dbController->update(CART, $updateColumn, $qty, $where);
            if($update){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        else{
            $aa = array("session_id, prod_id, qty");
            $bb = array("'$session'", "'$item'", "'$qty'");
            $addItem = $this->dbController->insert(CART, $aa, $bb);
            
            if($addItem){
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
                return (object) $row;
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

    private function createODetail($session, $orderID, $shiping){
        $this->_construct();
        $cart = $this->getCart($session);

        if($cart){
            foreach($cart as $key){
                $ct = (object) $key;
                
                $item = $this->getItem($ct->prod_id);
                $price = ($c = $this->checkDiscount($ct->prod_id)) ? $this->discount($item->price, $c->discount_rate) : $item->price;                                            

                $title = $this->viewDeliveryTitles($shiping[1], $shiping[2], $item->id);
                $delivery = $this->getDeliveryRating($shiping[0], $title);

                
                $a = array("order_id, prod_id, qty, cost_rate, delivery_cost");
                $b = array("'$orderID'", "'{$ct->prod_id}'", "'{$ct->qty}'", "'{$price}'", "'{$delivery->ratings}'");
                $result = $this->dbController->insert(DETAIL, $a, $b);
            }
        }
        return $cart;
    }

    public function doCreateOdetail($session, $orderID, $shiping){
        return $this->createODetail($session, $orderID, $shiping);
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
                            <td>".$itm->prod_name."</td>
                            <td>".number_format($itm->price)."</td>
                            <td>".$o['qty']."</td>
                            <td>".number_format($itm->price *$o['qty'])."</td>
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
                return (object) $row;
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
                return (object) $row;
            }
        }
        return FALSE;
    }

    public function viewUserby($clause, $string){
        return $this->getUserby($clause, $string);
    }

    private function getAccess($username, $pwd){
        $this->_construct();
        $where = "( username = '{$username}' OR email = '{$username}' ) AND password='{$pwd}' ";
        $result = $this->dbController->retrieve(USERS, $where);
        if($result){
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                return (object) $row;
            }
        }
        return FALSE;
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
                return (object) $row;
            }
        }
        return FALSE;
    }

    public function viewCustomer($id){
        return $this->getCustomer($id);
    }



    // Blog Functions
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

    private function getBlogCatDetail($id){        
        $this->_construct();
        $where = "blog_cat_id = '{$id}'";
        $result = $this->dbController->retrieve(BLOGCAT, $where);
        if($result){
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                return (object) $row;
            }
        }
        return FALSE;
    }

    public function viewBlogCatDetail($id){
        return $this->getBlogCatDetail($id);
    }

    private function getBlogs($id, $perPage, $offset){
        $this->_construct();
        $where = ($id !=0) ? "blog_cat ='".$id."'" : 1;
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
        $where = " id ='{$id}' ";
        $result = $this->dbController->retrieve(BLOG, $where);
        if($result != FALSE){
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                return (object) $row;
            }
        }
        return FALSE;
    }

    public function viewSingleBlog($id){
        return $this->getABlog($id);
    }

    private function getBlogComment($id){
        $this->_construct();
        $where = " blog_id ='{$id}' ORDER BY id DESC ";
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
        $where = ($id != 0) ? " blog_cat ='{$id}' ORDER BY (id) DESC " : " 1 ORDER BY (id) DESC ";
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

    private function getSlides($type, $limit)
    {
        $this->_construct();
        $where = "section='{$type}' AND status = 1 ORDER BY (id) DESC LIMIT {$limit} ";
        $result = $this->dbController->retrieve(SLIDES, $where);
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

    public function viewSlides($type="main index slide", $limit=1){
        return $this->getSlides($type, $limit);
    }

    // delivery services

    private function getCouriers(){
        $this->_construct();
        $where = "courier_id=user GROUP BY(company) ORDER BY (company) DESC ";
        $tableName = "member as M, deliveries as D";
        $result = $this->dbController->retrieve($tableName, $where);
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

    public function viewCouriers(){
        return $this->getCouriers();
    }

    private function getDeliveryRating($id, $title){
        $this->_construct();
        $where = "courier_id ='{$id}' AND title='{$title}' ";
        $result = $this->dbController->retrieve(DELIVERYRATING, $where);
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                return (object) $row;
            }
        }
        return FALSE;
    }

    public function viewDeliveryRating($courier, $title){
        return $this->getDeliveryRating($courier, $title);
    }

    private function getProductSeller($product_id){
        $this->_construct();
        $where = "P.id ='{$product_id}' AND user_id = user";
        $tableName = "member, product AS P";
        $result = $this->dbController->retrieve($tableName, $where);
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                return (object) $row;
            }
        }
        return FALSE;
    }

    public function viewProductSeller($product_id){
        return $this->getProductSeller($product_id);
    }

    public function viewDeliveryTitles($state, $city, $product_id){
        $seller = $this->getProductSeller($product_id);
        //$seller_city = strtolower($seller->city);
        $seller_state = strtolower($seller->state);
        $title = "";
        if(strtolower($state) == "others"){
            $title = "international";
        }
        elseif(strtolower($state) == $seller_state){
            $title = "intra-state";
        }
        else{
            $title = "inter-state";
        }
        return $title;
    }

    private function getProductsCount($category){
        $this->_construct();
        $where ="cat_id ='{$category}'";
        $result = $this->dbController->counter2(PRODUCT, $where);
        if($result != FALSE)
        {
            while($row = mysqli_fetch_array($result))
            {
                extract($row);
                return (object) $row;
            }
        }
        return FALSE;
    }

    public function viewProductCount($id){
        return $this->getProductsCount($id);
    }




}

