<?php

require_once('../baseClass.php');

class busca extends baseClass {

    public function get_endereco($data){

        $cep = mysqli_real_escape_string($this->conn,$data->cep);

        $sql =
        "
         SELECT
        concat('Cep: ', ifnull(tb3.endereco_cep,tb1.cidade_cep) ,' | ', tb1.cidade_descricao,' (',tb_uf.uf_sigla, ') | Bairro: ', ifnull(tb2.bairro_descricao,''), ' | Logradouro: ', ifnull(tb3.endereco_logradouro,''), ' | Complemento: ', ifnull(tb3.endereco_complemento,'')) as label,
        tb1.cidade_descricao as cidade,
        ifnull(tb2.bairro_descricao,'') as bairro,
        ifnull(tb3.endereco_logradouro,'') as logradouro,
        ifnull(tb3.endereco_complemento,'') as complemento,
        tb_uf.uf_sigla as uf,
        tb1.cidade_descricao as cidade,
        tb2.bairro_descricao as bairro,
        tb3.endereco_logradouro as logradouro,
        tb3.endereco_complemento as complemento,
        tb3.endereco_codigo,
        tb2.bairro_codigo,
        tb1.cidade_codigo,
        ifnull(tb3.endereco_cep,tb1.cidade_cep) as value
        from
        cep.cidade tb1
        JOIN
        cep.uf tb_uf
        on tb1.uf_codigo = tb_uf.uf_codigo
        left join
        cep.bairro tb2
        on tb1.cidade_codigo = tb2.cidade_codigo
        left JOIN
        cep.endereco tb3
        on tb2.bairro_codigo = tb3.bairro_codigo
        where ifnull(tb3.endereco_cep,tb1.cidade_cep) like '$cep%'
        order by
        tb1.cidade_descricao,
        tb2.bairro_descricao,
        tb3.endereco_logradouro
        limit 10";

        $result = mysqli_query($this->conn,$sql);

        $rows = array();
        while ($row = mysqli_fetch_object($result)) {
            $rows[] = $row;
        }

        return $rows;
        

    }

    public function get_cidade($data){

        $descricao = mysqli_real_escape_string($this->conn,$data->descricao);

        $sql =
        "
        SELECT
        concat('Cep: ', ifnull(tb3.endereco_cep,tb1.cidade_cep) ,' | ', tb1.cidade_descricao,' (',tb_uf.uf_sigla, ') | Bairro: ', ifnull(tb2.bairro_descricao,''), ' | Logradouro: ', ifnull(tb3.endereco_logradouro,''), ' | Complemento: ', ifnull(tb3.endereco_complemento,'')) as label,
        tb1.cidade_descricao as cidade,
        ifnull(tb2.bairro_descricao,'') as bairro,
        ifnull(tb3.endereco_logradouro,'') as logradouro,
        ifnull(tb3.endereco_complemento,'') as complemento,
        tb_uf.uf_sigla as uf,
        tb1.cidade_descricao as cidade,
        tb2.bairro_descricao as bairro,
        tb3.endereco_logradouro as logradouro,
        tb3.endereco_complemento as complemento,
        tb3.endereco_codigo,
        tb2.bairro_codigo,
        tb1.cidade_codigo,
        ifnull(tb3.endereco_cep,tb1.cidade_cep) as cep,
        tb1.cidade_descricao as value
        from
        cep.cidade tb1
        JOIN
        cep.uf tb_uf
        on tb1.uf_codigo = tb_uf.uf_codigo
        left join
        cep.bairro tb2
        on tb1.cidade_codigo = tb2.cidade_codigo
        left JOIN
        cep.endereco tb3
        on tb2.bairro_codigo = tb3.bairro_codigo
        where tb1.cidade_descricao like '$descricao%'
        order by
        tb1.cidade_descricao,
        tb2.bairro_descricao,
        tb3.endereco_logradouro
        limit 20";

        $result = mysqli_query($this->conn,$sql);

        $rows = array();
        while ($row = mysqli_fetch_object($result)) {
            $rows[] = $row;
        }

        return $rows;
        

    }

    public function get_bairro($data){

        $descricao = mysqli_real_escape_string($this->conn,$data->descricao);
        $cidade_codigo = mysqli_real_escape_string($this->conn,$data->cidade_codigo);

        $sql =
        "
        select
        bairro_codigo,
        bairro_descricao as value
        from cep.bairro
        where cidade_codigo = '$cidade_codigo'
        and bairro_descricao like '%$descricao%'
        order by bairro_descricao
        ";

        $result = mysqli_query($this->conn,$sql);

        $rows = array();
        while ($row = mysqli_fetch_object($result)) {
            $rows[] = $row;
        }

        return $rows;

    }

}