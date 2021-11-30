<!-- 
Tarefas a serem realizadas:

Sobre o ecosistema do PHP:

0- Instalar servidor "xampp" ou similar para poder executar o mysql o apache e o php
1- Existe um arquivo em testePHP\conexao\modeloER com o sql do banco, é necessário rodar ele.

Sobre a pagina web:

2- O campo crm está sendo gravado no campo do telefone.
3- A consulta pelo crm não está funcionando.
4- Quando a consulta não traz nenhum dado a tabela está aparecendo "quebrada".
5- Fazer com que após o cadastro ou alteração o sistema volte para a 1ª aba exibindo os dados atualizado. 
6- Fazer a rotina de exclusão do registro.
7- Colocar uma máscara no campo de telefone que se adeque aos tipos de telefones atuais ex: (81)99874-6354 e (81)3535-0135  
8- Observe que no banco existe uma tabela de "especialidade" é preciso fazer uma ligação com esta tabela e a tabela de médico.
É preciso alterar a aba de cadastro para que a "especialidade" seja listada em input do tipo select e que seja levada em conta
no momento do registrar o médico.
-->
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://www.trinitysolucoes.com.br/wp-content/uploads/2016/12/favicon.png" sizes="32x32" />    
    <title>Teste PHP Trinyti.</title>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="  crossorigin="anonymous"></script>    
    <!-- Principal CSS do Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- Principal JS do Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!-- Alert JS do Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <!-- JS da Aplicacao -->
    <script src="index.js"></script>
        
  </head>

<body >
    <div class="container">
        <br>
        <div class="jumbotron">
            
            <div class="row">
                <div class="text-center col-md-12">
                    <img class="mb-4" src="https://images.vexels.com/media/users/3/144238/isolated/preview/ffb3ffd037d6ce09fb200b81605bd45f-velho-m--dico-personagem-by-vexels.png" alt="" width="72" height="72">
                </div>
            </div>
            <h2 class="text-center">Cadastro de Médico</h2>
            
            <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Médicos Cadastradas</a></li>
                <li><a href="#tab2" data-toggle="tab">Novo Cadastro*</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nome</label>                            
                                <input type="text" name="nomeConsulta" class="form-control" placeholder="Informe o nome" >
                            </div>            
                        </div>  
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>CRM</label>                                
                                <input type="text" name="crmConsulta" class="form-control" placeholder="Informe o CRM" >                                
                            </div>
                        </div>        
                        <div class="col-md-2">
                            <div class="btn-group">
                                <button style="margin-top: 25px;" type="button" class="btn btn-primary btn-block" onclick="listarMedico();">Consultar</button>
                            </div>
                        </div>                              
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div id="divListar">

                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="tab-pane" id="tab2">
                    <div class="row">
                        
                        <div class="col-md-3">
                            &nbsp;
                        </div>

                        <div class="col-md-6">

                            <form class="form-horizontal" id="formCadastro">
                                <br>
                                <input type="hidden" name="id" >



                                <div class="row">                            
                                    <div class="form-group">
                                        <label for="nome" class="control-label col-sm-2" >Nome*</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nome" class="form-control" placeholder="Seu nome" >
                                        </div>
                                    </div>                            
                                </div>

                                <div class="row">                            
                                    <div class="form-group">
                                        <label for="crm" class="control-label col-sm-2" >CRM*</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="crm" class="form-control" placeholder="Seu CRM" >
                                        </div>
                                    </div>                            
                                </div>

                                <div class="row">                            
                                    <div class="form-group">
                                        <label for="crm" class="control-label col-sm-2" >Telefone</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="telefone" class="form-control" placeholder="Seu telefone" >
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">                        
                                            <label>
                                                <button  class="btn btn-primary btn-block" type="button" onclick="salvarMedico();" >Salvar</button>
                                            </label>                        
                                        </div>
                                    </div>
                                </div>



                            </form>
                        </div>

                        <div class="col-md-3">
                            &nbsp;
                        </div>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    <script>
    $(document).ready(function(){        
        listarMedico();
    });
    </script>
        
</body>
</html>
