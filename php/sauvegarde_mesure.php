<html>
    <head>
        <meta charset="UTF-8">
        <title>Capteur temperature</title>
        <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="center">Mesure de temperature à Etang-Sale</h1>


    <div class="flex_temp">
        
        <div>
            <h2 class="center">Graphique de Temperature</h2>
            <img src="graph_temperature.php" id="graph_temp">
        </div>
        <div>
            <h2 class="center">Graphique de Humidité</h2>
            <img src="graph_humidite.php"id="graph_hum">
        </div>

    </div>
    

    <h2 class="center" >Dernière mesure </h2>
    <div class="flex_temp">
        <div class="marg_graph_temp">
            <h3 class="center">Température </h3>
            <div id="con_temperature" ></div>
        </div>
        <div class="marg_graph_hum">
             <h3 class="center">Humidité </h3> 
             <div id="con_humidite" > </div>
        </div>  
    
</div>
    <br><br/>
<?php

ini_set('display_errors', 1);
$user = "capteurdht11";
$password = "irbts12020P4";
$host = "localhost";
$database = "projet_capteur";
$requete_recup = "SELECT temperature, humidite FROM capteur_dht11 ORDER BY id DESC LIMIT 1";

$connection = new mysqli($host, $user, $password, $database);

if($connection->connect_error)
{
    echo "error connection";
}
//echo "connection reussi";


$temperature = @$_GET['temperature'];
$humidite = @$_GET['humidite'];
$requete = "INSERT INTO capteur_dht11(temperature, humidite) VALUE ('$temperature', '$humidite')"; 



$requet_envoie = $connection->query($requete);

$recup = $connection->query($requete_recup);
while($donne=$recup->fetch_assoc()){
   // echo 'temperature = '.$donne['temperature'].' et humidite = '.$donne['humidite'].'<br/>';
    $lastmeasure_temperature = $donne['temperature'];
    $lastmeasure_humidite = $donne['humidite'];
}

$connection->close();




//echo "teste";

?>
<script> var temperature = <?php echo json_encode($lastmeasure_temperature);?>; 
             var humidite = <?php echo json_encode($lastmeasure_humidite);?>;</script>
<script src="./JS/jquery.min.js" type="text/javascript"></script>
<script src="./JS/progressbar.min.js" type="text/javascript"></script>
<script src="./JS/progressbar.js" type="text/javascript"></script>
<script src="script.js" type="text/javascript"></script>

</body>
</html>