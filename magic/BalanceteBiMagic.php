<?php

namespace app\magic;

use Yii;

class BalanceteBiMagic
{
    public static function get($empresa_id, $ano)
    {
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
                valor6 as jan, 
                valor7 as feb, 
                valor8 as mar, 
                valor9 as apr, 
                valor10 as may, 
                valor11 as jun, 
                valor12 as jul, 
                valor13 as aug,
                valor14 as sep, 
                valor15 as oct, 
                valor16 as nov, 
                valor17 as dez, 
                valor18 as total
            FROM indicador2

            UNION ALL

            SELECT 
                'oneval' as class,
                valor1 as empresa,
                valor2 as ano,
                valor19 as codigo,
                valor20 as descricao, 
                (SELECT SUM(valor5) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor20 = cs.valor20) as saldo_inicial,
                (SELECT SUM(valor6) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor20 = cs.valor20) as jan,
                (SELECT SUM(valor7) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor20 = cs.valor20) as feb,
                (SELECT SUM(valor8) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor20 = cs.valor20) as mar,
                (SELECT SUM(valor9) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor20 = cs.valor20) as apr,
                (SELECT SUM(valor10) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor20 = cs.valor20) as may,
                (SELECT SUM(valor11) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor20 = cs.valor20) as jun,
                (SELECT SUM(valor12) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor20 = cs.valor20) as jul,
                (SELECT SUM(valor13) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor20 = cs.valor20) as aug,
                (SELECT SUM(valor14) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor20 = cs.valor20) as sep,
                (SELECT SUM(valor15) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor20 = cs.valor20) as oct,
                (SELECT SUM(valor16) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor20 = cs.valor20) as nov,
                (SELECT SUM(valor17) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor20 = cs.valor20) as dez,
                (SELECT SUM(valor18) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor20 = cs.valor20) as total
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor19, 
                    valor20 
                FROM agrocontar.indicador2 
                GROUP BY valor1, valor2, valor19, valor20
            ) AS cs

            UNION ALL

