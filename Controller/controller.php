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
                if($result!="Error")
                    include 'Viewer/loginSucc';
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
                    else
                        include 'Viewer/songList.php';
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
            else if($arg="favoriteList"){
                if(isset($_SESSION['username'])){
                    $result=$this->model->favorites();
                   if($result=="Error")
                        include 'Viewer/error.php';
                    else
                        include 'Viewer/favoriteList.php';
                }
            }
            else if($arg=="notFavoriteList"){
                if(isset($_SESSION['username'])){
                    $usr=$this->model->usersList();
                    $songs=  $this->model->notFavorite();
                    include 'Viewer/newFavorite.php';
                }
            }
            else if($arg=="addFavorite"){
                $temp=$this->model->addFavoriteSong();
                if($temp=="Error")
                    include 'Viewer/newFavorite.php';
                else
                    include 'Viewer/favoriteAdded.php';
            }
            else if($arg="removeFavorite"){
                $result=$this->model->removeFavorite();
                if($result=="Error"){
                    echo "Errore!";
                    include 'Viewer/favoriteList.php';
                }
                else
                    include 'Viewer/favoriteRemoved.php';
            }
            else if($arg="addArtist1"){
                if(isset($_SESSION['adm']))
                    include 'Viewer/newArtist.php';
            }
            else if($arg="addArtist2"){
                if(isset($_SESSION['adm'])){
                    $temp=$this->model->addArtist();
                    if($temp=="Error")
                        include "Viewer/newArtist.php";
                    else
                        include "Viewer/artistAdded.php";
                }
            }
            /*else if($arg="register"){
                if(isset($_SESSION['logIN']))
                    include 'Viewer/logoutFail.php';
                else
                    include 'Viewer/register.php';
            }
            else if($arg=="newUser"){
                $result=$this->model->newUser();                
                if($result=="IError")
                    include 'Viewer/invalidUsername.php';
                else if($result=="Error")
                    include 'Viewer/error.php';
                else
                    include "Viewer/registrationDone.php";
            }*/                                                               
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
