<?php

require_once('cadastro.php');

// Dados recebidos do cliente
$data = (object) $_REQUEST;

$cadastro = new cadastro();
$cadastro->cadastra_endereco($data);