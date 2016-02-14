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
        //elenco utenti
        public function usersList(){
            $this->connectToDB();
            if(self::$mysqli->errno>0){
                echo "CiaousersList1";
                return "Error";
            }
            $result=self::$mysqli->query("SELECT username FROM users WHERE id>=2");
            if(self::$mysqli->errno>0){
                echo "CiaousersList2";
                return "Error";
            }
            else
                return $result;
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
        //elenco canzoni presenti tra i preferiti dell'utente
        public function favorites(){
            $this->connectToDB();
            if(self::$mysqli->errno>0){
                echo"favorites1";
                return "Error";}
            $result=self::$mysqli->query("SELECT title, artistName, users.username, song_id FROM songs, artists, users
                                          WHERE artists.artist_id=songs.artist_id AND id=favoriteBy");
            if(self::$mysqli->errno>0){
                echo"favorites2";
                return "Error";}
            else
                return $result;                   
        }
        //elenco canzoni non presenti tra i preferiti dell'utente
        public function notFavorite(){
            $this->connectToDB();
            if(self::$mysqli->errno>0){
                echo "notFavorite1";
                return "Error";}
            $result=self::$mysqli->query("SELECT title, song_id, artistName FROM songs, artist
                                          WHERE artist.artist_id=songs.artist_id AND favoriteBy IS NULL");
            if(self::$mysqli->errno>0){
                echo "notFavorite2";
                return "Error";}
            else
                return $result;                
        }      
        //aggiunta ai preferiti
        public function addFavoriteSong(){
            if(isset($_REQUEST['username']) && isset($_REQUEST['song'])){
                $user=$_REQUEST['username'];
                $song=$_REQUEST['song'];
                $this->connectToDB();
                if(self::$mysqli->errno>0){
                    echo "addFavSong1";
                    return "Error";}
                else{
                    self::$mysqli->query("UPDATE songs SET favoriteBy=(SELECT id FROM users WHERE users.username='$user') WHERE song_id='$song' AND favoriteBy IS NULL");
                    if(self::$mysqli->errno>0){
                        echo "addFavSong2";
                        return "Error";}
                    else
                        return "Ok";
                }
            }
            else{
                echo "addFavSong3";
                return "Error";}
        }
        //rimuove preferito
        public function removeFavorite(){
            if(isset($_REQUEST['song'])){
                echo "remFav0";
                $song=$_REQUEST['song'];
                $this->connectToDB();
                if(self::$mysqli->errno>0){
                    echo "removeFav1";
                    return "Error";}
                else{
                    self::$mysqli->query("UPDATE songs SET favoriteBy=NULL WHERE song_id='$song'");
                    if(self::$mysqli->errno>0){
                        echo "removeFav2";
                        return "Error";}
                    else
                        return "Ok";
                }
            }
            else{
                echo "removeFav3"; 
                return "Error";}
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
        //aggiunta artista
        public function addArtist(){
            if(isset($_REQUEST['artistName'])){
                $artistName=$_REQUEST['artistName'];
                $this->connectToDB();
                if(self::$mysqli->errno>0){
                    echo "addArt1";
                    return "Error";}
                else{
                    self::$mysqli->query("INSER INTO artists(artistName) VALUES ('$artistName')");
                    if(self::$mysqli->errno>0){
                        echo "addArt2";
                        return "Error";}
                    else
                        return "Ok";
                }
            }
        }                                
    }
?>

