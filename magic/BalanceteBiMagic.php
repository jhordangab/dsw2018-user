<?php

namespace app\magic;

use Yii;
use app\models\AdminEmpresa;

class BalanceteBiMagic
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
        $main_select = $select_1 = $select_2 = $select_3 = $select_4 = $select_5 = "";
        $valor_vazio = "sel.saldo_inicial";
        
        foreach($model->meses as $index => $mes)
        {
            $size = count($model->meses) - 1;
            $column = $mes + 5;
            $apelido = $array_meses[$mes];
            $main_select .= "valor{$column} as {$apelido}";
            $main_select .= ($index == $size) ? "" : ",";
            
            $select_1 .= "(SELECT SUM(valor{$column}) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor18 = cs.valor18) as {$apelido}";
            $select_1 .= ($index == $size) ? "" : ",";
            
            $select_2 .= "(SELECT SUM(valor{$column}) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor20 = cs.valor20) as {$apelido}";
            $select_2 .= ($index == $size) ? "" : ",";
            
            $select_3 .= "(SELECT SUM(valor{$column}) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor22 = cs.valor22) as {$apelido}";
            $select_3 .= ($index == $size) ? "" : ",";
            
            $select_4 .= "(SELECT SUM(valor{$column}) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor24 = cs.valor24) as {$apelido}";
            $select_4 .= ($index == $size) ? "" : ",";
            
            $select_5 .= "(SELECT SUM(valor{$column}) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor26 = cs.valor26) as {$apelido}";
            $select_5 .= ($index == $size) ? "" : ",";
            
            $valor_vazio .= " + sel.{$apelido}";
        }
        
//        ----

        $sql = <<<SQL
         
        SELECT * FROM 
        (
            SELECT 
                'mainval' as class,
                valor1 as empresa, 
                valor2 as ano, 
                valor3 as codigo,
                valor4 as descricao, 
                valor5 as saldo_inicial, 
                {$main_select}
            FROM indicador14

            UNION ALL

            SELECT 
                'oneval' as class,
                valor1 as empresa,
                valor2 as ano,
                valor18 as codigo,
                valor19 as descricao, 
                (SELECT SUM(valor5) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor18 = cs.valor18) as saldo_inicial,
                {$select_1}
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor18, 
                    valor19 
                FROM agrocontar.indicador14
                GROUP BY valor1, valor2, valor18, valor19
            ) AS cs

            UNION ALL

            SELECT 
                'twoval' as class,
                valor1 as empresa,
                valor2 as ano,
                valor20 as codigo,
                valor21 as descricao, 
                (SELECT SUM(valor5) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor20 = cs.valor20) as saldo_inicial,
                {$select_2}
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor20, 
                    valor21 
                FROM agrocontar.indicador14
                GROUP BY valor1, valor2, valor20, valor21
            ) AS cs

            UNION ALL

            SELECT 
                'threeval' as class,
                valor1 as empresa,
                valor2 as ano,
                valor22 as codigo,
                valor23 as descricao, 
                (SELECT SUM(valor5) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor22 = cs.valor22) as saldo_inicial,
                {$select_3}
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor22, 
                    valor23 
                FROM agrocontar.indicador14
                GROUP BY valor1, valor2, valor22, valor23
            ) AS cs

            UNION ALL

            SELECT 
                'fourval' as class,
                valor1 as empresa,
                valor2 as ano,
                valor24 as codigo,
                valor25 as descricao, 
                (SELECT SUM(valor5) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor24 = cs.valor24) as saldo_inicial,
                {$select_4}
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor24, 
                    valor25 
                FROM agrocontar.indicador14
                GROUP BY valor1, valor2, valor24, valor25
            ) AS cs

            UNION ALL

            SELECT 
                'fiveval' as class,
                valor1 as empresa,
                valor2 as ano,
                valor26 as codigo,
                valor27 as descricao, 
                (SELECT SUM(valor5) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor26 = cs.valor26) as saldo_inicial,
                {$select_5}
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor26, 
                    valor27 
                FROM agrocontar.indicador14
                GROUP BY valor1, valor2, valor26, valor27
            ) AS cs
        ) AS sel 
        WHERE sel.ano = {$ano} 
        AND sel.empresa = {$empresa->nomeResumo}
        AND ({$valor_vazio}) != 0
        ORDER BY sel.codigo ASC, sel.descricao ASC
                
SQL;
        return Yii::$app->db->createCommand($sql)->QueryAll();
    }
}
    