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
                if(self::$mysqli->errno>0)
                    return "Error";
                $result=self::$mysqli->query("SELECT username, password, id FROM users;");
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
                return "Error";
            }
            else
                return "Error";            
        }        
        //gestione logout e terminazione sessione
        public function logout(){            
            $_SESSION=array();
            if(isset($_SESSION[session_name()])){
                setcookie(session_name(),'',time()-3600);
            }
            session_destroy();
            /*$_SESSION=array();
            if(session_id()!="" || isset($_COOKIE[session_name()]))
                setcookie(session_name (),'',time()-2592000,'/');
            session_destroy();     */               
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
                $result=  self::$mysqli->query("INSERT INTO users(username,password) VALUES ('$user', '$password');");
                if(self::$mysqli->errno>0){
                    self::$mysqli->rollback();
                    self::$mysqli->close();
                    return "IError";
                }
                else{
                    $result=self::$mysqli->query("UPDATE users SET password='$password' WHERE username='$user';");
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
            }
            else
                return "Error";
        }        
        //elenco utenti
        public function usersList(){
            $this->connectToDB();
            if(self::$mysqli->errno>0)
                return "Error";
            $result=self::$mysqli->query("SELECT username FROM users WHERE id>=2;");
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
        //aggiunta canzone
        public function addSong(){
            if(isset($_REQUEST['title']) && isset($_REQUEST['artist'])){
                $title=$_REQUEST['title'];
                $artist=$_REQUEST['artist'];
                $this->connectToDB();
                if(self::$mysqli->errno>0)
                    return "Error";
                else{
                    self::$mysqli->query("INSERT INTO songs(title,artist_id) VALUES ('$title', '$artist');");
                    if(self::$mysqli->errno>0)
                        return "Error";
                    else
                        return "Ok";
                }
            }
        }
        //rimozione canzone
        public function deleteSong(){
            if(isset($_REQUEST['delete'])){
                $this->connectToDB();
                if(self::$mysqli->errno>0)
                    return "Error";
                else{
                    $song_id=$_REQUEST['delete'];
                    $del=self::$mysqli->query("DELETE FROM songs WHERE song_id='$song_id' AND favoriteBy IS NULL;");
                    if(self::$mysqli->errno>0)
                        return "Error";
                    else
                        return "Ok";
                }
            }
        }
        //elenco canzoni presenti tra i preferiti dell'utente
        public function favorites(){
            $this->connectToDB();
            if(self::$mysqli->errno>0)
                return "Error";
            $result=self::$mysqli->query("SELECT title, artists.artistName, users.username, songs.song_id FROM songs, artists, users
                                          WHERE artists.artist_id=songs.artist_id AND users.id=songs.favoriteBy;");
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
        //aggiunta ai preferiti
        public function addFavoriteSong(){
            if(isset($_REQUEST['username']) && isset($_REQUEST['song'])){
                $user=$_REQUEST['username'];
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
        //rimuove preferito
        public function removeFavorite(){
            if(isset($_REQUEST['song'])){
                $song=$_REQUEST['song'];
                $this->connectToDB();
                if(self::$mysqli->errno>0)
                    return "Error";
                else{
                    self::$mysqli->query("UPDATE songs SET favoriteBy=NULL WHERE song_id='$song';");
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
            $result= self::$mysql->query("SELECT name, artist_id FROM artists;");
            if(self::$mysqli->errno>0)
                return "Error";
            else
                return $result;
        }
        //aggiunta artista
        public function addArtist(){
            if(isset($_REQUEST['artistName'])){
                $artistName=$_REQUEST['artistName'];
                $this->connectToDB();
                if(self::$mysqli->errno>0)
                    return "Error";
                else{
                    self::$mysqli->query("INSER INTO artists(artistName) VALUES ('$artistName');");
                    if(self::$mysqli->errno>0)
                        return "Error";
                    else
                        return "Ok";
                }
            }
        }                 
    }
?>

