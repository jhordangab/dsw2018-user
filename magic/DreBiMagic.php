<?php

namespace app\magic;

use Yii;
use app\models\AdminEmpresa;

class DreBiMagic
{
    public static function get($model)
    {
        $array_meses = 
        [
            1 => 'jan', 
            2 => 'feb', 
            3 => 'mar', 
            4 => 'apr', 
            5 => 'may', 
            6 => 'jun', 
            7 => 'jul', 
            8 => 'aug',
            9 => 'sep', 
            10 => 'oct', 
            11 => 'nov', 
            12 => 'dez'
        ];
        
        $empresa = AdminEmpresa::findOne($model->empresa_id);
        
//        ----
        
        $ano = $model->ano;
        $select = "";
        
        foreach($model->meses as $mes)
        {
            $apelido = $array_meses[$mes];
            $column = $mes + 4;
            $select .= "valor{$column} as {$apelido},";
        }
        
//        ----
        
        $sql = <<<SQL
         
        SELECT * FROM 
        (
            SELECT
                valor1 as empresa, 
                valor2 as ano, 
                valor3 as categoria,
                valor4 as descricao, 
                {$select}
                valor17 as total              
            FROM indicador6
        ) as sel
        WHERE sel.ano = {$ano} 
        AND sel.empresa = {$empresa->nomeResumo}
        ORDER BY sel.categoria, sel.descricao ASC;
                
SQL;
        
        $dados = [];
        $results = Yii::$app->db->createCommand($sql)->QueryAll();
        
        foreach($results as $result)
        {
            $dados[$result['categoria']][] = $result;
        }
        
        return $dados;
    }
}
    