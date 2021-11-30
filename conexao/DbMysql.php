<?php  
    
class DbMysql implements InterfaceDatabase{
    private $hdlCon   = null;
    private $hdlDb    = null;
    protected $strHost  = "localhost";
    protected $strUser  = "root";
    protected $strPass  = "";       
    protected $strBanco = "testephp";
    public function __construct() {
        $this->hdlCon = mysqli_connect($this->strHost, $this->strUser, $this->strPass, $this->strBanco);
        mysqli_set_charset($this->hdlCon, 'utf8');            
        if($this->hdlCon){
            $this->hdlDb = mysqli_select_db($this->hdlCon, $this->strBanco);
            if(!$this->hdlDb){                        
                throw new Exception(mysqli_error());
            }else{
                return true;
            }
        }else{
            throw new Exception(mysqli_error());
        }
    }        
    public function select($strSQL){
        $hdlResult = mysqli_query($this->hdlCon, $strSQL);
        if($hdlResult){
            $intNumeroLinhas = mysqli_num_rows($hdlResult);
            $arrStrLinhas    = null;
            if($intNumeroLinhas > 0){
                $intI = 0;
                while($arrStrRes = mysqli_fetch_assoc($hdlResult)){
                    $arrStrLinhas[$intI] = $arrStrRes;
                    $intI++;
                }
            }
            return $arrStrLinhas;
        }else{
            if($this->debug == "T"){
                $msgmErro = "ERRO:<br> CÓD.: ".  mysqli_errno()." <br><br> MEN.: ".mysqli_error()." <br><br> SQL executada: ".$strSQL;
            }else{
                $msgmErro = "ERRO: ".$this->menssagensErroNumero(mysqli_errno(), mysqli_error());
            }
            throw new Exception($msgmErro);
        }
    }

    public function executar($strSQL){
        if(!mysqli_query($this->hdlCon, $strSQL)){
            if($this->debug == "T"){
                $msgmErro = "ERRO:<br> CÓD.: ".  mysqli_errno()." <br><br> MEN.: ".mysqli_error()." <br><br> SQL executada: ".$strSQL;
            }else{
                $msgmErro = "ERRO: ".$this->menssagensErroNumero(mysqli_errno(), mysqli_error());
            }
            throw new Exception($msgmErro);
        }
        return true;
    }

    public function getLastId(){
        $intId = mysqli_insert_id();
        if ($intId == 0){
            if($this->debug == "T"){
                $msgmErro = "ERRO:<br> CÓD.: ".  mysqli_errno()." <br><br> MEN.: ".mysqli_error()." <br><br> SQL executada: mysql_insert_id()";
            }else{
                $msgmErro = "ERRO: ".$this->menssagensErroNumero(mysqli_errno(), mysqli_error());
            }
            throw new Exception($msgmErro);
        }
        return $intId;
    }

    private function menssagensErroNumero($mysqlErroNumero, $mysqlErro){
        $txt = "";
        switch ($mysqlErroNumero) {
            case 1451:
                $txt = " O ítem não pode ser excluído.<br>".$mysqlErro."<br>Está sendo utilizado em um relação de dados.";
                break;
            case 1064:
                $txt = " Sintaxe SQL. <br>".$mysqlErro."<br>Contate o administrador do sistema.";
                break;
            case 1146:
                $txt = " <p> Tabela não encontrada: <br>".$mysqlErro." <p> ";
                break;
            default:
                $txt = " Não identificado,<br>".$mysqlErro."<br>Contate o administrador do sistema.";
                break;
        }
        return $txt;
    }

    public function getHost(){
        return $this->strHost;
    }
    public function getUser(){
        return $this->strUser;
    }
    public function getPass(){
        return $this->strPass;
    }
    public function getBanco(){
        return $this->strBanco;
    }
    public function inciaTransacao(){
        mysql_query("BEGIN");
    }
    public function confirmaTransacao(){
        mysql_query("COMMIT");
    }
    public function cancelaTransacao(){
        mysql_query("ROLLBACK");
    }        
    public function getDebug(){
        return $this->debug;
    }        
}
?>
