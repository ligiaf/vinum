<?php

require_once 'vendor/autoload.php';
include 'conecta.php';

$vinhos = ORM::for_table('regiao')->find_many();

foreach ($vinhos as $vinho) {
	echo $vinho['nome'];
}