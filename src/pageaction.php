<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=projet', 'root','root');

?>



<?php function latlong ($adresse) {

		$data = Array ();

		$urlWebServiceGoogle = 'http://maps.google.com/maps/api/geocode/json?address=%s&sensor=false&language=fr';
 
		$url = vsprintf($urlWebServiceGoogle, urlencode($adresse));
		$response = json_decode(file_get_contents($url));
       
	
 
		$data[0] =  $response->results[0]->geometry->location->lat;
		$data[1] = $response->results[0]->geometry->location->lng;

return $data;
} 

?>



<?php

 if(isset($_POST['affichersortie']) AND isset( $_POST['nomsortie'] ,$_POST['nb'], $_POST['adresseinv1'] ,$_POST['adresseinv2'], $_POST['adresseinv3'],$_POST['adresseinv4']) ){
   
   	
   		if( !(empty($_POST['nomsortie'])  or  empty($_POST['adresseinv1']) or empty($_POST['nb']) or empty($_POST['adresseinv2'])  or empty($_POST['adresseinv3'])  or empty($_POST['adresseinv4']) ) ) {
      
          $erreur=1 ;
          
               }}
      
  if($erreur==1) { echo "Tous les champs doivent etre compléter !! ";
                 } else {
  



  
   $login= $_SESSION["login"];
   $latilongi = Array();
   $latParis = 48.8566101;
   $longParis = 2.3514992;
   $lieu1=$_POST['lieu1'];
   $lieu2=$_POST['lieu2'];
   $lieu3=$_POST['lieu3'];
   $transport=$_POST['transport'];
   $preference=$_POST['preference'];
   $nb=$_POST['nb'];
   $adresse = array ();
   $latilongi= array ();
   $latadresse=0;
  $longadresse=0;
   
 
  	$req = $bdd->prepare("SELECT adresse FROM Organisateur WHERE login = ?");
               $req->execute(array($login));
               $donnees = $req->fetch();
               $adresseorga=$donnees['adresse'];
 
 		
 
 	// stockage des adresses dans un tableau 
 	
 	
 	$adresse[0]=$adresseorga;
 	
 	
 	
 	for ($i = 1; $i <$nb ; $i++)
{
    $adresse[$i] = $_POST['adresseinv'.$i];
    
}
 	
 	
 
 

	

 	// stockage des longitude et latitude des adresses dans un tableau de tableau 



		$latilongi[0]=latlong($adresse[0]);
		
		if ($nb=1) {
		
  		$latilongi[1]=latlong($adresse[1]);
  		$longadresse=($latilongi[0][1]+$latilongi[1][1])/($nb+1);
  		$latadresse=($latilongi[0][0]+$latilongi[1][0])/($nb+1);
  		
  		
  		}
  		else if ($nb=2) {
  		
  		$latilongi[1]=latlong($adresse[1]);
		$latilongi[2]=latlong($adresse[2]);
		
		 $latadresse=($latilongi[0][0]+$latilongi[1][0]+$latilongi[2][0])/($nb+1);
		$longadresse=($latilongi[0][1]+$latilongi[1][1]+$latilongi[2][1])/($nb+1);
		
		}
		
		else if ($nb=3) {
		$latilongi[1]=latlong($adresse[1]);
		$latilongi[2]=latlong($adresse[2]);
		$latilongi[3]=latlong($adresse[3]);
		
		$latadresse=($latilongi[0][0]+$latilongi[1][0]+$latilongi[2][0]+$latilongi[3][0])/($nb+1);
		$longadresse=($latilongi[0][1]+$latilongi[1][1]+$latilongi[2][1]+$latilongi[3][1])/($nb+1);
		
		}
		
		else if ($nb=4) {
		
		$latilongi[1]=latlong($adresse[1]);
		$latilongi[2]=latlong($adresse[2]);
		$latilongi[3]=latlong($adresse[3]);
		$latilongi[4]=latlong($adresse[4]);	
		
		$longadresse=($latilongi[0][1]+$latilongi[1][1]+$latilongi[2][1]+$latilongi[3][1]+$latilongi[4][1])/($nb+1);
		$longadresse=($latilongi[0][1]+$latilongi[1][1]+$latilongi[2][1]+$latilongi[3][1]+$latilongi[4][1])/($nb+1);
		}
		
		
		
		
	
  


	



 

	// point de rendez vous 

    $latpdr=($latadresse+$latParis)/2;
	$longpdr=($longadresse+$longParis)/2;
	
	// ici => convertir la latitude et longitude du point de rendez vous en adresse pour l'afficher 
	
	$rURL="https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latpdr.",".$longpdr."&key=AIzaSyCH2bCFPzMxHVSoprxR4VmMZRp8flZl_lk";
 	$place = file_get_contents($rURL);
 	$dataresultat0 = json_decode($place);
 	
 	
    
    //
			$adresserendezvous=$dataresultat0->results[0]->formatted_address;
//
     
     $erreur0=$dataresultat0->status;

   	
	
	
	
	
	// recherche du lieu 1 + requete getdetails pour recuperer l'adresse complete
	
	if($lieu1=='food') { 
	
	
	$rURL="https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$latpdr.",".$longpdr."&rankby=distance&type=".$lieu1."&name=".$preference."&key=AIzaSyD8Nuz4nL8A4PCrtMVhrtSCMzhxdCfiFwE"; }
	
	else { $rURL="https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$latpdr.",".$longpdr."&rankby=distance&type=".$lieu1."&name=".$lieu1."&key=AIzaSyD8Nuz4nL8A4PCrtMVhrtSCMzhxdCfiFwE"; }
	
	
 	$place = file_get_contents($rURL);
	$dataresultat1 = json_decode($place);
	
   
  	$lat1=$dataresultat1->results[0]->geometry->location->lat;
 	$long1=$dataresultat1->results[0]->geometry->location->lng;
  	$id1=$dataresultat1->results[0]->place_id;
  	
  	
  
  	//
  	$nomlieu1= $dataresultat1->results[0]->name;
  	
  	
  	//
  
 	
 	
 	
 	// adresse lieu 1
 
 
    		$placeSearchURL="https://maps.googleapis.com/maps/api/place/details/json?placeid=".$id1."&key=AIzaSyD8Nuz4nL8A4PCrtMVhrtSCMzhxdCfiFwE";
          $placeSearchJSON = file_get_contents($placeSearchURL);
          $dataArray1 = json_decode($placeSearchJSON);
          
          
        //  
        $adresselieu1=$dataArray1->result->formatted_address;
        
        //
    
       
       
       
       // DISTANCE ENTRE POINT DE RENDEZ VOUS ET LIEU 1
       
       
       
       
       
    $rURL="https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".$latpdr.",".$longpdr."&destinations=place_id:".$id1."&mode=".$transport."&departureTime=18:00language=fr-FR&key=AIzaSyD8Nuz4nL8A4PCrtMVhrtSCMzhxdCfiFwE";
 		$place = file_get_contents($rURL);

    	$dataresultat3 = json_decode($place);
    
  		$distancepdrlieu1=$dataresultat3->rows[0]->elements[0]->distance->text;
 		$tempspdrlieu1=$dataresultat3->rows[0]->elements[0]->duration->text;
 		
       
       
       
       
       
       
   

   
       
       
           

 
 
 
 
 
 
 // recherche lieu 2 
 
 if ($lieu2=='food') {
 
 
 $rURL="https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$lat1.",".$long1."&rankby=distance&type=".$lieu2."&name=".$preference."&key=AIzaSyD8Nuz4nL8A4PCrtMVhrtSCMzhxdCfiFwE"; }
 else {
 
 $rURL="https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$lat1.",".$long1."&rankby=distance&type=".$lieu2."&name=".$lieu2."&key=AIzaSyD8Nuz4nL8A4PCrtMVhrtSCMzhxdCfiFwE"; }
 
 $place = file_get_contents($rURL);

    $dataresultat2 = json_decode($place);
   
    
  $lat2=$dataresultat2->results[0]->geometry->location->lat;
 $long2=$dataresultat2->results[0]->geometry->location->lng;
 $id2=$dataresultat2->results[0]->place_id;
 
 
 //
 
  $nomlieu2= $dataresultat2->results[0]->name;
 
 //
   $placeSearchURL="https://maps.googleapis.com/maps/api/place/details/json?placeid=".$id2."&key=AIzaSyD8Nuz4nL8A4PCrtMVhrtSCMzhxdCfiFwE";
          $placeSearchJSON = file_get_contents($placeSearchURL);
          $dataArray2 = json_decode($placeSearchJSON);
       
          
          //
           $adresselieu2=$dataArray2->result->formatted_address;
 //
 
 
 
 
 
 
       // DISTANCE ENTRE  LIEU 1 et LIEU 2
       
       
       
       
       
    $rURL="https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=place_id:".$id1."&destinations=place_id:".$id2."&mode=".$transport."&departureTime=19:00language=fr-FR&key=AIzaSyD8Nuz4nL8A4PCrtMVhrtSCMzhxdCfiFwE";
 		$place = file_get_contents($rURL);

    	$dataresultat3 = json_decode($place);
    
  		$distancelieu1lieu2=$dataresultat3->rows[0]->elements[0]->distance->text;
 		$tempslieu1lieu2=$dataresultat3->rows[0]->elements[0]->duration->text;
 		
 
 
 
 
 
 
 
 
 // recherche lieu 3
 if ($lieu3=='food') {
 
 $rURL="https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$lat2.",".$long2."&rankby=distance&type=".$lieu3."&name=".$preference."&key=AIzaSyD8Nuz4nL8A4PCrtMVhrtSCMzhxdCfiFwE";}
 
 else {
 
 $rURL="https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$lat2.",".$long2."&rankby=distance&type=".$lieu3."&name=".$preference."&key=AIzaSyD8Nuz4nL8A4PCrtMVhrtSCMzhxdCfiFwE";
 
 }
 
 
 $place = file_get_contents($rURL);

    $dataresultat3 = json_decode($place);
    
  $lat3=$dataresultat3->results[0]->geometry->location->lat;
 $long3=$dataresultat3->results[0]->geometry->location->lng;
 $id3=$dataresultat3->results[0]->place_id;
 
 
 
 
 
 //
  $nomlieu3= $dataresultat3->results[0]->name;
 //
 
 
 
   $placeSearchURL="https://maps.googleapis.com/maps/api/place/details/json?placeid=".$id3."&key=AIzaSyD8Nuz4nL8A4PCrtMVhrtSCMzhxdCfiFwE";
          $placeSearchJSON = file_get_contents($placeSearchURL);
          $dataArray3 = json_decode($placeSearchJSON);
        
          
           //
           $adresselieu3=$dataArray3->result->formatted_address;
 //
 
          
          
          
          
          
           // DISTANCE ENTRE  LIEU 2 et LIEU 3
       
       
       
       
       
    $rURL="https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=place_id:".$id2."&destinations=place_id:".$id3."&mode=".$transport."&departureTime=19:00language=fr-FR&key=AIzaSyD8Nuz4nL8A4PCrtMVhrtSCMzhxdCfiFwE";
 		$place = file_get_contents($rURL);

    	$dataresultat3 = json_decode($place);
    
  		$distancelieu2lieu3=$dataresultat3->rows[0]->elements[0]->distance->text;
 		$tempslieu2lieu3=$dataresultat3->rows[0]->elements[0]->duration->text;
 		
          
          
          
          
          
          
          
        










}
?>






<!DOCTYPE html>
<html>




<head>
<meta charset="UTF-8">

 <link rel="stylesheet" href="style.css" />

<title>Ma sortie</title>
</head>
<body>
<video  playsinline autoplay muted loop>


<source src="projet.mp4" type="video/mp4">
</video>

<div id="logosuggestion">

<img src="logo.png" width="300" height="300">

</div>




<div id="suggestionsortie">
				
				
					<h4>Dys&Friends Planning :
						<br><br>
				  
						<p> Votre adresse de rendez-vous à tous est : <br> <?php echo $adresserendezvous; ?> </p>
						
						<br>
						<hr>
						<br>
						<p> Il y a une distance de <?php echo $distancepdrlieu1 ?> entre votre adresse de rendez vous et le lieu de sortie 1 en <?php echo $transport ?>  ainsi qu'une durée de <?php echo $tempspdrlieu1 ?>   </p></br>
						<br>
						
						<hr>
						<p> Votre premier lieu de sortie est : <?php echo $nomlieu1; ?> </p></br>
                        <p> Adresse : <?php echo $adresselieu1; ?>
						<br><br>
						<hr>
						<br>
						<p> Il y a une distance de <?php echo $distancelieu1lieu2 ?> entre le lieu de sortie 1 et le lieu de sortie 2 en <?php echo $transport ?>  ainsi qu'une durée de <?php echo $tempslieu1lieu2 ?>   </p></br>
						<br><br>
						
						<hr>
						<br>
						<p> Votre deuxième lieu de sortie </br>est : <?php echo $nomlieu2; ?> </p> </br>
                        <p> Adresse : <?php echo $adresselieu2; ?>
                        
                        <br><br>
                        <hr>
                        <br>
                        <p> Il y a une distance de <?php echo $distancelieu2lieu3 ?> entre le lieu de sortie 2 et le lieu de sortie 3 en <?php echo $transport ?>  ainsi qu'une durée de <?php echo $tempslieu2lieu3 ?>   </p></br>
                        <hr>
						
						<br>
						<p> Votre troisième lieu de sortie </br> est : <?php echo $nomlieu3; ?> </p> </br>
                        <p> Adresse : <?php echo $adresselieu3; ?>
						
						
						<br><br>
						<hr>
						<br>
						Dys&Friends vous sélectionne les meilleurs endroits pour répondre au mieux à vos exigences ainsi qu'à celles de vos amis.</br>
						Toute l'équipe de Dys&Friends vous souhaite une excellente soirée !
					</h4>
					<br><br>
					
					<a href="pagesommaire.php"> Retour à ma page d'accueil </a> 
					
					
				</div>
				
				
				
				
				<br/>














</body>
</html>



  