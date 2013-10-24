
<?php
$mysqli = new mysqli('localhost', 'bartek', 'haslo', 'radyPGNIG');

$imie = $_GET['imie'];
$nazwisko = $_GET['nazwisko'];
$pesel = $_GET['pesel'];
$dokument = $_GET['dokument'];
$glosowanie = $_GET['glosowanie'];

$imie == "1010010001"? $imie = "gl.`imie` IS NULL AND " : $imie = "gl.`imie` ='" . $imie . "' AND ";

$nazwisko == "1010010001" ?	$nazwisko = "gl.`nazwisko` IS NULL AND " : $nazwisko =  "gl.`nazwisko` ='" . $nazwisko . "' AND ";

$pesel == "1010010001" ? $pesel = "gl.`pesel` IS NULL AND " : $pesel = "gl.`pesel` ='" . $pesel . "' AND ";

$dokument == "1010010001" ? $dokument = "gl.`nrDokumentu` IS NULL AND " : "gl.`nrDokumentu` ='" . $dokument . "' AND ";

$glosowanie = "g.`glosowanieId`=" . $glosowanie;
	$query = "SELECT g.`data` , u.`imie` , u.`nazwisko` , k.`nazwa` FROM `Glos` AS g JOIN `Glosujacy` AS gl ON g.`glosujacyId` = gl.`id` JOIN `User` AS u ON g.`userId` = u.`id` JOIN `Komisja` AS k ON g.`komisjaId` = k.`id` WHERE	 ";
	$query .= $imie . $nazwisko . $pesel . $dokument . $glosowanie;
//echo $query;
	$result = $mysqli->query($query);
  echo json_encode($result->fetch_row());

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
