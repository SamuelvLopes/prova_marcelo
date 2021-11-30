<?php
class Medico{    
    private $id;
    private $nome;
    private $crm;
    private $telefone;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getCrm() {
        return $this->crm;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCrm($crm) {
        $this->crm = $crm;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

}
