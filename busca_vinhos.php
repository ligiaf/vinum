<?php

require_once 'vendor/autoload.php';
include 'conecta.php';

function buscaVinhos($estrela, $preco, $regiao, $estilo, $tipo_vinho, $tipo_uva, $harmonizacao){
	$vinhos = ORM::for_table('vinho')->find_many();
	foreach ($vinhos as $vinho) {
		$vinho['estrela'] = ORM::for_table('avaliacao')->where('ID_vinho', $vinho['ID_vinho'])->avg('nota');
		$vinho['nome_regiao'] = ORM::for_table('regiao')->where('ID_regiao', $vinho['ID_regiao'])->find_many();
		$vinho['nome_tipo'] = ORM::for_table('tipo_vinho')->where('ID_tipo', $vinho['ID_tipo'])->find_many();
		$vinho['nome_estilo'] = ORM::for_table('estilo')->where('ID_estilo', $vinho['ID_estilo'])->find_many();
		$uvas = ORM::for_table('vinho_uva')->where('ID_vinho', $vinho['ID_vinho'])->find_many();
		$vinho['uvas'] = array();
		foreach ($uvas as $uva) {
			array_push($vinho['uvas'],ORM::for_table('uva')->where('ID_uva', $uva['ID_uva'])->find_many());
		}
		$comidas = ORM::for_table('vinho_comida')->where('ID_vinho', $vinho['ID_vinho'])->find_many();
		$vinho['comidas'] = array();
		foreach ($comidas as $comida) {
			array_push($vinho['comidas'],ORM::for_table('comida')->where('ID_comida', $comida['ID_comida'])->find_many());
		}
		echo implode(",",$vinho['comidas']);
				
	}
	foreach ($vinhos as $vinho) {
		echo $vinho ['nome']." - ".$vinho['estrela'].'<br>';
		echo implode(",",$vinho['comidas']);
	}
	if ($estrela){
		$vinhos_estrela = array();
		foreach ($vinhos as $vinho) {
			if ($vinho['estrela']>=$estrela){
				array_push($vinhos_estrela, $vinho);
			}
		}
		$vinhos = $vinhos_estrela;
	}
	if ($preco){
		$vinhos_preco = array();
		foreach ($vinhos as $vinho) {
			if ($vinho['preco']>=$preco){
				array_push($vinhos_preco, $vinho);
			}
		}
		$vinhos = $vinhos_preco;		
	}
	if ($regiao){
		$vinhos_regiao = array();
		foreach ($vinhos as $vinho) {
			if ($vinho['nome_regiao']==$regiao){
				array_push($vinhos_regiao, $vinho);
			}
		}
		$vinhos = $vinhos_regiao;		
	}
	if ($estilo){
		$vinhos_estilo = array();
		foreach ($vinhos as $vinho) {
			if ($vinho['nome_estilo']==$estilo){
				array_push($vinhos_estilo, $vinho);
			}
		}
		$vinhos = $vinhos_estilo;		
	}
	if ($tipo_vinho){
		$vinhos_tipo_vinho = array();
		foreach ($vinhos as $vinho) {
			if ($vinho['nome_tipo']==$tipo_vinho){
				array_push($vinhos_tipo_vinho, $vinho);
			}
		}
		$vinhos = $vinhos_tipo_vinho;		
	}
	if ($tipo_uva){
		$vinhos_tipo_uva = array();
		foreach ($vinhos as $vinho) {
			foreach ($vinhos['uvas'] as $vinho_uva) {
				if ($vinho_uva['tipo']==$tipo_uva){
					array_push($vinhos_tipo_uva, $vinho);
				}
			}
		}
		$vinhos = $vinhos_tipo_uva;		
	}
	if ($harmonizacao){
		$vinhos_harmonizacao = array();
		foreach ($vinhos as $vinho) {
			foreach ($vinhos['comidas'] as $vinho_comida) {
				if ($vinho_comida['nome']==$harmonizacao){
					array_push($vinhos_harmonizacao, $vinho);
				}
			}
		}
		$vinhos = $vinhos_harmonizacao;		
	}
	return $vinhos;
}

//print_r(buscaVinhos(5,null,null,null,null,null,null));


$vinhos = buscaVinhos(null,null,'Norte',null,null,null,null);
	foreach ($vinhos as $vinho) {
		echo $vinho ['nome']." - ".$vinho['estrela'].'<br>';
		echo implode(",",$vinho['comidas']);
	}