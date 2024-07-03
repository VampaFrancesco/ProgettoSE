<?php
$conn = mysqli_connect('localhost','phperrucci','','my_phperrucci') or die("errore connessione");
session_start();
function testata() {
echo "<!DOCTYPE html>\n";
echo '<html lang="it">'."\n";
echo "<head>\n";
echo "<title>Univaq</title>\n";
echo '<meta charset="UTF-8">'."\n";
echo '<link href="https://phperrucci.altervista.org/Esercizi_Info/w3.css" rel="stylesheet" type="text/css">'."\n";
echo '<style>             .header {                 text-align: center;                 padding: 50px;                 background-color: #f1f1f1;             }             .header h1 {                 color: #d32f2f;                 font-size: 3em;                 margin: 0;             }             .w3-bar-item a {                 color: white;                 font-weight: bold;             }           </style>'."\n";
echo "</head>\n";
echo "<body>\n";
echo '<div class="w3-bar w3-red">
<div class="w3-bar-item"><a style="text-decoration: none;" href="podcastUnivaq.php">Home</a></div>
<div class="w3-bar-item"><a style="text-decoration: none;" href="podcastUnivaq.php?pag=reg">Registrazione</a></div>
<div class="w3-bar-item"><a style="text-decoration: none;" href="podcastUnivaq.php?pag=ric">Ricerca</a></div>
<div class="w3-bar-item w3-right"><a style="text-decoration: none;" href="podcastUnivaq.php?pag=login">Login</a></div>
</div>';
}
function testata2() {
    echo "<!DOCTYPE html>\n";
    echo '<html lang="it">'."\n";
    echo "<head>\n";
    echo "<title>Univaq</title>\n";
    echo '<meta charset="UTF-8">'."\n";
    echo '<link href="https://phperrucci.altervista.org/Esercizi_Info/w3.css" rel="stylesheet" type="text/css">'."\n";
    echo '<style>             .header {                 text-align: center;                 padding: 50px;                 background-color: #f1f1f1;             }             .header h1 {                 color: #d32f2f;                 font-size: 3em;                 margin: 0;             }             .w3-bar-item a {                 color: white;                 font-weight: bold;             }           </style>'."\n";
    echo "</head>\n";
    echo "<body>\n";
    echo '<div class="w3-bar w3-red">
    <div class="w3-bar-item"><a style="text-decoration: none;" href="podcastUnivaq.php">Home</a></div>
    <div class="w3-bar-item"><a style="text-decoration: none;" href="podcastUnivaq.php?pag=upload">Carica</a></div>
    <div class="w3-bar-item"><a style="text-decoration: none;" href="podcastUnivaq.php?pag=ric">Ricerca</a></div>
    <div class="w3-bar-item w3-right"><a style="text-decoration: none;" href="podcastUnivaq.php?pag=logout">Logout</a></div>
    </div>';
    }
