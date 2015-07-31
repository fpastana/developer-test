<?php

include 'autoload.php';

$consulta = new consultaSintegra();
$html = utf8_encode($consulta->request('http://www.sintegra.es.gov.br/resultado.php', 'POST', 'http://www.sintegra.es.gov.br', $_POST));

echo $consulta->retornaJson($html);