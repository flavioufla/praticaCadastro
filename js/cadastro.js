
// Autocomplete com jquery-ui
$( function() {

    $("#cep").autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: "app/busca/",
          dataType: "json",
          data: {
            _action: 'get_endereco', // Método
            cep: request.term // Parâmetro
          },
          success: function( data ) {
            response( data );
          }
        } );
      },
      minLength: 2,
      select: function( event, ui ) {
       $("#endereco_id").val(ui.item.endereco_codigo);
       $("#bairro_id").val(ui.item.bairro_codigo);
       $("#uf").val(ui.item.uf);
       $("#cidade").val(ui.item.cidade);
       $("#bairro").val(ui.item.bairro);
       $("#logradouro").val(ui.item.logradouro);
       $("#complemento").val(ui.item.complemento);
      }
    });

    $("#cidade").autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: "app/busca/",
          dataType: "json",
          data: {
            _action: 'get_cidade',
            descricao: request.term // Parâmetro enviado ao método
          },
          success: function( data ) {
            response( data );
          }
        } );
      },
      minLength: 4,
      select: function( event, ui ) {
        $("#endereco_id").val(ui.item.endereco_codigo);
        $("#bairro_id").val(ui.item.bairro_codigo);
        $("#uf").val(ui.item.uf);
        $("#cep").val(ui.item.cep);
        $("#cidade").val(ui.item.cidade);
        $("#bairro").val(ui.item.bairro);
        $("#logradouro").val(ui.item.logradouro);
        $("#complemento").val(ui.item.complemento);
      }
    });


    $("#bairro").autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: "app/busca/",
          dataType: "json",
          data: {
            _action: 'get_bairro',
            descricao: request.term,
            cidade_codigo: $("#cidade_id").val()
          },
          success: function( data ) {
            response( data );
          }
        } );
      },
      minLength: 0,
      select: function( event, ui ) {
        // Alimenta os campos a partir do retorno do método remoto
        //$("#uf").val(ui.item.uf);
        //$("#cidade_id").val(ui.item.cidade_codigo);
        //$("#uf_id").val(ui.item.uf_codigo);
      }
    });



});