<?php

namespace app\magic;

use Yii;
use app\models\AdminEmpresa;

class DfcBiMagic
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
        $select_4 = $select_5 = "";
        
        foreach($model->meses as $mes)
        {
            $apelido = $array_meses[$mes];
            
            $column_4 = $mes + 3;
            $select_4 .= "valor{$column_4} as {$apelido},";
            
            $column_5 = $mes + 4;
            $select_5 .= "valor{$column_5} as {$apelido},";
        }
        
//        ----
        
        $sql = <<<SQL
         
        SELECT * FROM
        (
            SELECT 
                'LL' as categoria,
                valor1 as empresa, 
                valor2 as ano, 
                valor3 as descricao,
                {$select_4}
                (valor4 + valor5 + valor6 + valor7 + valor8 + valor9 + valor10 + 
                    valor11 + valor12 + valor13 + valor14 + valor15) as total
            FROM indicador7
                
            UNION
                
            SELECT 
                'ACLA' as categoria,
                valor1 as empresa, 
                valor2 as ano, 
                valor4 as descricao,
                {$select_5}
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
                {$select_5}
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
                {$select_5}
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
                {$select_5}
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
                {$select_5}
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
                {$select_4}
                SUM((valor4 + valor5 + valor6 + valor7 + valor8 + valor9 + valor10 + valor11 + 
                    valor12 + valor13 + valor14 + valor15)) as total
            FROM indicador15
            GROUP BY valor1, valor2, valor3
                
        ) as sel 
        WHERE sel.ano = {$ano} 
        AND sel.empresa = {$empresa->nomeResumo}
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
    