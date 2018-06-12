<?php

namespace app\magic;

use Yii;

class DreBiMagic
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
                valor4 as descricao, 
                valor5 as jan,
                valor6 as feb, 
                valor7 as mar, 
                valor8 as apr, 
                valor9 as may, 
                valor10 as jun, 
                valor11 as jul, 
                valor12 as aug,
                valor13 as sep, 
                valor14 as oct, 
                valor15 as nov, 
                valor16 as dez, 
                valor17 as total              
            FROM indicador6
        ) as sel
        WHERE sel.ano = {$ano} 
            AND sel.empresa = {$empresa_id}
        ORDER BY sel.categoria, sel.descricao ASC;
                
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
    