function countFilesInDirectory($directory) {
    if (!is_dir($directory)) {
        return 0;
    }

    // Ottiene tutti i file e le directory all'interno della directory specificata
    $files = scandir($directory);

    // Filtra solo i file
    $fileCount = 0;
    foreach ($files as $file) {
        // Escludi le directory speciali "." e ".."
        if ($file !== '.' && $file !== '..' && is_file($directory . '/' . $file)) {
            $fileCount++;
        }
    }
    $fileCount++;
    return $fileCount;
}
function footer() {
    echo "</body>\n";
    echo "</html>\n";
    }
    if($_GET["pag"]=='' && $_POST["loc"]=='' && $_SESSION["nome"]==''){
        testata();
        echo '<div class="header"><h1>BENVENUTI A (UNIVAQ) PODCAST</h1></div>';
        echo '<div>';
        echo '<img class="mySlides" src="https://phperrucci.altervista.org/podcast/Foto/sport.jpg" height="500" width="500">';
        echo '<img class="mySlides" src="https://phperrucci.altervista.org/podcast/Foto/game.jpg" height="500" width="500">';
        echo '<img class="mySlides" src="https://phperrucci.altervista.org/podcast/Foto/crime.jpg" height="500" width="500">';
        // echo    '<button class="w3-button w3-display-left" onclick="plusDivs(-1)">&#10094;</button>';
        // echo    '<button class="w3-button w3-display-right" onclick="plusDivs(+1)">&#10095;</button>';
        echo '</div>';
        echo '<script>
        var myIndex = 0;
        carousel();
        
        function carousel() {
          var i;
          var x = document.getElementsByClassName("mySlides");
          for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
          }
          myIndex++;
          if (myIndex > x.length) {myIndex = 1}    
          x[myIndex-1].style.display = "block";  
          setTimeout(carousel, 2000); // Change image every 2 seconds
        }
        </script>';
        footer();
        }
        
    if($_GET["pag"]=='reg' && $_POST["loc"]==''){
        testata();
        echo '<div class="w3-center">';
        echo '<h1>Inserisci un nuovo utente</h1>'."\n";
        echo '<form method="POST" action="podcastUnivaq.php">'."\n";
        //sotto nome
        echo '<p><input type="text" placeholder="Nome" name="nome" id="nome" required>';
        //sotto cognome
        echo '<p><input type="text" placeholder="Cognome" name="cognome" id="cognome" required>';
        //sotto mail
        echo '<p><input type="email" placeholder="Email" name="mail" id="mail" required>';
        //sotto password
        echo '<p><input type="password" placeholder="Password" name="password" id="password" required>';
        //sotto submit
        echo '<input type="hidden" name="loc" value="controllo">'."\n";
        echo '<p><input type="submit" class="w3-button w3-green w3-round" value="SALVA"></p>'."\n";
        echo "</form>\n";
        echo '<a href=podcastUnivaq.php class="w3-button w3-red w3-round">Torna indietro</a>';
        echo '</div>';
        footer();
        }

        if ($_GET["pag"]=='' && $_POST["loc"]=='controllo') {
            $controllo=false;
            //controllo username
            $q = 'SELECT * FROM univaqpogcast';
            $ris = mysqli_query($conn,$q) or die("errore");
            echo $error;
            while ($riga = mysqli_fetch_assoc($ris)) {
                if($riga["mail"]==$_POST["mail"]){
                    $controllo=true; //se controllo è true ferma tutto
                }
                }
                //controllo password
                $uppercase    = preg_match('/[A-Z]/', $_POST["password"]); //controlla se c'è una maiuscola
                $lowercase    = preg_match('/[a-z]/', $_POST["password"]); //controlla se ci sta una minuscola
                $number       = preg_match('/[0-9]/', $_POST["password"]); //controlla se ci sta un numero
                $specialChars = preg_match('/[^\w]/', $_POST["password"]); //controlla se è presente un carattere non speciale
                //il ^ sarebbe un not, il \w indica tutti i caratteri normali, quindi controlla i caratteri non normali
                if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST["password"]) < 8) {
                    $controllo=true;
                }
    
                if($controllo){
                    header("Location:podcastUnivaq.php?pag=reg");
                }
                else{ //se controllo è falso allora inserisce
                    $options = ['cost' => 8];
                    $q = "insert into univaqpogcast (Nome, Cognome ,Password , Mail) values (";
                    $q.= "'".mysqli_real_escape_string($conn,$_POST["nome"])."',";
                    $q.= "'".mysqli_real_escape_string($conn,$_POST["cognome"])."',";
                    $q.= "'".password_hash($_POST["password"], PASSWORD_BCRYPT, $options)."',";
                    $q.= "'".mysqli_real_escape_string($conn,$_POST["mail"])."')";
                    echo '<p>'.$q.'</p>';
                    $ris = mysqli_query($conn,$q) or die("errore inserimento utente");
                    echo '<p>'.mysqli_error($conn).'</p>';
                    header("Location:podcastUnivaq.php");
                }
        }
        if ($_GET["pag"]=="login" && $_POST["loc"]=='' && $_SESSION["nome"]==''){
            testata();
            echo '<div class="w3-center">';
            echo '<h1>Inserisci mail e password</h1>'."\n";
            echo '<form method="POST" action="podcastUnivaq.php">'."\n";
            //sotto email
            echo '<p><input type="email" placeholder="Email" name="mail" id="mail" required>';
            //sotto password
            echo '<p><input type="password" placeholder="Password" name="password" id="password" required>';
            
            //sotto submit
            echo '<input type="hidden" name="loc" value="controlloLogin">'."\n";
            echo '<p><input type="submit" class="w3-button w3-green w3-round" value="SALVA"></p>'."\n";
            echo "</form>\n";
            echo '<a href=podcastUnivaq.php class="w3-button w3-red w3-round">Torna indietro</a>';
            echo '</div>';
            footer();
        }
        if($_GET["pag"]== '' && $_POST["loc"]=="controlloLogin"){
            
            $q = 'select * from univaqpogcast where Mail='.'"'.$_POST["mail"].'"';
            $ris = mysqli_query($conn,$q) or die (mysqli_error($conn));
            if($riga=mysqli_fetch_assoc($ris)){ //se true allora la mail esiste
                if(password_verify($_POST["password"],$riga["Password"])){
                    $_SESSION["nome"]=$riga["Nome"];
                    // echo '<p>'.$_SESSION["nome"].'</p>';
                    header("Location:podcastUnivaq.php");
                }
                
            }
            else{
                testata();
                echo '<p>Mail o password errata</p>';
                footer();
            }
        }
        if($_GET["pag"]== 'logout' && $_POST["loc"]=='' && $_SESSION["nome"]!=''){
            session_destroy();
            header("Location:podcastUnivaq.php");
        }
        if($_GET["pag"]=='' && $_POST["loc"]=='' && $_SESSION["nome"]!=''){
            testata2();
            echo '<div class="header"><h1>BENTORNATO A (UNIVAQ) PODCAST, '.$_SESSION["nome"].'</h1></div>';
            echo '<div>';
            echo '<img class="mySlides" src="https://phperrucci.altervista.org/podcast/Foto/sport.jpg" height="500" width="500">';
            echo '<img class="mySlides" src="https://phperrucci.altervista.org/podcast/Foto/game.jpg" height="500" width="500">';
            echo '<img class="mySlides" src="https://phperrucci.altervista.org/podcast/Foto/crime.jpg" height="500" width="500">';
            // echo    '<button class="w3-button w3-display-left" onclick="plusDivs(-1)">&#10094;</button>';
            // echo    '<button class="w3-button w3-display-right" onclick="plusDivs(+1)">&#10095;</button>';
            echo '</div>';
            echo '<script>
            var myIndex = 0;
            carousel();
            
            function carousel() {
              var i;
              var x = document.getElementsByClassName("mySlides");
              for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
              }
              myIndex++;
              if (myIndex > x.length) {myIndex = 1}    
              x[myIndex-1].style.display = "block";  
              setTimeout(carousel, 2000); // Change image every 2 seconds
            }
            </script>';
            footer();
            }
            //pagina per il caricamento del file
        if($_GET["pag"]=='upload' && $_POST["loc"]=='' && $_SESSION["nome"]!=''){
            testata2();
            echo '<form action="podcastUnivaq.php" method="post" enctype="multipart/form-data">';
            echo '<input type="hidden" name="MAX_FILE_SIZE" value="1000000">';
            echo '<input type="file" id="audio" name="audio" accept="audio/*" required>';
            echo '<input type="hidden" name="loc" value="controlloUpload">'."\n";
            echo '<input type="submit" value="Carica audio" name="submit">';
            echo '</form>';
            footer();
        }
        if($_GET["pag"]=='' && $_POST["loc"]=='controlloUpload' && $_SESSION["nome"]!=''){
            if (isset($_FILES['audio']) && $_FILES['audio']['error'] == 0) {
                $directory = "./FileCaricati";
            $numerofile=countFilesInDirectory($directory);
            echo $numerofile;
            $nometotale = $directory."/".$_SESSION["nome"].$numerofile.".mp3";
            if (move_uploaded_file($_FILES['audio']['tmp_name'], $nometotale)){
                header("Location:podcastUnivaq.php");
            } else {
                echo "Errore!\n";
            }
            }
            else{
                echo "Errore!\n";
            }
            
        }
        if ($_GET["pag"]=="ric" && $_POST["loc"]==''){
            if($_SESSION["nome"]==''){
                testata();
            }
            if($_SESSION["nome"]!=''){
                testata2();
            }
            echo '<div class="w3-center">';
            echo '<h1>Cerca un caricatore</h1>'."\n";
            echo '<form method="POST" action="podcastUnivaq.php">'."\n";
            echo '<p><input type="text" placeholder="Nome" name="nome" id="nome" required>';
            //sotto cognome
            
            //sotto submit
            echo '<input type="hidden" name="loc" value="ricercaNome">'."\n";
            echo '<p><input type="submit" class="w3-button w3-green w3-round" value="SALVA"></p>'."\n";
            echo "</form>\n";
            echo '</div>';
            
                
            footer();
        }
        if ($_GET["pag"]=="" && $_POST["loc"]=='ricercaNome'){
            if($_SESSION["nome"]==''){
                testata();
            }
            if($_SESSION["nome"]!=''){
                testata2();
            }
            $directory = "./FileCaricati";
            $files = scandir($directory);
            // Filtra solo i file
            foreach ($files as $file) {
                
                // Escludi le directory speciali "." e ".."
                if ($file !== '.' && $file !== '..' && is_file($directory . '/' . $file) && preg_match('/'.$_POST["nome"].'/', $file)) {
                    echo '<div>';
                    // echo '<p>'.$file.'</p>';
                    $nomeUploader= explode(".",$file);
                    echo '<p>'.$nomeUploader[0].'</p>';
                    echo '<audio controls>'."\n";
                    echo '<source src="./FileCaricati/'.$file.'" type="audio/mpeg" >'."\n";
                    echo '</audio>'."\n";
                    echo '</div>';
                }
            }
            footer();
        }
    ?>