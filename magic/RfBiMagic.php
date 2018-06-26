<?php

namespace app\magic;

use Yii;
use app\models\AdminEmpresa;

class RfBiMagic
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
        $select = $sum = "";
        
        foreach($model->meses as $mes)
        {
            $apelido = $array_meses[$mes];
            $column = $mes + 7;
            $select .= "valor{$column} as {$apelido},";
            $sum .= "(SELECT SUM(valor{$column}) FROM indicador1 i1 WHERE i1.valor1 = cs.valor1 AND i1.valor2 = cs.valor2 AND i1.valor3 = cs.valor3 AND i1.valor4 = cs.valor4 AND i1.valor5 = cs.valor5) as {$apelido},";
        }
        
//        ----
        
        $sql = <<<SQL
         
        SELECT * FROM 
        (
            SELECT 
                'value' as class,
                valor1 as empresa, 
                valor2 as ano, 
                valor3 as categoria,
                valor6 as codigo,
                valor7 as descricao, 
                {$select}
                valor20 as total
            FROM indicador1

            UNION ALL

            SELECT 
                'title' as class,
                valor1 as empresa,
                valor2 as ano,
                valor3 as categoria,
                valor4 as codigo, 
                valor5 as descricao, 
                {$sum}
                (SELECT SUM(valor20) FROM indicador1 i1 WHERE i1.valor1 = cs.valor1 AND i1.valor2 = cs.valor2 AND i1.valor3 = cs.valor3 AND i1.valor4 = cs.valor4 AND i1.valor5 = cs.valor5) as total
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor3, 
                    valor4,
                    valor5
                FROM indicador1
                GROUP BY valor1, valor2, valor3, valor4, valor5
            ) AS cs
        ) as sel 
        WHERE sel.ano = {$ano} 
        AND sel.empresa = {$empresa->nomeResumo}
        ORDER BY sel.categoria, sel.codigo ASC, sel.descricao ASC;
                
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
    