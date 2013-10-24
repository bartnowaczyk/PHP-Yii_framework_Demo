<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<p  class=wieksze>Witaj na stronie systemu wsparcia gminnych rad konsultacyjnych.</p>

<p class=wieksze>System został stworzony aby ułatwić przeprowadzanie głosowań nad przedstawionymi propozycjami inwestycyjnymi. System pozwala na uniknięcie sytuacji, że ta sama osoba głosuje kilka razy (np. zgłaszając się do różnych punktów głosowania). Pozostałe możliwości systemu:
<ul>
	<li> możliwość samodzielnego tworzenie i edytowania danych rad konsultacyjnych</li>
	<li> możliwość samodzielnego tworzenie i edytowania członków rady</li>
	<li> możliwość samodzielnego tworzenie i edytowania danych komisji (punktów głosowania) </li>
	<li> możliwość samodzielnego tworzenie i edytowania członków komisji</li>
	<li> możliwość prowadzenia kilku głosowań jednocześnie</li>
	<li> możliwość samodzielnego ustalenia jakie dane identyfikują głosującego (PESEL - cały lub część, imię, nazwisko, nr dokumentu)</li>
</ul>
</p>
<?php 
	if(Yii::app()->user->isGuest){
?>

<p class=wieksze>Aby uzyskać
 dostęp do pełnych funkcjonalności systemu należy się zalogować. Jeśli nie masz jeszcze konta w systemie, załóż je, a następnie zaloguj się. </p>
<div class=loginLinkTable>
	<div class=loginLinkRow>
	<?php
		echo "<div class=loginLinkCell>". CHtml::link('Zaloguj', array('site/login'), array('class'=>'loginLink', 'title'=>'')). "</div>";
		echo "<div class=loginLinkCell> </div>";
	
		echo "<div class=loginLinkCell>".CHtml::link('Zarejestruj się', array('user/create'), array('class'=>'loginLink', 'title'=>'')). "</div>";		
	?>
		</div>
</div>
<?
}
else if (Yii::App()->user->getState('rada')==null) {
?>
<?
}
?>
<p class=wieksze>System powstał przy wsparciu Polskiego Górnictwa Naftowego i Gazownictwa. </p>
