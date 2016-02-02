<?php
    include_once("Model/model.php");
    
    class controller{
        
        public $model;
        public function _construct(){
            $this->model=new model();
        }
        
        public function content($arg){
            //presentazione menù login
            if(($arg=="" && !isset($_SESSION['loggedIn'])) || ($arg=="loginAttempt"))
                include 'Viewer/loginAttempt.php';
            else if($arg=="" && isset($_SESSION['loggedIn']))
                include 'Viewer/loginDone.php';
            else if($arg=="login"){
                $result=$this->model->login();
                if($result != "Error")
                    include 'Viewer/loginDone.php';
                else
                    include 'Viewer/loginAttempt.php';
            }
            else if($arg=="logout"){
                $result=  $this->model->logout();
                if($result!= "Error")
                    include 'Viewer/loginAttempt.php';
            }
        }
        
        public function sidebar(){
            if(isset($_SESSION['loggedIn'])){
                if(isset($_SESSION['admin']))
                    include "Viewer/Sidebar/admin.php";
                else
                    include "Viewer/Sidebar/user.php";
            }
            else
                include "Viewer/Sidebar/guest.php";
        }
    }

?>
