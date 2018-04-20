<?php

namespace app\magic;

use Yii;

class OutraDespesaBiMagic
{
    public static function get($empresa_id, $ano)
    {
        $sql = <<<SQL
         
        SELECT * FROM 
        (
            SELECT 
                'value' as class,
                valor1 as empresa, 
                valor2 as ano, 
                valor3 as codigo,
                valor4 as descricao, 
                valor7 as jan, 
                valor8 as feb, 
                valor9 as mar, 
                valor10 as apr, 
                valor11 as may, 
                valor12 as jun, 
                valor13 as jul, 
                valor14 as aug,
                valor15 as sep, 
                valor16 as oct, 
                valor17 as nov, 
                valor18 as dez, 
                valor19 as total
            FROM indicador5

            UNION ALL

            SELECT 
                'title' as class,
                valor1 as empresa,
                valor2 as ano,
                valor5 as codigo,
                valor6 as descricao, 
                (SELECT SUM(valor7) FROM indicador5 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor5 = cs.valor5 AND i2.valor6 = cs.valor6) as jan,
                (SELECT SUM(valor8) FROM indicador5 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor5 = cs.valor5 AND i2.valor6 = cs.valor6) as feb,
                (SELECT SUM(valor9) FROM indicador5 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor5 = cs.valor5 AND i2.valor6 = cs.valor6) as mar,
                (SELECT SUM(valor10) FROM indicador5 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor5 = cs.valor5 AND i2.valor6 = cs.valor6) as apr,
                (SELECT SUM(valor11) FROM indicador5 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor5 = cs.valor5 AND i2.valor6 = cs.valor6) as may,
                (SELECT SUM(valor12) FROM indicador5 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor5 = cs.valor5 AND i2.valor6 = cs.valor6) as jun,
                (SELECT SUM(valor13) FROM indicador5 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor5 = cs.valor5 AND i2.valor6 = cs.valor6) as jul,
                (SELECT SUM(valor14) FROM indicador5 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor5 = cs.valor5 AND i2.valor6 = cs.valor6) as aug,
                (SELECT SUM(valor15) FROM indicador5 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor5 = cs.valor5 AND i2.valor6 = cs.valor6) as sep,
                (SELECT SUM(valor16) FROM indicador5 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor5 = cs.valor5 AND i2.valor6 = cs.valor6) as oct,
                (SELECT SUM(valor17) FROM indicador5 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor5 = cs.valor5 AND i2.valor6 = cs.valor6) as nov,
                (SELECT SUM(valor18) FROM indicador5 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor5 = cs.valor5 AND i2.valor6 = cs.valor6) as dez,
                (SELECT SUM(valor19) FROM indicador5 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor5 = cs.valor5 AND i2.valor6 = cs.valor6) as total
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor5, 
                    valor6 
                FROM agrocontar.indicador5 
                GROUP BY valor1, valor2, valor5, valor6
            ) AS cs
        ) as sel 
        WHERE sel.ano = {$ano} 
            AND sel.empresa = {$empresa_id}
        ORDER BY sel.codigo ASC, sel.descricao ASC;
                
SQL;
        
        return Yii::$app->db->createCommand($sql)->QueryAll();
    }
}
    