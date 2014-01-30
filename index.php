<html>
<head><title>Recherche de Liens</title></head>
<body>

<?php
	ini_set('user_agent', 'Mozilla/5.0 Gecko/20100214 Firefox/3.5.8');
	//ini_set("display_errors",0);
	//error_reporting(0);
    include('Main.class.php');
    include('Main2.class.php');
    include('Toolpage.class.php');
?>

<h1>Entrez un mot clef</h1>

<form name="recherche" method="post" action="index.php">

Mot Clef : 	<input type="text" name="nom" value="Table"/> <br/>
Version  : 	<input type="checkbox" name="checkbox1" value="1"/> 1
			<input type="checkbox" name="checkbox2" value="2"/> 2
			<input type="checkbox" name="checkbox3" value="3"/> 3
 			<input type="submit" name="valider" value="OK"/>
 			
</form>

<?php
	if ( isset( $_POST['valider'] ) ) { 
	
   			if ($_POST['checkbox1'] == 1) {
				$main = new Main( $_POST['nom'] );
				echo "<br/>";
				$main->printLinkedWords();
				echo "<br/>";
   			}
   			if ($_POST['checkbox2'] == 2) {
				$main2 = new Main2( $_POST['nom'] );
				echo "<br/>";
				$main2->printLinkedWords();
				echo "<br/>";
   			}
   			if ($_POST['checkbox3'] == 3) {
				echo "<br/>";
				echo "<br/>";
   			}
   	}
?>

</body>
</html>
