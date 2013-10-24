<?php
/*
header('content-type: text/json');
//initialize our PDO class. You will need to replace your database credentials respectively
if(!isset($_POST['username']))
	echo "bleee";
    exit;

$db = new PDO('mysql:host=localhost;dbname=radyPGNIG','bartek','haslo',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));


//prepare our query.
$query = $db->prepare('SELECT * FROM Rada WHERE gmina = :name');
//let PDO bind the username into the query, and prevent any SQL injection attempts.
$query->bindParam(':name', $_POST['username']);
//execute the query
$query->execute();

//return the json object containing the result of if the username exists or not. The $.post in our jquery will access it.
echo json_encode(array('exists' => $query->rowCount() > 0));

/*
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$pesel = $_POST['pesel'];
$dokument = $_POST['dokument'];
$glosowanie = $_POST['glosowanie'];
$imie == "1010010001"? $imie = "gl.`imie` IS NULL AND " : $imie = "gl.`imie` ='" . $imie . "' AND ";
$nazwisko == "1010010001" ?	$nazwisko = "gl.`nazwisko` IS NULL AND " : $nazwisko =  "gl.`nazwisko` ='" . $nazwisko . "' AND ";
$pesel == "1010010001" ? $pesel = "gl.`pesel` IS NULL AND " : $pesel = "gl.`pesel` ='" . $pesel . "' AND ";
$dokument == "1010010001" ? $dokument = "gl.`nrDokumentu` IS NULL AND " : "gl.`nrDokumentu` ='" . $dokument . "' AND ";
$glosowanie = "g.`glosowanieId`=" . $glosowanie;

	$query = "SELECT g.`data` , u.`imie` , u.`nazwisko` , k.`nazwa` FROM `Glos` AS g JOIN `Glosujacy` AS gl ON g.`glosujacyId` = gl.`id` JOIN `User` AS u ON g.`userId` = u.`id` JOIN `Komisja` AS k ON g.`komisjaId` = k.`id` WHERE	 ";
	$query .= $imie . $nazwisko . $pesel . $dokument . $glosowanie;

* 
* `

/*	if ($result->num_rows>0) {
		echo "Osoba o podanych danych głosowała już w tym głosowaniu!";
		while ($row = $result->fetch_row()) {
			printf ("Data głosowania: %s, Komisja: (%s), Osoba przyjmująca głos: %s %s\n", $row[0], $row[3], $row[1], $row[2]);
		}
	}
	else {
		echo "Osoba o podanych danych jeszcze nie głosowała w tym głosowaniu!";
		
		}
*/
//	$mysqli->close();

?>
