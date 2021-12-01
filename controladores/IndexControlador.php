<?php    
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    include("../inc/autoload.php");
    
    ###################### JSON ######################
    $arrStrJson             = null;
    $arrStrJson["statusOp"] = "false";
    $arrStrJson["msgOp"]    = "OPERACAO_NAO_REALIZADA";
    ##################################################
        
    try{
        // verifica se o controlado recebeu uma ação

        if(isset($_POST["ACO_Descricao"])){
			
        switch (trim($_POST["ACO_Descricao"])) {
			
	    case '':
		 $arrStrJson["msgOp"] = "Ação repassada em branco!";
         break;
		 
	    case 'Salvar':
		 $objNegMedico = new NegMedico();
                    if($objNegMedico->salvarMedico($_POST)){
                        $arrStrJson["statusOp"] = "true";
                        $arrStrJson["msgOp"] = "Cadastro realizado com sucesso!";
                    }else{
                        $arrStrJson["statusOp"] = "false";
                        $arrStrJson["msgOp"] = "Cadastro não realizado!";
                    } 
		break;
		case 'Alterar':
		 $objNegMedico = new NegMedico();
                   
                    if($objNegMedico->alterarMedico($_POST)){
                        $arrStrJson["statusOp"] = "true";
                        $arrStrJson["msgOp"] = "Alteração realizada com sucesso!";
                    }else{
                        $arrStrJson["statusOp"] = "false";
                        $arrStrJson["msgOp"] = "Alteração não realizada!";
                    }
		break;
		case 'Excluir':
		 $objNegMedico = new NegMedico();

                    if($objNegMedico->excluirMedico($_POST)){
                        $arrStrJson["statusOp"] = "true";
                        $arrStrJson["msgOp"] = "exclusão realizada com sucesso!";
                    }else{
                        $arrStrJson["statusOp"] = "false";
                        $arrStrJson["msgOp"] = "exclusão não realizada!";
                    }
		break;
		case 'Listar':
		 $objNegMedico = new NegMedico();
                    $htmlRetorno = $objNegMedico->listarMedico($_POST);
                    $arrStrJson["msgOp"]="";
                    $arrStrJson["html"] = $htmlRetorno;
                    $arrStrJson["statusOp"] = "true";
		break;
		case 'Consultar':
		
		$objNegMedico = new NegMedico();
                    $objetoMedicoJson = $objNegMedico->consultaMedicoEdicao($_POST);  
                  
                    if($objetoMedicoJson!=null){
                        $arrStrJson["msgOp"]="";
                        $arrStrJson["obj"] = $objetoMedicoJson;                        
                        $arrStrJson["statusOp"] = "true";
                    }else{
                        $arrStrJson["statusOp"] = "false";
                        $arrStrJson["msgOp"]="Medico não localizado";
                        $arrStrJson["obj"] = null;                        
                    }
		break;
		}

        }else{
         $arrStrJson["msgOp"] = "Ação nao encontrada!";
        }

       
    }catch(Exception $objException){
        $arrStrJson["statusOp"]  = "excecao";        
        $arrStrJson["msgOp"] = $objException->getMessage();        
    }    
    echo json_encode($arrStrJson);    
?>