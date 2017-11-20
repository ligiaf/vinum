<?php

require_once 'vendor/autoload.php';
include 'conecta.php';

function buscaVinhos($estrela, $preco, $regiao, $estilo, $tipo_vinho, $tipo_uva, $harmonizacao){
	$vinhos = ORM::for_table('vinho')->find_many();
	foreach ($vinhos as $vinho) {
		$vinho['estrela'] = ORM::for_table('avaliacao')->where('ID_vinho', $vinho['ID_vinho'])->avg('nota');
		$resultado = ORM::for_table('regiao')->where('ID_regiao', $vinho['ID_regiao'])->find_one();
		$vinho['nome_regiao'] = $resultado['nome'];
		$resultado = ORM::for_table('tipo_vinho')->where('ID_tipo', $vinho['ID_tipo'])->find_one();
		$vinho['nome_tipo'] = $resultado['nome'];
		$resultado = ORM::for_table('estilo')->where('ID_estilo', $vinho['ID_estilo'])->find_one();
		$vinho['nome_estilo'] = $resultado['nome'];
		$resultado = ORM::for_table('uva')->where('ID_uva', $vinho['ID_uva'])->find_one();
		$vinho['tipo_uva'] = $resultado['tipo'];
		$comidas_vinho = ORM::for_table('vinho_comida')->where('ID_vinho', $vinho['ID_vinho'])->select('ID_comida')->find_many();
		$resultados = array();
		foreach ($comidas_vinho as $comida_vinho) {
			$resultado = ORM::for_table('comida')->where('ID_comida', $comida_vinho['ID_comida'])->select('nome')->find_one();
			$ID_comida = $comida_vinho['ID_comida'];
			$resultados[strval($ID_comida)] = $resultado['nome'];
		}
		$vinho['comidas'] = $resultados;
				
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
			foreach ($vinho['comidas'] as $vinho_comida) {
				if ($vinho_comida==$harmonizacao){
					array_push($vinhos_harmonizacao, $vinho);
				}
			}
		}
		$vinhos = $vinhos_harmonizacao;		
	}
	return $vinhos;
}

$vinhos = buscaVinhos(null,null,null,null,null,null,'Cordeiro');
	foreach ($vinhos as $vinho) {
		echo $vinho ['nome']." - ".$vinho['estrela'].' | REGIÃO - '.$vinho['nome_regiao'].' | TIPO - '.$vinho['nome_tipo'].' | ESTILO -'.$vinho['nome_estilo'].' | TIPO UVA - '.$vinho['tipo_uva'].'<br>'.'COMIDAS: ';
		foreach ($vinho['comidas'] as $comida) {
			echo ' '.$comida.' |';
		}
		echo '<br>';
	}