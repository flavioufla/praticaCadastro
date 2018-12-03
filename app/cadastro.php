<?php

require_once('baseClass.php');

class cadastro extends baseClass {

    public function cadastra_estado(){

        $data = (object) $_POST;

        $sigla = $data->sigla;
        $descricao = $data->descricao;

        //$sigla = mysqli_real_escape_string($this->conn,$sigla);
       // $descricao = mysqli_real_escape_string($this->conn,$descricao);

        // Verifica se já não existe um estado com a sigla informada
        $sql =
        "
        select
        count(*) as qtd
        from uf
        where uf_sigla = '$sigla'
        ";

        $result = mysqli_query($this->conn,$sql);
        $row = mysqli_fetch_assoc($result);

        // Se não existe, faz um novo cadastro
        if ($row['qtd'] > 0) {
            die('Sigla Já Cadastrada!');
        } else {

            $sql =
            "
            INSERT INTO uf(
            uf_sigla,
            uf_descricao
            ) values (
            '$sigla',
            '$descricao'
            )
            ";

            $retorno = mysqli_query($this->conn, $sql);

            if(!$retorno) {

                die(mysqli_error($this->conn));

            } else {

                die("Registro Inserido com Sucesso!");

            }


        }

    }

}