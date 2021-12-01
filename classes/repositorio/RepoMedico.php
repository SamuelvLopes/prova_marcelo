<?php

class RepoMedico {
    private $db;

    public function __construct(){
        $this->db = Db::getInstance();
    }

    public function listar($dadosConsulta){
        $sql =" SELECT * FROM medico ";
        $sql.=" WHERE ";
        $sql.=" id IS NOT NULL ";
        if(isset($dadosConsulta["id"])){
            $sql.=" AND id = ".$dadosConsulta["id"]." ";
        }
        if(isset($dadosConsulta["nome"])){
            $sql.=" AND nome = '".$dadosConsulta["nome"]."' ";
        }
        if(isset($dadosConsulta["crm"])){
            $sql.=" AND crm = '".$dadosConsulta["crm"]."' ";
        }
        if(isset($dadosConsulta["telefone"])){
            $sql.=" AND telefone = '".$dadosConsulta["telefone"]."' ";
        }        
        return Db::getInstance()->select($sql);
    }
    
    public function salvar(Medico $obj){
        $sql =" Insert into medico (";
        $sql.=" nome,";
        $sql.=" crm,";
        $sql.=" telefone,";
        $sql.=" id_especialidade";
        $sql.=" )values( ";
        $sql.= "'".$obj->getNome()."', ";
        $sql.= "'".$obj->getCrm()."', ";
        $sql.= "'".$obj->getTelefone()."', ";
        $sql.= "'".$obj->getEspecialidade()."' ";   
        $sql.=" ) ";
       // var_dump($obj->getEspecialidade());
        //echo $sql;
        //var_dump($sql);
        return Db::getInstance()->executar($sql);
    }
    
    public function alterar(Medico $obj){
        $sql =" UPDATE medico SET ";
        $sql.=" nome = '".$obj->getNome()."',";
        $sql.=" crm = '".$obj->getCrm()."',";
        $sql.=" telefone = '".$obj->getTelefone()."'";        
        $sql.=" WHERE id = ".$obj->getId()." ";          
        return Db::getInstance()->executar($sql);
    }
    public function excluir(Medico $obj){
        $sql =" DELETE FROM `medico`";      
        $sql.=" WHERE id = ".$obj->getId()." ";          
        return Db::getInstance()->executar($sql);
    }

}
