<?php

namespace app\magic;

use Yii;

class RfBiMagic
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
                valor3 as categoria,
                valor6 as codigo,
                valor7 as descricao, 
                valor8 as jan, 
                valor9 as feb, 
                valor10 as mar, 
                valor11 as apr, 
                valor12 as may, 
                valor13 as jun, 
                valor14 as jul, 
                valor15 as aug,
                valor16 as sep, 
                valor17 as oct, 
                valor18 as nov, 
                valor19 as dez, 
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
                (SELECT SUM(valor8) FROM indicador1 i1 WHERE i1.valor1 = cs.valor1 AND i1.valor2 = cs.valor2 AND i1.valor3 = cs.valor3 AND i1.valor4 = cs.valor4 AND i1.valor5 = cs.valor5) as jan,
                (SELECT SUM(valor9) FROM indicador1 i1 WHERE i1.valor1 = cs.valor1 AND i1.valor2 = cs.valor2 AND i1.valor3 = cs.valor3 AND i1.valor4 = cs.valor4 AND i1.valor5 = cs.valor5) as feb,
                (SELECT SUM(valor10) FROM indicador1 i1 WHERE i1.valor1 = cs.valor1 AND i1.valor2 = cs.valor2 AND i1.valor3 = cs.valor3 AND i1.valor4 = cs.valor4 AND i1.valor5 = cs.valor5) as mar,
                (SELECT SUM(valor11) FROM indicador1 i1 WHERE i1.valor1 = cs.valor1 AND i1.valor2 = cs.valor2 AND i1.valor3 = cs.valor3 AND i1.valor4 = cs.valor4 AND i1.valor5 = cs.valor5) as apr,
                (SELECT SUM(valor12) FROM indicador1 i1 WHERE i1.valor1 = cs.valor1 AND i1.valor2 = cs.valor2 AND i1.valor3 = cs.valor3 AND i1.valor4 = cs.valor4 AND i1.valor5 = cs.valor5) as may,
                (SELECT SUM(valor13) FROM indicador1 i1 WHERE i1.valor1 = cs.valor1 AND i1.valor2 = cs.valor2 AND i1.valor3 = cs.valor3 AND i1.valor4 = cs.valor4 AND i1.valor5 = cs.valor5) as jun,
                (SELECT SUM(valor14) FROM indicador1 i1 WHERE i1.valor1 = cs.valor1 AND i1.valor2 = cs.valor2 AND i1.valor3 = cs.valor3 AND i1.valor4 = cs.valor4 AND i1.valor5 = cs.valor5) as jul,
                (SELECT SUM(valor15) FROM indicador1 i1 WHERE i1.valor1 = cs.valor1 AND i1.valor2 = cs.valor2 AND i1.valor3 = cs.valor3 AND i1.valor4 = cs.valor4 AND i1.valor5 = cs.valor5) as aug,
                (SELECT SUM(valor16) FROM indicador1 i1 WHERE i1.valor1 = cs.valor1 AND i1.valor2 = cs.valor2 AND i1.valor3 = cs.valor3 AND i1.valor4 = cs.valor4 AND i1.valor5 = cs.valor5) as sep,
                (SELECT SUM(valor17) FROM indicador1 i1 WHERE i1.valor1 = cs.valor1 AND i1.valor2 = cs.valor2 AND i1.valor3 = cs.valor3 AND i1.valor4 = cs.valor4 AND i1.valor5 = cs.valor5) as oct,
                (SELECT SUM(valor18) FROM indicador1 i1 WHERE i1.valor1 = cs.valor1 AND i1.valor2 = cs.valor2 AND i1.valor3 = cs.valor3 AND i1.valor4 = cs.valor4 AND i1.valor5 = cs.valor5) as nov,
                (SELECT SUM(valor19) FROM indicador1 i1 WHERE i1.valor1 = cs.valor1 AND i1.valor2 = cs.valor2 AND i1.valor3 = cs.valor3 AND i1.valor4 = cs.valor4 AND i1.valor5 = cs.valor5) as dez,
                (SELECT SUM(valor20) FROM indicador1 i1 WHERE i1.valor1 = cs.valor1 AND i1.valor2 = cs.valor2 AND i1.valor3 = cs.valor3 AND i1.valor4 = cs.valor4 AND i1.valor5 = cs.valor5) as total
            FROM
            (
                SELECT 
                    valor1,
                    valor2, 
                    valor3, 
                    valor4,
                    valor5
                FROM agrocontar.indicador1
                GROUP BY valor1, valor2, valor3, valor4, valor5
            ) AS cs
        ) as sel 
        WHERE sel.ano = {$ano} 
            AND sel.empresa = {$empresa_id}
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
    