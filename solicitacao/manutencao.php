<?php
/**********************************************************************************
 Sistema e-SIC Livre: sistema de acesso a informação baseado na lei de acesso.

 Copyright (C) 2014 Prefeitura Municipal do Natal

 Este programa é software livre; você pode redistribuí-lo e/ou
 modificá-lo sob os termos da Licença GPL2.
***********************************************************************************/

include_once("../inc/security.php");
include_once("../class/solicitacao.class.php");
require __DIR__ . "/../vendor/autoload.php";

use Esic\Solicitation;


	$erro = ""; //grava o erro, se houver, e exibe por meio de alert (javascript) atraves da funcao getErro() chamada no arquivo do formulario. ps: a fun��o � declara em inc/security.php
  $acao = "";
  $idsolicitante = '';
  $textosolicitacao = '';
  $formaretorno = '';
  $idsecretariaselecionada = '';


	//se tiver sido postado informação do formulario
	if (isset($_POST['acao'])) {
    $idsolicitante = filter_input(INPUT_POST, 'idsolicitante');
    $textosolicitacao = filter_input(INPUT_POST, 'textosolicitacao');
    $formaretorno = filter_input(INPUT_POST, 'formaretorno');
    $idsecretariaselecionada = filter_input(INPUT_POST, 'idsecretariaselecionada');

		$solicitacao = new Solicitation();

		$solicitacao->setIdSolicitante($idsolicitante);
		$solicitacao->setTextoSolicitacao($textosolicitacao);
		$solicitacao->setFormaRetorno($formaretorno);
                $solicitacao->setIdSecretariaSelecionada($idsecretariaselecionada);

        if (!$solicitacao->cadastra()){
		$erro = $solicitacao->getErro();

				if ($upload == 1){
					echo "<script>alert('".$alerta."');</script>";
				}

		}else{

				enviadados();
				echo "<script>alert('Solicitação enviada com sucesso!');location.href='index.php?ok=1';</script>";

				$solicitante = null;

		}
	}
        else
        {
            $idsolicitante = getSession("uid");
        }



?>
