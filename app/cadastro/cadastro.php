<?php

require_once('../baseClass.php');

class cadastro extends baseClass {

    public function cadastra_estado($data){

        $sigla = mysqli_real_escape_string($this->conn,$sigla);
        $descricao = mysqli_real_escape_string($this->conn,$descricao);

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

                echo "Estado Cadastrado com Sucesso! <br>";

            }

        }

    }


    public function cadastra_endereco($data){


        $cidade_codigo = mysqli_real_escape_string($this->conn,$data->cidade_id);
        $bairro_codigo = mysqli_real_escape_string($this->conn,$data->bairro_id);
        $bairro_descricao = mysqli_real_escape_string($this->conn,$data->bairro);
        $cep = mysqli_real_escape_string($this->conn,$data->cep);
        $logradouro = mysqli_real_escape_string($this->conn,$data->logradouro);
        $complemento = mysqli_real_escape_string($this->conn,$data->complemento);

        //Verifica se o bairro existe
        $sql = " select count(*) as qtd from bairro where bairro_codigo = '$bairro_codigo'";
        $result = mysqli_query($this->conn,$sql);
        $row = mysqli_fetch_assoc($result);

        //Se bairro já existe
        if ($row['qtd'] > 0) {

            //Insere um novo endereço
            $sql =
            "
            INSERT INTO endereco(
                bairro_codigo,
                endereco_cep,
                endereco_logradouro,
                endereco_complemento
            ) values (
                '$bairro_codigo',
                '$cep',
                '$logradouro',
                '$complemento'
            )";



            $retorno = mysqli_query($this->conn, $sql);

            if(!$retorno) {

                die(mysqli_error($this->conn));

            } else {

                echo "Endereço Cadastrado com Sucesso! <br>";

            }
        
        // Se bairro não existe, cadastra um novo    
        } else {

            //Insere um novo endereço
            $sql =
            "
            INSERT INTO bairro(
                cidade_codigo,
                bairro_descricao
            ) values (
                '$cidade_codigo',
                '$bairro_descricao'
            )";

            $retorno = mysqli_query($this->conn, $sql);

            if(!$retorno) {

                die(mysqli_error($this->conn));

            } else {

            //Insere um novo endereço com o código do bairro cadastrado
            $sql =
            "
            INSERT INTO endereco(
                bairro_codigo,
                endereco_cep,
                endereco_logradouro,
                endereco_complemento
            ) values (
                LAST_INSERT_ID(),
                '$cep',
                '$logradouro',
                '$complemento'
            )";

            $retorno = mysqli_query($this->conn, $sql);

            if(!$retorno) {

                die(mysqli_error($this->conn));

            } else {

                echo "Bairro Cadastrado com sucesso! <br>";
                echo "Endereço Cadastrado com Sucesso! <br>";

            }

            }


        }

    }

}