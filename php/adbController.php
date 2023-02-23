<?php
/**
 * @title: DB controller class
 * @author: Huitouch International
 * @Project: imanage for Mishtech and UOA
 * @date: October 2019
 */
//include 'connectDB.php';

class dbController{
            
    private $server_name = "localhost";
    private $db_name = "abamadec_shopping";
    private $username = "abamadec_shop";
    private $password = "newPass12@132";
    
    //private $connection; 
    //private $close_connection;

     function  connect()
    {
        $connection = @mysqli_connect($this->server_name, $this->username, $this->password, $this->db_name) or die(mysqli_connect_error());
        
        if(mysqli_connect_error()){
            echo "Failed...".mysqlsi_connect_error();
        }

        return $connection;
    }
       
        
    
   //Retrieve DB contents for a generic table with where condition    
   public function retrieve($tab, $wer)
    {
     $connection = $this->connect();
     $sql = "SELECT * FROM $tab where $wer";
     $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
     if(mysqli_num_rows($result)> 0)
     {
         return $result;
     }  else {
         return FALSE;
     }
    }
    
    
    //generic stub to insert into a table
    public function insert($tab, $a, $b)
    {      
     $connection = $this->connect();
     $sql = "INSERT INTO $tab(".implode(',',$a). ") VALUES(".implode(',',$b). ")";
     $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
     if($result)
     {
         return mysqli_insert_id($connection);
     }
     else 
     {
         return FALSE;
     }
    }

   //generic stub to update a table
   public function update($tab, $a, $b, $c)
   {
       $connection = $this->connect();
       $sql = "update $tab set $a = '$b' where $c";
       $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if($result)
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
   }


    //generic stub to update a table
   function edit($tab, $set, $where)
   {
        $connection = $this->connect();
       $sql = "update $tab set ".$set." where ".$where;
       $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if($result)
        {
            return TRUE; 
        }
        else 
        {
            return FALSE;
        }
   }
   
//generic stub to delete from a table
    function delete($tab, $a, $b)
    {
        $connection = $this->connect();
        $sql = "delete $a from $tab where $b";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if($result)
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }
    
    
//generic stub to delete from a table
function delete2($tab,  $where)
{
    $connection = $this->connect();
    $sql = "delete from $tab where $where";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    if($result)
    {
        return TRUE;
    }
    else 
    {
        return FALSE;
    }
}
    //generic stub to count from a table
    public function counter($tab)
    {
        $connection = $this->connect();
        $sql = "SELECT COUNT(*) as total FROM $tab";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if($result)
        {
            $data=mysqli_fetch_assoc($result);
            return $data['total'];
        }
        else 
        {
            return 0;
        }
    }

     //generic stub to count from a table
    public function counter2($tab, $wer)
    {
         $connection = $this->connect();
         $sql = "SELECT COUNT(*) as total FROM $tab where $wer";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if(mysqli_num_rows($result)> 0)
        {
            return $result;
        }  else {
            return FALSE;
        }
    }
    
    //Retrieve DB contents for a generic table with where condition    
   public function dRetrieve($tab, $attr, $wer)
    {
     $connection = $this->connect();
     $sql = "SELECT DISTINCT $attr FROM $tab where $wer";
     $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
     if(mysqli_num_rows($result)> 0)
     {
         return $result;
     }  else {
         return FALSE;
     }
    }

    public function groupbyRetrieve($tab, $attr, $limit)
    {
        $connection = $this->connect();
        $sql = "SELECT  $attr, COUNT(*) AS count FROM $tab GROUP BY ($attr) ORDER BY 2 DESC LIMIT $limit";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        if(mysqli_num_rows($result)> 0)
        {
            return $result;
        }  else {
            return FALSE;
        }
    }


    
    public function dbString($str){
        $connection = $this->connect();
        $string = mysqli_real_escape_string($connection, $str);
        return $string;
    }
        
    public function email($from, $to, $subject, $body="", $reply=""){
         require('PEAR/Mail.php'); 
    
        $headers['From'] = $from;
        $headers['To'] = $to;
        $headers['Reply-To'] = (!empty($reply)) ? $reply : "";
        $headers['Subject'] = $subject;
        $headers['Content-Type'] = "text/html; charset=iso-8859-1";
        $headers['MIME-Version'] = "1.0";
        $params['sendmail_path'] = '/usr/lib/sendmail';
    
        // Create the mail object using the Mail::factory method
        $mail_object =& Mail::factory('sendmail', $params);
    
        $mail_object->send($to, $headers, $body);
    
    }

    public function requestMessage($msg, $type="info"){
        // $type=success/danger/info
        return  '<div class="alert alert-'.$type.' alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p>'.$msg.'</p>
                </div>';
    }

    public function closedb($connection)
    {
        $close_connection = @mysqli_close($connection) or die(mysqli_error($connection));
    }
    
}
