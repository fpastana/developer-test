<?php

class consultaSintegra extends Spider{

	public function retornaJson($html){
		
		$patern='%titulo((?s).*?)</td>%';
		preg_match_all($patern,$html,$output);
		$patern2='%valor((?s).*?)</td>%';
		preg_match_all($patern2,$html,$output2);
		
		$f = 0;
		
		for($i=0; $i<=20; $i++){
			
			$titulo_exp = explode('>',$output[1][$i+1]);
			$valor_exp = explode('>',$output2[1][$i]);
			$titulo[$i] = str_replace('&nbsp;','',$titulo_exp[1]);
			$titulo[$i] = str_replace(':','',$titulo_exp[1]);
			
			if($f<18){
				$f = $i;
				$valor[$i] = $valor_exp[1];
			} else {
				$valor[$f] = '';
				$f = $i+1;
				$valor[$f] = $valor_exp[1];
			}
			
			$resultado[$titulo[$i]] = $valor[$i];
			$resultado[$titulo[$i]];
			$f++;
			
		}
		
		$json = json_encode($resultado);
		
		return $json;
		
	}
	
}