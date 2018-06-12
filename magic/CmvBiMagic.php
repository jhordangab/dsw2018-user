<?php

namespace app\magic;

use Yii;

class CmvBiMagic
{
    public static function get($empresa_id, $ano)
    {
        $sql = <<<SQL
         
        SELECT * FROM
        (
            SELECT 
                valor2 as empresa, 
                valor3 as ano, 
                valor4 as categoria,
                valor5 as codigo, 
                valor6 as descricao, 
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
            FROM indicador3
            UNION
            SELECT
                valor1 as empresa,
                valor2 as ano,
                '' as categoria,
                '' as codigo,
                'ATIVO CIRCULANTE' as descricao,
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
                (SELECT SUM(valor17) FROM indicador14 i2 WHERE i2.valor1 = cs.valor1 AND i2.valor2 = cs.valor2 AND i2.valor21 = cs.valor21 AND i2.valor20 = cs.valor20) as dez,
                '' as total
            FROM
            (
                SELECT 
                    valor1,
                    valor2,
                    valor3,
                    valor20, 
                    valor21
                FROM agrocontar.indicador14
                WHERE valor20 = '1.1'
                GROUP BY valor1, valor2, valor20, valor21, valor3
            ) AS cs
        ) as sel
        WHERE sel.ano = {$ano}
        AND sel.empresa = {$empresa_id}
        ORDER BY sel.categoria DESC, sel.codigo ASC, sel.descricao ASC;        
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
    