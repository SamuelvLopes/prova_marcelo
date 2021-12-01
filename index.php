<!-- 
Tarefas a serem realizadas:

Sobre o ecosistema do PHP:

0- Instalar servidor "xampp" ou similar para poder executar o mysql o apache e o php -ok!
1- Existe um arquivo em testePHP\conexao\modeloER com o sql do banco, é necessário rodar ele.-ok!

Sobre a pagina web:

2- O campo crm está sendo gravado no campo do telefone. -ok!
3- A consulta pelo crm não está funcionando.-ok!
4- Quando a consulta não traz nenhum dado a tabela está aparecendo "quebrada". -??
5- Fazer com que após o cadastro ou alteração o sistema volte para a 1ª aba exibindo os dados atualizado.  -ok
6- Fazer a rotina de exclusão do registro. -ok
7- Colocar uma máscara no campo de telefone que se adeque aos tipos de telefones atuais ex: (81)99874-6354 e (81)3535-0135  -ok
8- Observe que no banco existe uma tabela de "id_especialidade" é preciso fazer uma ligação com esta tabela e a tabela de médico. -ok
É preciso alterar a aba de cadastro para que a "id_especialidade" seja listada em input do tipo select e que seja levada em conta
no momento do registrar o médico. -OK
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
    <!-- Jquery -->
    <script type="text/javascript" src="jquery.maskedinput-1.1.4.pack.js"></script>
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
                <li class="active"><a href="#tab1" id='medicos-cadastrados' data-toggle="tab">Médicos Cadastrados</a></li>
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
                                            <input type="text" name="nome" class="form-control" placeholder="Seu nome" required>
                                        </div>
                                    </div>                            
                                </div>

                                <div class="row">                            
                                    <div class="form-group">
                                        <label for="crm" class="control-label col-sm-2" >CRM*</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="crm" class="form-control" placeholder="Seu CRM" required>
                                        </div>
                                    </div>                            
                                </div>

                                <div class="row">                            
                                    <div class="form-group">
                                        <label for="crm" class="control-label col-sm-2" >Telefone</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="telefone" id='telefone'onkeydown="javascript: fMasc( this, mTel );"  maxlength="14" class="form-control" placeholder="Seu telefone" >
                                        </div>
                                    </div>
                                </div>
                                 <div class="row">                            
                                    <div class="form-group">
                                        <label for="crm" class="control-label col-sm-2" >Especialidades*</label>
                                        <div class="col-sm-10">
                                           <select class="form-control" name="id_especialidade" id="id_especialidade">
                             <!--opções das especialidades-->
                                <option value="0">Não possui especialidades!</option><option value="66">ACUPUNTURA</option><option value="97">ADMINISTRAÇÃO EM SAÚDE</option><option value="1">ADMINISTRAÇÃO HOSPITALAR</option><option value="2">ALERGIA E IMUNOLOGIA</option><option value="98">ALERGIA E IMUNOPATOLOGIA</option><option value="84">ANATOMIA PATOLÓGICA</option><option value="3">ANESTESIOLOGIA</option><option value="4">ANGIOLOGIA</option><option value="67">ANGIOLOGIA E CIRURGIA VASCULAR</option><option value="5">BRONCOESOFAGOLOGIA</option><option value="6">CANCEROLOGIA</option><option value="80">CANCEROLOGIA/CANCEROLOGIA CIRÚRGICA</option><option value="81">CANCEROLOGIA/CANCEROLOGIA PEDIÁTRICA</option><option value="7">CARDIOLOGIA</option><option value="8">CIRURGIA CARDIOVASCULAR</option><option value="10">CIRURGIA DA MÃO</option><option value="9">CIRURGIA DE CABEÇA E PESCOÇO</option><option value="99">CIRURGIA DIGESTIVA</option><option value="11">CIRURGIA DO APARELHO DIGESTIVO</option><option value="85">CIRURGIA DO TRAUMA</option><option value="86">CIRURGIA GASTROENTEROLÓGICA</option><option value="12">CIRURGIA GERAL</option><option value="87">CIRURGIA ONCOLÓGICA</option><option value="13">CIRURGIA PEDIÁTRICA</option><option value="14">CIRURGIA PLÁSTICA</option><option value="15">CIRURGIA TORÁCICA</option><option value="110">CIRURGIA TORÁXICA</option><option value="16">CIRURGIA VASCULAR</option><option value="88">CIRURGIA VASCULAR PERIFÉRICA</option><option value="17">CITOPATOLOGIA</option><option value="68">CLÍNICA MÉDICA</option><option value="69">COLOPROCTOLOGIA</option><option value="260">DENSITOMETRIA ÓSSEA</option><option value="18">DERMATOLOGIA</option><option value="83">DIAGNÓSTICO POR IMAGEM</option><option value="89">DOENÇAS INFECCIOSAS E PARASITÁRIAS</option><option value="19">ELETROENCEFALOGRAFIA</option><option value="70">ENDOCRINOLOGIA</option><option value="20">ENDOCRINOLOGIA E METABOLOGIA</option><option value="82">ENDOSCOPIA</option><option value="21">ENDOSCOPIA DIGESTIVA</option><option value="109">ENDOSCOPIA PERORAL</option><option value="101">ENDOSCOPIA PERORAL VIAS AÉREAS</option><option value="22">FISIATRIA</option><option value="23">FONIATRIA</option><option value="24">GASTROENTEROLOGIA</option><option value="25">GENÉTICA CLÍNICA</option><option value="108">GENÉTICA LABORATORIAL</option><option value="71">GENÉTICA MÉDICA</option><option value="26">GERIATRIA</option><option value="90">GERIATRIA E GERONTOLOGIA</option><option value="27">GINECOLOGIA</option><option value="72">GINECOLOGIA E OBSTETRÍCIA</option><option value="28">HANSENOLOGIA</option><option value="29">HEMATOLOGIA</option><option value="73">HEMATOLOGIA E HEMOTERAPIA</option><option value="30">HEMOTERAPIA</option><option value="102">HEPATOLOGIA</option><option value="31">HOMEOPATIA</option><option value="91">IMUNOLOGIA CLÍNICA</option><option value="32">INFECTOLOGIA</option><option value="92">INFORMÁTICA MÉDICA</option><option value="33">MASTOLOGIA</option><option value="261">MEDICINA DE EMERGÊNCIA</option><option value="74">MEDICINA DE FAMÍLIA E COMUNIDADE</option><option value="35">MEDICINA DE TRÁFEGO</option><option value="93">MEDICINA DO ADOLESCENTE</option><option value="103">MEDICINA DO ESPORTE</option><option value="34">MEDICINA DO TRABALHO</option><option value="36">MEDICINA ESPORTIVA</option><option value="75">MEDICINA FÍSICA E REABILITAÇÃO</option><option value="37">MEDICINA GERAL COMUNITÁRIA</option><option value="38">MEDICINA INTENSIVA</option><option value="39">MEDICINA INTERNA OU CLÍNICA MÉDICA</option><option value="40">MEDICINA LEGAL</option><option value="259">MEDICINA LEGAL E PERÍCIA MÉDICA</option><option value="41">MEDICINA NUCLEAR</option><option value="76">MEDICINA PREVENTIVA E SOCIAL</option><option value="42">MEDICINA SANITÁRIA</option><option value="43">NEFROLOGIA</option><option value="44">NEUROCIRURGIA</option><option value="45">NEUROFISIOLOGIA CLÍNICA</option><option value="46">NEUROLOGIA</option><option value="47">NEUROLOGIA PEDIÁTRICA</option><option value="94">NEUROPEDIATRIA</option><option value="104">NUTRIÇÃO PARENTERAL E ENTERAL</option><option value="48">NUTROLOGIA</option><option value="49">OBSTETRÍCIA</option><option value="50">OFTALMOLOGIA</option><option value="95">ONCOLOGIA</option><option value="79">ONCOLOGIA CLÍNICA</option><option value="51">ORTOPEDIA E TRAUMATOLOGIA</option><option value="52">OTORRINOLARINGOLOGIA</option><option value="53">PATOLOGIA</option><option value="54">PATOLOGIA CLÍNICA</option><option value="77">PATOLOGIA CLÍNICA/MEDICINA LABORATORIAL</option><option value="55">PEDIATRIA</option><option value="56">PNEUMOLOGIA</option><option value="105">PNEUMOLOGIA E TISIOLOGIA</option><option value="57">PROCTOLOGIA</option><option value="58">PSIQUIATRIA</option><option value="96">PSIQUIATRIA INFANTIL</option><option value="106">RADIODIAGNÓSTICO</option><option value="59">RADIOLOGIA</option><option value="78">RADIOLOGIA E DIAGNÓSTICO POR IMAGEM</option><option value="60">RADIOTERAPIA</option><option value="61">REUMATOLOGIA</option><option value="62">SEXOLOGIA</option><option value="63">TERAPIA INTENSIVA</option><option value="257">TERAPIA INTENSIVA PEDIÁTRICA</option><option value="64">TISIOLOGIA</option><option value="258">TOCO-GINECOLOGIA</option><option value="107">ULTRASSONOGRAFIA</option><option value="256">ULTRASSONOGRAFIA EM GINECOLOGIA E OBSTETRÍCIA</option><option value="255">ULTRASSONOGRAFIA GERAL</option><option value="65">UROLOGIA</option></select>
                                        </div>
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
