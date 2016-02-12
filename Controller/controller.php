<?php
    include_once("Model/model.php");
    
    class controller{
        
        public $model;
        public function _construct(){
            $this->model=new model();
        }
        
        public function content($arg){
            //presentazione menù login
            if(($arg=="" && !isset($_SESSION['logIN'])) || ($arg=="loginTry"))
                include 'Viewer/loginTry.php';
            else if($arg=="" && isset($_SESSION['logIN']))
                include 'Viewer/loginSucc.php';
            else if($arg=="login"){
                $result=$this->model->login();
                if($result != "Error")
                    include 'Viewer/loginSucc.php';
                else
                    include 'Viewer/loginTry.php';
            }
            else if($arg=="logout"){
                $result=  $this->model->logout();
                if($result!= "Error")
                    include 'Viewer/loginTry.php';
            }
            else if($arg=="songs"){
                $song=$this->model->songs();
                if($song=="Errore Login")
                    include 'Viewer/loginFail.php';
                else if($song== "Error")
                    include 'Viewer/error.php';
                else{
                    if(isset($_SESSION['admin'])){
                        $artist=$this->model->artists();
                        include 'Viewer/songListAdmin.php';
                    }
                    else
                        include 'Viewer/songList.php';
                }
            }
            else if($arg=="newUser"){
                $result=$this->model->newUser();
                
                if($result=="Insert Error")
                    include 'Viewer/invalidUsername.php'
                else if()
            }
        }
        
        public function sidebar(){
            if(isset($_SESSION['logIN'])){
                if(isset($_SESSION['Adm']))
                    include "Viewer/Sidebar/adm.php";
                else
                    include "Viewer/Sidebar/usr.php";
            }
            else
                include "Viewer/Sidebar/guest.php";
        }
    }

?>
