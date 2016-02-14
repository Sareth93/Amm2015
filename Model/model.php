<?php    
    class model{
        private static $mysqli;
        private static $usrRoot="accaFederico";
        private static $pwdRoot="picchio8034";
        private static $db="amm15_accaFederico";
        
        public function __construct(){
            self::$mysqli=new mysqli();
            session_start();
        }        
        private function connectToDB(){
            @self::$mysqli->connect("localhost", self::$usrRoot, self::$pwdRoot, self::$db);
        }        
        //gestione login
        public function login(){
            if(isset($_REQUEST['username'])&& isset($_REQUEST['password'])){
                $this->connectToDB();
                $result=self::$mysqli->query("SELECT username, password, id FROM users");
                if(self::$mysqli->errno>0){
                    echo "Ciaologin";
                    return "Error";
                }
                else
                    return $result;
            }
        }        
        //gestione logout e terminazione sessione
        public function logout(){        
            $_SESSION=array();
            if(session_id()!="" || isset($_COOKIE[session_name()]))
                setcookie(session_name (),'',time()-2592000,'/');
            session_destroy();              
        }
        //elenco canzoni
        public function songs(){
            $this->connectToDB();           
            if(self::$mysqli->errno>0){
                echo "songs1";
                return "Login Error"; 
            }
            $result= self::$mysqli->query("SELECT title, song_id, artistName FROM songs, artists WHERE songs.artist_id=artists.artist_id");
            if(self::$mysqli->errno>0){
                echo "songs2";
                return "Error";
            }
            else
                return $result;
        }
        //aggiunta canzone
        public function addSong(){
            if(isset($_REQUEST['title']) && isset($_REQUEST['artist'])){
                $title=$_REQUEST['title'];
                $artist=$_REQUEST['artist'];
                $this->connectToDB();
                if(self::$mysqli->errno>0){
                    echo "addSong1";
                    return "Error";}
                else{
                    self::$mysqli->query("INSERT INTO songs(title,artist_id) VALUES ('$title', '$artist')");
                    if(self::$mysqli->errno>0){
                        echo "addSong2";
                        return "Error";}
                    else
                        return "Ok";
                }
            }
        }
        //rimozione canzone
        public function deleteSong(){
            if(isset($_REQUEST['delete'])){
                $this->connectToDB();
                if(self::$mysqli->errno>0){
                    echo "deleteSong1";
                    return "Error";}
                else{
                    $song_id=$_REQUEST['delete'];
                    $del=self::$mysqli->query("DELETE FROM songs WHERE song_id='$song_id' AND favoriteBy IS NULL");
                    if(self::$mysqli->errno>0 || self::$mysqli->affected_rows!=1){
                        echo "deleteSong1";
                        return "Error";}
                    else
                        return "Ok";
                }
            }
        } 
        //elenco artisti
        public function artistsList(){
            $this->connectToDB();
            if(self::$mysqli->errno>0)
                return "Login Error";
            $result= self::$mysqli->query("SELECT artistName, artist_id FROM artists");
            /*if(self::$mysqli->errno>0)
                return "Error";
            else*/
                return $result;
        }
    }
?>

