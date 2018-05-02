<?php

namespace app\magic;

use Yii;

class DfcBiMagic
{
    public static function get($empresa_id, $ano)
    {
        $sql = <<<SQL
         
        SELECT * FROM
        (
            SELECT 
                'LL' as categoria,
                valor1 as empresa, 
                valor2 as ano, 
                valor3 as descricao,
                valor4 as jan, 
                valor5 as feb, 
                valor6 as mar, 
                valor7 as apr, 
                valor8 as may, 
                valor9 as jun, 
                valor10 as jul, 
                valor11 as aug,
                valor12 as sep, 
                valor13 as oct, 
                valor14 as nov, 
                valor15 as dez, 
                (valor4 + valor5 + valor6 + valor7 + valor8 + valor9 + valor10 + 
                    valor11 + valor12 + valor13 + valor14 + valor15) as total
            FROM indicador7
                
            UNION
                
            SELECT 
                'ACLA' as categoria,
                valor1 as empresa, 
                valor2 as ano, 
                valor4 as descricao,
                SUM(valor5) as jan, 
                SUM(valor6) as feb, 
                SUM(valor7) as mar, 
                SUM(valor8) as apr, 
                SUM(valor9) as may, 
                SUM(valor10) as jun, 
                SUM(valor11) as jul, 
                SUM(valor12) as aug,
                SUM(valor13) as sep, 
                SUM(valor14) as oct, 
                SUM(valor15) as nov, 
                SUM(valor16) as dez, 
                SUM((valor5 + valor6 + valor7 + valor8 + valor9 + valor10 + valor11 + 
                    valor12 + valor13 + valor14 + valor15 + valor16)) as total
            FROM indicador8
            WHERE valor4 <> 'Lucro Liquido do Exercicio'
            GROUP BY valor1, valor2, valor4
                
            UNION
                
            SELECT 
                'ARAO' as categoria,
                valor1 as empresa, 
                valor2 as ano, 
                valor4 as descricao,
                SUM(valor5) as jan, 
                SUM(valor6) as feb, 
                SUM(valor7) as mar, 
                SUM(valor8) as apr, 
                SUM(valor9) as may, 
                SUM(valor10) as jun, 
                SUM(valor11) as jul, 
                SUM(valor12) as aug,
                SUM(valor13) as sep, 
                SUM(valor14) as oct, 
                SUM(valor15) as nov, 
                SUM(valor16) as dez, 
                SUM((valor5 + valor6 + valor7 + valor8 + valor9 + valor10 + valor11 + 
                    valor12 + valor13 + valor14 + valor15 + valor16)) as total
            FROM indicador10
            GROUP BY valor1, valor2, valor4
                
            UNION
                
            SELECT 
                'ARPO' as categoria,
                valor1 as empresa, 
                valor2 as ano, 
                valor4 as descricao,
                SUM(valor5) as jan, 
                SUM(valor6) as feb, 
                SUM(valor7) as mar, 
                SUM(valor8) as apr, 
                SUM(valor9) as may, 
                SUM(valor10) as jun, 
                SUM(valor11) as jul, 
                SUM(valor12) as aug,
                SUM(valor13) as sep, 
                SUM(valor14) as oct, 
                SUM(valor15) as nov, 
                SUM(valor16) as dez, 
                SUM((valor5 + valor6 + valor7 + valor8 + valor9 + valor10 + valor11 + 
                    valor12 + valor13 + valor14 + valor15 + valor16)) as total
            FROM indicador9
            GROUP BY valor1, valor2, valor4
                
            UNION
                
            SELECT 
                'FCAI' as categoria,
                valor1 as empresa, 
                valor2 as ano, 
                valor4 as descricao,
                SUM(valor5) as jan, 
                SUM(valor6) as feb, 
                SUM(valor7) as mar, 
                SUM(valor8) as apr, 
                SUM(valor9) as may, 
                SUM(valor10) as jun, 
                SUM(valor11) as jul, 
                SUM(valor12) as aug,
                SUM(valor13) as sep, 
                SUM(valor14) as oct, 
                SUM(valor15) as nov, 
                SUM(valor16) as dez, 
                SUM((valor5 + valor6 + valor7 + valor8 + valor9 + valor10 + valor11 + 
                    valor12 + valor13 + valor14 + valor15 + valor16)) as total
            FROM indicador11
            GROUP BY valor1, valor2, valor4
                
            UNION
                
            SELECT 
                'FCAF' as categoria,
                valor1 as empresa, 
                valor2 as ano, 
                valor4 as descricao,
                SUM(valor5) as jan, 
                SUM(valor6) as feb, 
                SUM(valor7) as mar, 
                SUM(valor8) as apr, 
                SUM(valor9) as may, 
                SUM(valor10) as jun, 
                SUM(valor11) as jul, 
                SUM(valor12) as aug,
                SUM(valor13) as sep, 
                SUM(valor14) as oct, 
                SUM(valor15) as nov, 
                SUM(valor16) as dez, 
                SUM((valor5 + valor6 + valor7 + valor8 + valor9 + valor10 + valor11 + 
                    valor12 + valor13 + valor14 + valor15 + valor16)) as total
            FROM indicador13
            GROUP BY valor1, valor2, valor4
                
            UNION
                
            SELECT 
                'DFCTOT' as categoria,
                valor2 as empresa, 
                valor3 as ano, 
                valor1 as descricao,
                SUM(valor4) as jan, 
                SUM(valor5) as feb, 
                SUM(valor6) as mar, 
                SUM(valor7) as apr, 
                SUM(valor8) as may, 
                SUM(valor9) as jun, 
                SUM(valor10) as jul, 
                SUM(valor11) as aug,
                SUM(valor12) as sep, 
                SUM(valor13) as oct, 
                SUM(valor14) as nov, 
                SUM(valor15) as dez, 
                SUM((valor4 + valor5 + valor6 + valor7 + valor8 + valor9 + valor10 + valor11 + 
                    valor12 + valor13 + valor14 + valor15)) as total
            FROM indicador15
            GROUP BY valor1, valor2, valor3
                
        ) as sel 
        WHERE sel.ano = {$ano} AND sel.empresa = {$empresa_id}
        ORDER BY sel.categoria DESC;
                
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
    