            SELECT 
                'twoval' as class,
                valor1 as empresa,
                valor2 as ano,
                valor21 as codigo,
                valor22 as descricao, 
                (SELECT SUM(valor5) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor22 = cs.valor22) as saldo_inicial,
                (SELECT SUM(valor6) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor22 = cs.valor22) as jan,
                (SELECT SUM(valor7) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor22 = cs.valor22) as feb,
                (SELECT SUM(valor8) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor22 = cs.valor22) as mar,
                (SELECT SUM(valor9) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor22 = cs.valor22) as apr,
                (SELECT SUM(valor10) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor22 = cs.valor22) as may,
                (SELECT SUM(valor11) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor22 = cs.valor22) as jun,
                (SELECT SUM(valor12) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor22 = cs.valor22) as jul,
                (SELECT SUM(valor13) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor22 = cs.valor22) as aug,
                (SELECT SUM(valor14) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor22 = cs.valor22) as sep,
                (SELECT SUM(valor15) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor22 = cs.valor22) as oct,
                (SELECT SUM(valor16) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor22 = cs.valor22) as nov,
                (SELECT SUM(valor17) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor22 = cs.valor22) as dez,
                (SELECT SUM(valor18) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor22 = cs.valor22) as total
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor21, 
                    valor22 
                FROM agrocontar.indicador2 
                GROUP BY valor1, valor2, valor21, valor22
            ) AS cs

            UNION ALL

            SELECT 
                'threeval' as class,
                valor1 as empresa,
                valor2 as ano,
                valor23 as codigo,
                valor24 as descricao, 
                (SELECT SUM(valor5) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor24 = cs.valor24) as saldo_inicial,
                (SELECT SUM(valor6) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor24 = cs.valor24) as jan,
                (SELECT SUM(valor7) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor24 = cs.valor24) as feb,
                (SELECT SUM(valor8) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor24 = cs.valor24) as mar,
                (SELECT SUM(valor9) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor24 = cs.valor24) as apr,
                (SELECT SUM(valor10) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor24 = cs.valor24) as may,
                (SELECT SUM(valor11) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor24 = cs.valor24) as jun,
                (SELECT SUM(valor12) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor24 = cs.valor24) as jul,
                (SELECT SUM(valor13) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor24 = cs.valor24) as aug,
                (SELECT SUM(valor14) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor24 = cs.valor24) as sep,
                (SELECT SUM(valor15) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor24 = cs.valor24) as oct,
                (SELECT SUM(valor16) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor24 = cs.valor24) as nov,
                (SELECT SUM(valor17) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor24 = cs.valor24) as dez,
                (SELECT SUM(valor18) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor24 = cs.valor24) as total
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor23, 
                    valor24 
                FROM agrocontar.indicador2 
                GROUP BY valor1, valor2, valor23, valor24
            ) AS cs

            UNION ALL

            SELECT 
                'fourval' as class,
                valor1 as empresa,
                valor2 as ano,
                valor25 as codigo,
                valor26 as descricao, 
                (SELECT SUM(valor5) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor26 = cs.valor26) as saldo_inicial,
                (SELECT SUM(valor6) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor26 = cs.valor26) as jan,
                (SELECT SUM(valor7) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor26 = cs.valor26) as feb,
                (SELECT SUM(valor8) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25= cs.valor25 AND i2.valor26 = cs.valor26) as mar,
                (SELECT SUM(valor9) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor26 = cs.valor26) as apr,
                (SELECT SUM(valor10) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor26 = cs.valor26) as may,
                (SELECT SUM(valor11) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor26 = cs.valor26) as jun,
                (SELECT SUM(valor12) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor26 = cs.valor26) as jul,
                (SELECT SUM(valor13) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor26 = cs.valor26) as aug,
                (SELECT SUM(valor14) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor26 = cs.valor26) as sep,
                (SELECT SUM(valor15) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor26 = cs.valor26) as oct,
                (SELECT SUM(valor16) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor26 = cs.valor26) as nov,
                (SELECT SUM(valor17) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor26 = cs.valor26) as dez,
                (SELECT SUM(valor18) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor26 = cs.valor26) as total
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor25, 
                    valor26 
                FROM agrocontar.indicador2 
                GROUP BY valor1, valor2, valor25, valor26
            ) AS cs

            UNION ALL

            SELECT 
                'fiveval' as class,
                valor1 as empresa,
                valor2 as ano,
                valor27 as codigo,
                valor28 as descricao, 
                (SELECT SUM(valor5) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor28 = cs.valor28) as saldo_inicial,
                (SELECT SUM(valor6) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor28 = cs.valor28) as jan,
                (SELECT SUM(valor7) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor28 = cs.valor28) as feb,
                (SELECT SUM(valor8) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor28 = cs.valor28) as mar,
                (SELECT SUM(valor9) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor28 = cs.valor28) as apr,
                (SELECT SUM(valor10) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor28 = cs.valor28) as may,
                (SELECT SUM(valor11) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor28 = cs.valor28) as jun,
                (SELECT SUM(valor12) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor28 = cs.valor28) as jul,
                (SELECT SUM(valor13) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor28 = cs.valor28) as aug,
                (SELECT SUM(valor14) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor28 = cs.valor28) as sep,
                (SELECT SUM(valor15) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor28 = cs.valor28) as oct,
                (SELECT SUM(valor16) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor28 = cs.valor28) as nov,
                (SELECT SUM(valor17) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor28 = cs.valor28) as dez,
                (SELECT SUM(valor18) FROM indicador2 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor28 = cs.valor28) as total
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor27, 
                    valor28 
                FROM agrocontar.indicador2 
                GROUP BY valor1, valor2, valor27, valor28
            ) AS cs
        ) as sel 
        WHERE sel.ano = {$ano} 
            AND sel.empresa = {$empresa_id}
        ORDER BY sel.codigo ASC, sel.descricao ASC
                
SQL;
        
        return Yii::$app->db->createCommand($sql)->QueryAll();
    }
}
    