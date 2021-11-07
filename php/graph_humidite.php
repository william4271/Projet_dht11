<?php

/*
Ce fichier de travail en l'état fonctionne bien. (avec la bdd qui va bien évidemment)
fichier mis sur la racine du site.

Il suffit de mettre un fichier de config ailleurs, exemple pour moi ./protegepw/config.loc.php
et ca ne fonctionne plus :
a) sans utiliser le fichier de confiquration
b) en l'utilisant (avec les midifications qui en découlent sur @mysql_connect, @mysql_select_db)

Fichier de config non fourni ici qui donne :
$host = '127.0.0.1'; 
$user = 'root'; 
$pass = '';  
$bdd = 'bdd'; 

*/

// require_once "./protegepw/config.loc.php";  // fichier non fourni pour l'exemple
ini_set('display_errors', 1);
require_once("src/jpgraph.php");
require_once("src/jpgraph_line.php");  // = courbe
require_once("src/jpgraph_date.php");

$host = 'localhost';
$user = 'capteurdht11';
$password = 'irbts12020P4';
$database = 'projet_capteur'; // la base de données 
$table = "capteur_dht11";             // nom de la table
$graphique_largeur 	= 500;
$graphique_hauteur 	= 250;
$graphique_titre   	             = 'Etang-Sale - Humidité (%)';
$sql_table   		= 'capteur_dht11';
$sql_champx  		= 'date';
$sql_champy  		= 'humidite';
$nbmesure = "240";


// **********************************************
// Extraction des données dans la base de données
// *************************************************

// on crée la requête SQL 


$mysqlCnx = new mysqli($host, $user, $password, $database);



	$sql = "SELECT ".$sql_champx.",".$sql_champy." FROM ".$sql_table." WHERE ".$sql_champx." BETWEEN '".date("Y-m-d H:i:s",time()-3600*24)."' AND '".date("Y-m-d H:i:s")."' ORDER BY ".$sql_champx ." DESC LIMIT " . $nbmesure;
	$req = $mysqlCnx->query($sql);
	while($res = $req->fetch_assoc())
	{
		$datax[] = strtotime($res[$sql_champx]);
		$datay[] = $res[$sql_champy];
	}	
	
 
	$graphique = new Graph($graphique_largeur,$graphique_hauteur);
	$graphique->SetMargin(30,30,50,50);
	$graphique->SetMarginColor("lightblue@0.7");
	$graphique->title->Set($graphique_titre);
	$graphique->subtitle->Set(date("d/m/Y",time()-3600*24)." - ".date("d/m/Y"));
	$graphique->SetScale("datlin");
	$graphique->xaxis->SetLabelAngle(90);
	$graphique->xgrid->Show();
	$courbe = new LinePlot($datay,$datax);
    $courbe->SetColor("#aaaaaa");
    $courbe->mark->SetType(MARK_FILLEDCIRCLE,'',1.0);
	$courbe->mark->SetFillColor("#aaaaaa");
	$courbe->mark->SetWidth(3);
	$graphique->Add($courbe);
	$graphique->Stroke();
?>