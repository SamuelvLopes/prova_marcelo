function salvarMedico(){
    var id  = $("input[name='id']").val();
    var nome  = $("input[name='nome']").val();
    var crm  = $("input[name='crm']").val();
    var telefone  = $("input[name='telefone']").val();

    if(!nome){
        bootbox.alert({                        
            message: '<div class="alert alert-danger"><strong>Falta o nome!</strong></div>',
            title: "Atenção"    
        });
        return false;
    }
    if(!crm){
        bootbox.alert({                        
            message: '<div class="alert alert-danger"><strong>Falta o crm!</strong></div>',
            title: "Atenção"    
        });                
        return false;
    }
    var acao='Salvar';
    if(id>0){
        acao='Alterar';
    }

    $.ajax({
        type: 'POST',
        url: "controladores/IndexControlador.php",
        data: {ACO_Descricao: acao, id: id, nome: nome, crm: crm, telefone: telefone},
        dataType: 'json',
        async: false, // assincrono / nÃ£o assincrono
        encode: true,

        beforeSend: function() { },
        success: function(data) {
            if (data.statusOp == 'excecao') {
                bootbox.alert({                        
                    message: '<div class="alert alert-danger"><strong>'+data.msgOp+'</strong></div>',
                    title: "Exceção!"    
                });                        
            }else{
                bootbox.alert({                            
                    message: '<div class="alert alert-success"><strong>'+data.msgOp+'</strong></div>',
                    title: "Sucesso!"    
                });                        
                $("#formCadastro")[0].reset();
            }
        },
        error: function(xhr) {                    
            bootbox.alert({                        
                message: '<div class="alert alert-danger"><strong>'+xhr.statusText + xhr.responseText+'</strong></div>',
                title: "Erro"    
            });                    
        },
        complete: function() { }
    }).done(function(){ });
}




function listarMedico(){        
    var nome  = $("input[name='nomeConsulta']").val();
    var crm  = $("input[name='crm']").val();
    $.ajax({
        type: 'POST',
        url: "controladores/IndexControlador.php",
        data: {ACO_Descricao: 'Listar', nome: nome, crm: crm},
        dataType: 'json',
        async: false, // assincrono / nÃ£o assincrono
        encode: true,

        beforeSend: function() { },
        success: function(data) {                
            if (data.statusOp == 'excecao') {
                bootbox.alert({                        
                    message: '<div class="alert alert-danger"><strong>'+data.msgOp+'</strong></div>',
                    title: "Exceção!"    
                });                        
            }else{
                $("#divListar").html(data.html);                    
            }
        },
        error: function(xhr) {                    
            bootbox.alert({                        
                message: '<div class="alert alert-danger"><strong>'+xhr.statusText + xhr.responseText+'</strong></div>',
                title: "Erro"    
            });                    
        },
        complete: function() { }
    }).done(function(){ });
}

function editar(idMedico){        
    $.ajax({
        type: 'POST',
        url: "controladores/IndexControlador.php",
        data: {ACO_Descricao: 'Consultar', id: idMedico},
        dataType: 'json',
        async: false, // assincrono / nÃ£o assincrono
        encode: true,
        beforeSend: function() { },
        success: function(data) {                
            if (data.statusOp == 'excecao') {
                bootbox.alert({                        
                    message: '<div class="alert alert-danger"><strong>'+data.msgOp+'</strong></div>',
                    title: "Exceção!"    
                });                        
            }else{                    
                preencherDadosTelaAlteracao(data.obj);
            }
        },
        error: function(xhr) {                    
            bootbox.alert({                        
                message: '<div class="alert alert-danger"><strong>'+xhr.statusText + xhr.responseText+'</strong></div>',
                title: "Erro"    
            });                    
        },
        complete: function() { }
    }).done(function(){ });
}

function excluir(idMedico){

}

function preencherDadosTelaAlteracao(objEntrada){
    var obj = JSON.parse(objEntrada);        
    $("input[name='id']").val(obj.id);
    $("input[name='nome']").val(obj.nome);
    $("input[name='crm']").val(obj.crm);
    $("input[name='telefone']").val(obj.telefone);
    $('#myTab a[href="#tab2"]').tab('show');
}

function cancelar(){
    $("input[name='id']").val("");
    $("input[name='nome']").val("");
    $("input[name='crm']").val("");
    $("input[name='telefone']").val("");
    $('#myTab a[href="#tab1"]').tab('show');
}
    