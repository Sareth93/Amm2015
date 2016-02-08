<?php
    
    class model{
        private static $mysql;
        private static $usrRoot="accaFederico";
        private static $pwdRoot="picchio8034";
        private static $db="amm15_accaFederico";
        
        public function _construct(){
            self::$mysql=new mysqli();
            session_start();
        }
        
        private function connectToDB(){
            self::$mysql->connect("localhost",self::$usrRoot, self::$pwdRoot, self::$db);
        }
        
        //gestione login
        public function login(){
            if(isset($_REQUEST['username'])&& isset($_REQUEST['password'])){
                $this->connectToDB();
                if(self::$mysql->errno>0)
                    return "Error";
                $result=self::$mysql->query("SELECT username, password, id FROM users;");
                while($row=$result->fetch_row()){
                    if(($_REQUEST['username']==$row[0])&& ($_REQUEST['password']==$row[1])){
                        $_SESSION["loggedIn"]=true;
                        $_SESSION["username"]=$_REQUEST['username'];
                        $_SESSION["password"]=$_REQUEST['password'];
                        
                        if($row[2]==1)
                            $_SESSION["admin"]=true;
                        
                        return $_SESSION["username"];
                    }
                }
                return "Error";
            }
            else {
                return "Error";
            }
        }
        
        //logout e terminazione sessione
        public function logout(){
            $_SESSION=array();
            if(session_id()!="" || isset($_COOKIE[session_name()]))
                setcookie(session_name (),'',time()-2592000,'/');
            session_destroy();                    
        }
        //elenco Canzoni
        public function songs(){
            $this->connectToDB();
            if(self::$mysql->errno>0)
                return "Login Error";
            
            $result= self::$mysql->query("SELECT title, artist, songs.id FROM songs, artists WHERE artists.id=songs.artist_id;");
            if(self::$mysql->errno>0)
                return "Error";
            else
                return $result;
        }
        
        //elenco Artisti
        public function artists(){
            $this->connectToDB();
            if(self::$mysql->errno>0)
                return "Login Error";
            $result= self::$mysql->query("SELECT name, id FROM artists;");
            if(self::$mysql->errno>0)
                return "Error";
            else
                return "Ok";
        }
        
        
        
        
    }

?>

