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
    