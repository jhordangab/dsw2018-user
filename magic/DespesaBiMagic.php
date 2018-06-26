<?php

namespace app\magic;

use Yii;
use app\models\AdminEmpresa;

class DespesaBiMagic
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
            $column = $mes + 6;
            $apelido = $array_meses[$mes];
            $select .= "valor{$column} as {$apelido},";
            $sum .= "(SELECT SUM(valor{$column}) FROM indicador4 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor3 = cs.valor3 AND i2.valor4 = cs.valor4) as {$apelido},";
        }
        
//        ----
        
        $sql = <<<SQL
         
        SELECT * FROM 
        (
            SELECT 
                'value' as class,
                valor1 as empresa, 
                valor2 as ano, 
                valor5 as codigo,
                valor6 as descricao, 
                {$select}
                valor19 as total
            FROM indicador4
                
            UNION ALL
            
            SELECT 
                'title' as class,
                valor1 as empresa,
                valor2 as ano,
                valor3 as codigo,
                valor4 as descricao, 
                {$sum}
                (SELECT SUM(valor19) FROM indicador4 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor3 = cs.valor3 AND i2.valor4 = cs.valor4) as total
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor3, 
                    valor4 
                FROM indicador4
                GROUP BY valor1, valor2, valor3, valor4
            ) AS cs
        ) as sel 
        WHERE sel.ano = {$ano} 
            AND sel.empresa = {$empresa->nomeResumo}
        GROUP BY sel.codigo, sel.descricao
        ORDER BY sel.codigo ASC, sel.descricao ASC;
SQL;

        return Yii::$app->db->createCommand($sql)->QueryAll();
    }
}
    