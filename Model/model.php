<?php
    
    class model{
        private static $mysqli;
        private static $usrRoot="accaFederico";
        private static $pwdRoot="picchio8034";
        private static $db="amm15_accaFederico";
        
        public function _construct(){
            self::$mysqli=new mysqli();
            session_start();
        }
        
        private function connectToDB(){
            self::$mysqli->connect("localhost",self::$usrRoot, self::$pwdRoot, self::$db);
        }
        
        //gestione login
        public function login(){
            if(isset($_REQUEST['username'])&& isset($_REQUEST['password'])){
                $this->connectToDB();
                if(self::$mysqli->errno>0)
                    return "Error";
                $result=self::$mysqli->query("SELECT username, password, id FROM users;");
                while($row=$result->fetch_row()){
                    if(($_REQUEST['username']==$row[0])&& ($_REQUEST['password']==$row[1])){
                        $_SESSION["logIN"]=true;
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
        
        //gestione logout e terminazione sessione
        public function logout(){
            $_SESSION=array();
            if(session_id()!="" || isset($_COOKIE[session_name()]))
                setcookie(session_name (),'',time()-2592000,'/');
            session_destroy();                    
        }
        //inserimento nuova utente
        public function newUser(){
            if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
                $result=  $this->connectToDB();
                if(self::$mysqli->errno>0)
                    return "Error";
                $user=$_REQUEST['username'];
                $password=$_REQUEST['password'];
                
                self::$mysqli->autocommit(false);
                $result=  self::$mysqli->query("INSERT INTO users(username,password) VALUES ('$user', 'pass');");
                if(self::$mysqli->errno>0){
                    self::$mysqli->rollback();
                    self::$mysqli->close();
                    return "Error";
                }
                else{
                    self::$mysqli->commit();
                    self::$mysqli->autocommit(true);
                    return "Ok";
                }                
            }
            else
                return "Error";
        }
        
        //elenco utenti
        public function usersList(){
            $this->connectToDB();
            if(self::$mysqli->errno>0)
                return "Error";
            $result=self::$mysqli->query("SELECT username FROM users WHERE ID>=1;");
            if(self::$mysqli->errno>0)
                return "Error";
            else
                return $result;
        }
        //elenco canzoni
        public function songs(){
            $this->connectToDB();
            if(self::$mysqli->errno>0)
                return "Login Error";            
            $result= self::$mysqli->query("SELECT title, artistName, songs.song_id FROM songs, artists WHERE artists.artist_id=songs.artist_id;");
            if(self::$mysqli->errno>0)
                return "Error";
            else
                return $result;
        }
        //elenco canzoni non presenti tra i preferiti dell'utente
        public function notFavorite(){
            $this->connectToDB();
            if(self::$mysqli->errno>0)
                return "Error";
            $result=self::$mysqli->query("SELECT title, song.song_id, artistName FROM songs, artist WHERE artist.artist_id=songs.artist_id AND favoriteBy IS NULL;");
            if(self::$mysqli->errno>0)
                return "Error";
            else
                return $result;                
        }
        //inserimento preferito
        public function favoriteSong(){
            if(isset($_REQUEST['user']) && isset($_REQUEST['song'])){
                $user=$_REQUEST['user'];
                $song=$_REQUEST['song'];
                $this->connectToDB();
                if(self::$mysqli->errno>0)
                    return "Error";
                else{
                    self::$mysqli->query("UPDATE songs SET favoriteBy=(SELECT id FROM users WHERE username='$user') WHERE song_id='$song' AND favoriteBy IS NULL;");
                    if(self::$mysqli->errno>0)
                        return "Error";
                    else
                        return "Ok";
                }
            }
            else
                return "Error";
        }
        //elenco artisti
        public function artists(){
            $this->connectToDB();
            if(self::$mysqli->errno>0)
                return "Login Error";
            $result= self::$mysql->query("SELECT name, id FROM artists;");
            if(self::$mysqli->errno>0)
                return "Error";
            else
                return "Ok";
        }
        
        
        
        
    }

?>

