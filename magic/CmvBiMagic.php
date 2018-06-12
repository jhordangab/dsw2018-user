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
                valor1 as empresa, 
                valor2 as ano, 
                valor3 as categoria,
                valor4 as codigo, 
                valor5 as descricao, 
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
                valor18 as total,
                valor19 as ordem
            FROM indicador3
        ) as sel
        WHERE sel.ano = {$ano}
        AND sel.empresa = {$empresa_id}
        ORDER BY sel.categoria DESC, cast(sel.ordem as int) ASC, sel.codigo ASC, sel.descricao ASC;        
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
    