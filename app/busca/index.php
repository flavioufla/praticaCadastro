<?php

require_once('busca.php');

$busca = new busca();

// Dados recebidos do cliente
$data = (object) $_REQUEST;

// Método
$action = $data->_action;

$retorno = call_user_func(array($busca, $action),$data);

//Retorno
echo json_encode($retorno);
