<?php
@session_start();
require_once 'dbController.php';

class loggers {
    var $dbController;
    function _construct()
    {
        $this->dbController = new dbController();
    }

  //get Admin loggers info    
    public function admLoggers()
    {
        //retrieve personal details   
                    $this->_construct();                           
                    $was = 'email = "'.$_SESSION['username'].'" limit 1';
                    $results = $this->dbController->retrieve("members", $was);
                    if($results !=FALSE)
                    {
                        $rows = mysqli_fetch_array($results);
                        extract($rows);
                        
                        $_SESSION['level'] = "User";
                        $_SESSION['user_id'] = $rows['id'];                      
                        $_SESSION['fname'] = $rows['fname'];
                        $_SESSION['lname'] = $rows['lname'];
                        $_SESSION['email'] = $rows['email'];
                        $_SESSION['bio'] = $rows['summary'];
                        $_SESSION['email'] = $rows['email'];                     
                        $_SESSION['image'] = $rows['pix'];
                        $_SESSION['phone'] = $rows['phone'];
                        $_SESSION['regDate'] = $rows['whens'];
                        $_SESSION['type'] = $rows['type'];
                        if(!empty($rows['pix']))
                            { $_SESSION['image'] = $rows['pix']; }else{ $_SESSION['image'] = "avatar.png"; 
                            } 
                    } 
                    header("Location: ../index.php");               
     }

      //get staff loggers info    
    public function staffLoggers()
    {
        //retrieve personal details   
                    $this->_construct();                                                      
                    $was = 'email = "'.$_SESSION['username'].'" limit 1';
                    $results = $this->dbController->retrieve("members", $was);
                    if($results !=FALSE)
                    {
                        $rows = mysqli_fetch_array($results);
                        extract($rows);

                        $_SESSION['level'] = "Staff";
                        $_SESSION['user_id'] = $rows['id'];                      
                         $_SESSION['name'] = $rows['fullname'];
                        $_SESSION['email'] = $rows['email'];
                        $_SESSION['bio'] = $rows['summary'];
                        $_SESSION['email'] = $rows['email'];                     
                        $_SESSION['image'] = $rows['pix'];
                        $_SESSION['phone'] = $rows['phone'];
                        $_SESSION['regDate'] = $rows['whens'];
                        $_SESSION['type'] = $rows['type'];
                       if(!empty($rows['pix']))
                            { $_SESSION['image'] = $rows['pix']; }else{ $_SESSION['image'] = "avatar.png"; 
                            }             
                    } 
                    header("Location: ../report-add.php?id=2");               
     }

      //get property owner loggers info    
    public function ownerLoggers()
    {
        //retrieve personal details        
                    $this->_construct();                                                 
                    $was = 'email = "'.$_SESSION['username'].'" limit 1';
                    $results = $this->dbController->retrieve("people", $was);
                    if($results !=FALSE)
                    {
                        $rows = mysqli_fetch_array($results);
                        extract($rows);
                        $_SESSION['level'] = "Property Owner";
                        $_SESSION['user_id'] = $rows['id'];                      
                        $_SESSION['surname'] = $rows['surname'];
                        $_SESSION['othernames'] = $rows['othernames'];                       
                        $_SESSION['email'] = $rows['email'];
                        $_SESSION['name'] = $rows['surname']." ".$rows['othernames'];
                        $_SESSION['gender'] = $rows['gender'];  
                        $_SESSION['address'] = $rows['address'];                     
                        $_SESSION['image'] = $rows['image'];
                        $_SESSION['dob'] = $rows['dob'];
                        $_SESSION['regDate'] = $rows['regDate'];
                        $_SESSION['type'] = $rows['type'];
                         if(!empty($rows['image']))
                            { $_SESSION['image'] = $rows['image']; }else{ $_SESSION['image'] = "user.jpg"; 
                            }   
                        
                    } 
                    header("Location: ../index.php?id=3");               
     }


  //get property Renters loggers info    
    public function tenantLoggers()
    {
        //retrieve personal details        
                    $this->_construct();                                                 
                    $was = 'phone = "'.$_SESSION['username'].'" limit 1';
                    $results = $this->dbController->retrieve("people", $was);
                    if($results !=FALSE)
                    {
                        $rows = mysqli_fetch_array($results);
                        extract($rows);
                        $_SESSION['level'] = "Tenant";
                        $_SESSION['user_id'] = $rows['id'];                      
                        $_SESSION['surname'] = $rows['surname'];
                        $_SESSION['othernames'] = $rows['othernames'];                       
                        $_SESSION['email'] = $rows['email'];
                        $_SESSION['name'] = $rows['surname']." ".$rows['othernames'];
                        $_SESSION['gender'] = $rows['gender'];  
                        $_SESSION['address'] = $rows['address'];                     
                        $_SESSION['image'] = $rows['image'];
                        $_SESSION['dob'] = $rows['dob'];
                        $_SESSION['regDate'] = $rows['regDate'];
                        $_SESSION['type'] = $rows['type'];
                         if(!empty($rows['image']))
                            { $_SESSION['image'] = $rows['image']; }else{ $_SESSION['image'] = "user.jpg"; 
                            }   
                        
                    } 
                    header("Location: ../index.php?id=4");               
     }


//get Lawyer loggers info    
    public function lawyerLoggers()
    {
                     header("Location: ../login.php?id=5");   
     }


//get workers loggers info    
    public function workerLoggers()
    {
                     header("Location: ../login.php?id=6"); 
     }

//get accountants loggers info    
    public function accLoggers()
    {
        //retrieve personal details        
                    $this->_construct();                                                 
                    $was = 'phone = "'.$_SESSION['username'].'" limit 1';
                    $results = $this->dbController->retrieve("people", $was);
                    if($results !=FALSE)
                    {
                        $rows = mysqli_fetch_array($results);
                        extract($rows);
                        $_SESSION['level'] = "Accountant";
                        $_SESSION['user_id'] = $rows['id'];                      
                        $_SESSION['surname'] = $rows['surname'];
                        $_SESSION['othernames'] = $rows['othernames'];                       
                        $_SESSION['email'] = $rows['email'];
                        $_SESSION['name'] = $rows['surname']." ".$rows['othernames'];
                        $_SESSION['gender'] = $rows['gender'];  
                        $_SESSION['address'] = $rows['address'];                     
                        $_SESSION['image'] = $rows['image'];
                        $_SESSION['dob'] = $rows['dob'];
                        $_SESSION['regDate'] = $rows['regDate'];
                        $_SESSION['type'] = $rows['type'];
                         if(!empty($rows['image']))
                            { $_SESSION['image'] = $rows['image']; }else{ $_SESSION['image'] = "user.jpg"; 
                            }   
                        
                    } 
                    header("Location: ../index.php?id=7");               
     }

    //get super admin loggers info    
    public function adLogger()
    {
        $_SESSION['level'] = "Super Admin";
        $_SESSION['name'] = "Super Admin";                        
        $_SESSION['phone'] = "08101510466";
        $_SESSION['address'] = "";
        $_SESSION['user_id'] = 0;                      
        $_SESSION['surname'] = "";
        $_SESSION['othernames'] = "";                       
        $_SESSION['email'] = "wispm1@gmail.com";
        $_SESSION['gender'] = "";;  
        $_SESSION['image'] = "client5.jpg";
        $_SESSION['type'] = "1";
        header("Location: ../index.php?id=1");
     
    }



}
