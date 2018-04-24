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
                valor17 as dez
            FROM indicador14
                WHERE valor6 <> 0 AND valor7 <> 0 AND valor8 <> 0 AND valor9 <> 0 
                AND valor10 <> 0 AND valor11 <> 0 AND valor12 <> 0 AND valor13 <> 0 
                AND valor14 <> 0 AND valor15 <> 0 AND valor16 <> 0 AND valor17 <> 0 

            UNION ALL

            SELECT 
                'oneval' as class,
                valor1 as empresa,
                valor2 as ano,
                valor18 as codigo,
                valor19 as descricao, 
                (SELECT SUM(valor5) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor18 = cs.valor18) as saldo_inicial,
                (SELECT SUM(valor6) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor18 = cs.valor18) as jan,
                (SELECT SUM(valor7) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor18 = cs.valor18) as feb,
                (SELECT SUM(valor8) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor18 = cs.valor18) as mar,
                (SELECT SUM(valor9) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor18 = cs.valor18) as apr,
                (SELECT SUM(valor10) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor18 = cs.valor18) as may,
                (SELECT SUM(valor11) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor18 = cs.valor18) as jun,
                (SELECT SUM(valor12) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor18 = cs.valor18) as jul,
                (SELECT SUM(valor13) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor18 = cs.valor18) as aug,
                (SELECT SUM(valor14) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor18 = cs.valor18) as sep,
                (SELECT SUM(valor15) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor18 = cs.valor18) as oct,
                (SELECT SUM(valor16) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor18 = cs.valor18) as nov,
                (SELECT SUM(valor17) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor19 = cs.valor19 AND i2.valor18 = cs.valor18) as dez
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor18, 
                    valor19 
                FROM agrocontar.indicador14 
                WHERE valor6 <> 0 AND valor7 <> 0 AND valor8 <> 0 AND valor9 <> 0 
                AND valor10 <> 0 AND valor11 <> 0 AND valor12 <> 0 AND valor13 <> 0 
                AND valor14 <> 0 AND valor15 <> 0 AND valor16 <> 0 AND valor17 <> 0
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
                (SELECT SUM(valor6) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor20 = cs.valor20) as jan,
                (SELECT SUM(valor7) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor20 = cs.valor20) as feb,
                (SELECT SUM(valor8) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor20 = cs.valor20) as mar,
                (SELECT SUM(valor9) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor20 = cs.valor20) as apr,
                (SELECT SUM(valor10) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor20 = cs.valor20) as may,
                (SELECT SUM(valor11) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor20 = cs.valor20) as jun,
                (SELECT SUM(valor12) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor20 = cs.valor20) as jul,
                (SELECT SUM(valor13) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor20 = cs.valor20) as aug,
                (SELECT SUM(valor14) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor20 = cs.valor20) as sep,
                (SELECT SUM(valor15) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor20 = cs.valor20) as oct,
                (SELECT SUM(valor16) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor20 = cs.valor20) as nov,
                (SELECT SUM(valor17) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor20 = cs.valor20) as dez
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor20, 
                    valor21 
                FROM agrocontar.indicador14 
                WHERE valor6 <> 0 AND valor7 <> 0 AND valor8 <> 0 AND valor9 <> 0 
                AND valor10 <> 0 AND valor11 <> 0 AND valor12 <> 0 AND valor13 <> 0 
                AND valor14 <> 0 AND valor15 <> 0 AND valor16 <> 0 AND valor17 <> 0
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
                (SELECT SUM(valor6) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor22 = cs.valor22) as jan,
                (SELECT SUM(valor7) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor22 = cs.valor22) as feb,
                (SELECT SUM(valor8) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor22 = cs.valor22) as mar,
                (SELECT SUM(valor9) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor22 = cs.valor22) as apr,
                (SELECT SUM(valor10) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor22 = cs.valor22) as may,
                (SELECT SUM(valor11) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor22 = cs.valor22) as jun,
                (SELECT SUM(valor12) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor22 = cs.valor22) as jul,
                (SELECT SUM(valor13) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor22 = cs.valor22) as aug,
                (SELECT SUM(valor14) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor22 = cs.valor22) as sep,
                (SELECT SUM(valor15) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor22 = cs.valor22) as oct,
                (SELECT SUM(valor16) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor22 = cs.valor22) as nov,
                (SELECT SUM(valor17) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor23 = cs.valor23 AND i2.valor22 = cs.valor22) as dez
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor22, 
                    valor23 
                FROM agrocontar.indicador14 
                WHERE valor6 <> 0 AND valor7 <> 0 AND valor8 <> 0 AND valor9 <> 0 
                AND valor10 <> 0 AND valor11 <> 0 AND valor12 <> 0 AND valor13 <> 0 
                AND valor14 <> 0 AND valor15 <> 0 AND valor16 <> 0 AND valor17 <> 0
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
                (SELECT SUM(valor6) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor24 = cs.valor24) as jan,
                (SELECT SUM(valor7) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor24 = cs.valor24) as feb,
                (SELECT SUM(valor8) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor24 = cs.valor24) as mar,
                (SELECT SUM(valor9) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor24 = cs.valor24) as apr,
                (SELECT SUM(valor10) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor24 = cs.valor24) as may,
                (SELECT SUM(valor11) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor24 = cs.valor24) as jun,
                (SELECT SUM(valor12) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor24 = cs.valor24) as jul,
                (SELECT SUM(valor13) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor24 = cs.valor24) as aug,
                (SELECT SUM(valor14) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor24 = cs.valor24) as sep,
                (SELECT SUM(valor15) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor24 = cs.valor24) as oct,
                (SELECT SUM(valor16) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor24 = cs.valor24) as nov,
                (SELECT SUM(valor17) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor25 = cs.valor25 AND i2.valor24 = cs.valor24) as dez
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor24, 
                    valor25 
                FROM agrocontar.indicador14 
                WHERE valor6 <> 0 AND valor7 <> 0 AND valor8 <> 0 AND valor9 <> 0 
                AND valor10 <> 0 AND valor11 <> 0 AND valor12 <> 0 AND valor13 <> 0 
                AND valor14 <> 0 AND valor15 <> 0 AND valor16 <> 0 AND valor17 <> 0
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
                (SELECT SUM(valor6) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor26 = cs.valor26) as jan,
                (SELECT SUM(valor7) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor26 = cs.valor26) as feb,
                (SELECT SUM(valor8) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor26 = cs.valor26) as mar,
                (SELECT SUM(valor9) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor26 = cs.valor26) as apr,
                (SELECT SUM(valor10) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor26 = cs.valor26) as may,
                (SELECT SUM(valor11) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor26 = cs.valor26) as jun,
                (SELECT SUM(valor12) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor26 = cs.valor26) as jul,
                (SELECT SUM(valor13) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor26 = cs.valor26) as aug,
                (SELECT SUM(valor14) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor26 = cs.valor26) as sep,
                (SELECT SUM(valor15) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor26 = cs.valor26) as oct,
                (SELECT SUM(valor16) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor26 = cs.valor26) as nov,
                (SELECT SUM(valor17) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor27 = cs.valor27 AND i2.valor26 = cs.valor26) as dez
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor26, 
                    valor27 
                FROM agrocontar.indicador14 
                WHERE valor6 <> 0 AND valor7 <> 0 AND valor8 <> 0 AND valor9 <> 0 
                AND valor10 <> 0 AND valor11 <> 0 AND valor12 <> 0 AND valor13 <> 0 
                AND valor14 <> 0 AND valor15 <> 0 AND valor16 <> 0 AND valor17 <> 0
                GROUP BY valor1, valor2, valor26, valor27
            ) AS cs
        ) as sel 
        WHERE sel.ano = {$ano} 
            AND sel.empresa = {$empresa_id}
        ORDER BY sel.codigo ASC, sel.descricao ASC
                
SQL;
        
        return Yii::$app->db->createCommand($sql)->QueryAll();
    }
}
    