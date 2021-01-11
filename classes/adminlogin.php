<?php 
include '../lib/session.php';

session::checkLogin();

include_once  '../lib/Database.php';
include_once '../helpers/format.php';
?>

<?php

class adminlogin{
    
    private $db;
    
    private $fm;
    
    public function __construct(){
     $this->db = new Database();
     $this->fm= new format();
    }
    
    public function admin_login($adminUser,$adminPass){
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);
        $adminUser = mysqli_real_escape_string($this->db->link,$adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link,$adminPass);
        
        if(empty($adminUser) || empty($adminPass)){
            $login_msg = "Username or password must not be empty";
        }else{
            $query = "select * from tbl_admin where admin_user='$adminUser' and admin_pass = '$adminPass' ";
            $results = $this->db->select($query);
            if($results != false){
                $value = $results->fetch_assoc();
                session::set("admin_login", true);
                session::set("admin_id", $value['admin_id']);
                session::set("admin_user", $value['admin_user']);
                session::set("admin_name", $value['admin_name']);
                header("Location:dashboard.php");
            }else{
                $login_msg = "username or password not match";
                return $login_msg;
            }
        }
        
    }
}

?>