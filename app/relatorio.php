<?php

require_once('baseClass.php');

class relatorio extends baseClass {

    public function relatorio_endereco(){

        $sql =
        "
        SELECT
        tb1.cidade_descricao as cidade,
        ifnull(tb2.bairro_descricao,'Centro') as bairro,
        ifnull(tb3.endereco_logradouro,'-') as logradouro,
        ifnull(tb3.endereco_cep,tb1.cidade_cep) as cep
        from
        cep.cidade tb1
        left join
        cep.bairro tb2
        on tb1.cidade_codigo = tb2.cidade_codigo
        left JOIN
        cep.endereco tb3
        on tb2.bairro_codigo = tb3.bairro_codigo
        order by
        tb1.cidade_descricao,
        tb2.bairro_descricao,
        tb3.endereco_logradouro
        limit 100
        ";

        $result = mysqli_query($this->conn,$sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Cidade: ".$row["cidade"]."<br>";
            echo "Bairro: ".$row["bairro"]."<br>";
            echo "Logradouro: ".$row["logradouro"]."<br>";
            echo "Cep: ".$row["cep"]."<br>";
            echo "<br><br>";
        }


    }

}