<?php
    include_once("Model/model.php");
    
    class controller{
        
        public $model;
        public function __construct(){
            $this->model=new model();
        }
        
        public function content($arg){
            //presentazione menù login
            if(($arg=="" && !isset($_SESSION['logIN'])) || ($arg=="loginTry"))
                include 'Viewer/loginTry.php';
            else if($arg=="" && isset($_SESSION['loggedIn']))
                include 'Viewer/loginSucc.php';
            else if($arg=="login"){
                $result=$this->model->login();
                if($result != "Error"){
                    while($row=$result->fetch_row()){
                        if(($_REQUEST['username']==$row[0]) && ($_REQUEST['password']==$row[1])){
                            $_SESSION["logIN"]=true;
                            $_SESSION["username"]=$_REQUEST['username'];
                            $_SESSION["password"]=$_REQUEST['password'];                        
                            if($row[2]==1)
                                $_SESSION["adm"]=true;                        
                            return $_SESSION["username"];
                        }
                    }
                }
                else
                    include 'Viewer/loginTry.php';
            }
            else if($arg=="logout"){                
                $result=  $this->model->logout();
                if($result!= "Error")
                    include 'Viewer/loginTry.php';
            }
            else if($arg=="songs"){
                $songs=$this->model->songs();
                if($songs=="Login Error")
                    include 'Viewer/loginFail.php';
                else if($songs=="Error")
                    include 'Viewer/error.php';
                else{
                    if(isset($_SESSION['adm'])){
                        $artist=$this->model->artistsList();
                        include 'Viewer/songListAdmin.php';
                    }
                    else{
                        $artist=$this->model->artistsList();
                        include 'Viewer/songList.php';
                    }
                }
            }
            else if($arg=="newSong"){
                if(isset($_SESSION['adm'])){
                    $result=$this->model->addSong();
                    if($result!="Error")
                        include 'Viewer/songAdded.php';                        
                    else
                        include 'Viewer/error.php';
                }                
                else
                    include 'Viewer/accessDenied.php';
            }
            else if($arg=="deleteSong"){
                if(isset($_SESSION['adm'])){
                    $result=  $this->model->deleteSong();
                    if($result != "Error")
                        include "Viewer/songDeleted.php";
                    else
                        include "Viewer/error.php";
                }
                else
                    include 'Viewer/accessDenied.php';
            }                                                                        
        }        
        public function sidebar(){
            if(isset($_SESSION['logIN'])){
                if(isset($_SESSION['adm']))
                    include "Viewer/Sidebar/adm.php";
                else
                    include "Viewer/Sidebar/usr.php";
            }
            else
                include "Viewer/Sidebar/guest.php";
        }
    }

?>
