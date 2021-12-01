<?php

class NegMedico {
    public function __construct(){}
    
    public function salvarMedico($dadosPost){
    
        $obj = $this->factory($dadosPost);
        
        $objRepoMedico = new RepoMedico();
        return $objRepoMedico->salvar($obj);
    }
    
    public function alterarMedico($dadosPost){
    
        $obj = $this->factory($dadosPost);
        $objRepoMedico = new RepoMedico();
        return $objRepoMedico->alterar($obj);
    }

    public function excluirMedico($dadosPost){
        $obj = $this->factory($dadosPost);
        $objRepoMedico = new RepoMedico();
        return $objRepoMedico->excluir($obj);
    }

    private function factory($dados){
        $objMedico = new Medico();
        
        if(isset($dados["id"])){
            $objMedico->setId($dados["id"]);
        }
        if(isset($dados["nome"])){
            $objMedico->setNome($dados["nome"]);
        }
        if(isset($dados["crm"])){
            $objMedico->setCrm($dados["crm"]);
        }
        if(isset($dados["telefone"])){
            $objMedico->setTelefone($dados["telefone"]);
        }  
        if(isset($dados["id_especialidade"])){
            $objMedico->setEspecialidade($dados["id_especialidade"]);
            
        }
        return $objMedico;
    }
    
    private function consultarMedico($dadosFiltro) {
        $dadosFiltroConsulta = $this->trataConsulta($dadosFiltro);  
       // var_dump($dadosFiltroConsulta);
        $objRepoMedico = new RepoMedico();
        $arrDadosMedico = $objRepoMedico->listar($dadosFiltroConsulta);         
        $listaObjMedico=null;
        if(count($arrDadosMedico)>0){
            foreach ($arrDadosMedico as $dadoMedico) {
                $listaObjMedico[] = $this->factory($dadoMedico);
            }
         //   var_dump($listaObjMedico);
        }
        return $listaObjMedico;
    }
    
    public function listarMedico($dadosFiltro){        

        $listaMedico = $this->consultarMedico($dadosFiltro);  
        //var_dump($dadosFiltro);
        $htmlRetorno = '<table class="table table-striped">';
            $htmlRetorno .= '<thead>';
                $htmlRetorno .= '<tr>';
                    $htmlRetorno .= '<th>ID</th>';
                    $htmlRetorno .= '<th>Nome</th>';
                    $htmlRetorno .= '<th>CRM</th>';
                    $htmlRetorno .= '<th>Especialidade</th>';
                    $htmlRetorno .= '<th>Telefone</th>';
                    $htmlRetorno .= '<th>Ação</th>';
                $htmlRetorno .= '</tr>';
            $htmlRetorno .= '</thead>';
            $htmlRetorno .= '<tbody>';
        
            if($listaMedico!=null){
                foreach ($listaMedico as $objMedico) {
                
                    $htmlRetorno .= '<tr>';
                        $htmlRetorno .= '<td>';
                            $htmlRetorno .= $objMedico->getId();                    
                        $htmlRetorno .= '</td>';
                        $htmlRetorno .= '<td>';
                            $htmlRetorno .= $objMedico->getNome();                    
                        $htmlRetorno .= '</td>';
                        $htmlRetorno .= '<td>';
                            $htmlRetorno .= $objMedico->getCrm();                    
                        $htmlRetorno .= '</td>';
                        $htmlRetorno .= '<td>';
                            $htmlRetorno .= $objMedico->getEspecialidade();                    
                        $htmlRetorno .= '</td>';
                        $htmlRetorno .= '<td>';
                            $htmlRetorno .= $objMedico->getTelefone();                    
                        $htmlRetorno .= '</td>';
                        $htmlRetorno .= '<td>';
                            $htmlRetorno .= ' <button class="btn btn-warning" type="button" onclick="editar('.$objMedico->getId().');" >Editar</button>';
                            $htmlRetorno .= ' <button class="btn btn-danger " type="button" onclick="excluir('.$objMedico->getId().');">Excluir</button>';
                        $htmlRetorno .= '</td>';

                    $htmlRetorno .= '</tr>';
                }
            }else{
                $htmlRetorno .= '<tr>';
                    $htmlRetorno .= '<td colspan="4">Nenhum médico encontrado!</td>';            
                $htmlRetorno .= '</tr>';
            }
            $htmlRetorno .= '</tbody>';
        $htmlRetorno .= '</table>';
        return $htmlRetorno;
    }
    
    private function trataConsulta($dadosFiltro){
        $dadosFiltroConsulta=null;
        if(isset($dadosFiltro["id"])){
            if($dadosFiltro["id"]>0){
                $dadosFiltroConsulta["id"] = $dadosFiltro["id"];
            }
        }
        if(isset($dadosFiltro["nome"])){
            if(strlen(trim($dadosFiltro["nome"]))>0){
                $dadosFiltroConsulta["nome"] = trim($dadosFiltro["nome"]);
            }
        }
        if(isset($dadosFiltro["crm"])){
            if(strlen(trim($dadosFiltro["crm"]))>0){
                $dadosFiltroConsulta["crm"] = trim($dadosFiltro["crm"]);
            }
        }
        if(isset($dadosFiltro["telefone"])){
            if(strlen(trim($dadosFiltro["telefone"]))>0){
                $dadosFiltroConsulta["telefone"] = trim($dadosFiltro["telefone"]);
            }
        }
        if(isset($dadosFiltro["id_especialidade"])){
            if(strlen(trim($dadosFiltro["id_especialidade"]))>0){
                $dadosFiltroConsulta["id_especialidade"] = trim($dadosFiltro["id_especialidade"]);
            }
        }
        return $dadosFiltroConsulta;
    }
    
    public function consultaMedicoEdicao($dadosFiltro){
    //var_dump($dadosFiltro);
        $listaMedico = $this->consultarMedico($dadosFiltro); 
       //var_dump($listaMedico);
        if($listaMedico!=null){
            $objMedico = $listaMedico[0];
            // var_dump( $objMedico->getId());
            return json_encode(array(
                'id' => $objMedico->getId(),
                'nome' => $objMedico->getNome(),
                'crm' => $objMedico->getCrm(),
                'telefone' => $objMedico->getTelefone(),
                'especialidade'=>$objMedico->getEspecialidade()
            ));
        }else{
            return null;
        }        
    } 
}