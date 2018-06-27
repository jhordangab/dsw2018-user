<?php

namespace app\magic;

use Yii;
use app\models\AdminEmpresa;

class LalurBiMagic
{
    public static function get($model)
    {
        $empresa = AdminEmpresa::findOne($model->empresa_id);
        $empresa_id = $empresa->nomeResumo;
        
        $ano = $model->ano;
        
        $sql = <<<SQL
         
        SELECT * FROM 
        (
            SELECT 
                valor1 as empresa, 
                valor2 as ano, 
                'LL' as categoria,
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
                '' as ordem
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
                '' as ordem
            FROM indicador8
            WHERE valor4 <> 'Lucro Liquido do Exercicio'
            GROUP BY valor1, valor2, valor4                
            
            UNION                
            
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
                '' as ordem
            FROM indicador16                
            
            UNION                 
            
            SELECT 
                    valor1 as empresa, 
                    valor2 as ano, 
                    'LPEIRPJ' as categoria,
                    'Base Cálculo IRPJ (Venda/Remessas) 8%' as descricao, 
                    sum(valor5) * 0.08 as jan,
                    sum(valor6) * 0.08 as feb, 
                    sum(valor7) * 0.08 as mar, 
                    sum(valor8) * 0.08 as apr, 
                    sum(valor9) * 0.08 as may, 
                    sum(valor10) * 0.08 as jun, 
                    sum(valor11) * 0.08 as jul, 
                    sum(valor12) * 0.08 as aug,
                    sum(valor13) * 0.08 as sep, 
                    sum(valor14) * 0.08 as oct, 
                    sum(valor15) * 0.08 as nov, 
                    sum(valor16) * 0.08 as dez,
                    '01' as ordem
            FROM indicador6
            WHERE valor3 = 'RECEITAS OPERACIONAIS' AND (valor4 = 'Devolucao de Vendas' OR valor4 = 'Vendas / Remessa ')
            GROUP BY valor1, valor2, valor3        
            
            UNION
            
            SELECT 
                    valor1 as empresa, 
                    valor2 as ano, 
                    'LPEIRPJ' as categoria,
                    'Base Cálculo IRPJ (Serviços) 32%' as descricao, 
                    sum(valor5) * 0.32 as jan,
                    sum(valor6) * 0.32 as feb, 
                    sum(valor7) * 0.32 as mar, 
                    sum(valor8) * 0.32 as apr, 
                    sum(valor9) * 0.32 as may, 
                    sum(valor10) * 0.32 as jun, 
                    sum(valor11) * 0.32 as jul, 
                    sum(valor12) * 0.32 as aug,
                    sum(valor13) * 0.32 as sep, 
                    sum(valor14) * 0.32 as oct, 
                    sum(valor15) * 0.32 as nov, 
                    sum(valor16) * 0.32 as dez,
                    '02' as ordem
            FROM indicador6
            WHERE valor3 = 'RECEITAS OPERACIONAIS' AND valor4 = 'Receitas Servicos '
            GROUP BY valor1, valor2, valor3
            
            UNION
            
            SELECT 
                    valor1 as empresa, 
                    valor2 as ano, 
                    'LPEIRPJ' as categoria,
                    'Base Cálculo IRPJ Outras Receitas - 100%' as descricao, 
                    sum(valor5) as jan,
                    sum(valor6) as feb, 
                    sum(valor7) as mar, 
                    sum(valor8) as apr, 
                    sum(valor9) as may, 
                    sum(valor10) as jun, 
                    sum(valor11) as jul, 
                    sum(valor12) as aug,
                    sum(valor13) as sep, 
                    sum(valor14) as oct, 
                    sum(valor15) as nov, 
                    sum(valor16) as dez,
                    '04' as ordem
            FROM indicador6
            WHERE valor3 = 'OUTRAS RECEITAS / DESPESAS'
            GROUP BY valor1, valor2, valor3
            
            UNION
            
            SELECT 
                    valor1 as empresa, 
                    valor2 as ano, 
                    'LPEIRPJ' as categoria,
                    'Base Cálculo IRPJ Receitas Financeiras - 100%' as descricao, 
                    sum(valor8) * -1 as jan,
                    sum(valor9) * -1 as feb, 
                    sum(valor10) * -1 as mar, 
                    sum(valor11) * -1 as apr, 
                    sum(valor12) * -1 as may, 
                    sum(valor13) * -1 as jun, 
                    sum(valor14) * -1 as jul, 
                    sum(valor15) * -1 as aug,
                    sum(valor16) * -1 as sep, 
                    sum(valor17) * -1 as oct, 
                    sum(valor18) * -1 as nov, 
                    sum(valor19) * -1 as dez,
                    '03' as ordem
            FROM indicador1
            WHERE valor3 = 'RECEITAS FINANCEIRAS TOTAIS'
            GROUP BY valor1, valor2               
            
            UNION                
            
            SELECT 
                    valor1 as empresa, 
                    valor2 as ano, 
                    'LPECSLL' as categoria,
                    'Base Cálculo CSLL (Venda/Remessas) 12%' as descricao, 
                    sum(valor5) * 0.12 as jan,
                    sum(valor6) * 0.12 as feb, 
                    sum(valor7) * 0.12 as mar, 
                    sum(valor8) * 0.12 as apr, 
                    sum(valor9) * 0.12 as may, 
                    sum(valor10) * 0.12 as jun, 
                    sum(valor11) * 0.12 as jul, 
                    sum(valor12) * 0.12 as aug,
                    sum(valor13) * 0.12 as sep, 
                    sum(valor14) * 0.12 as oct, 
                    sum(valor15) * 0.12 as nov, 
                    sum(valor16) * 0.12 as dez,
                    '01' as ordem
            FROM indicador6
            WHERE valor3 = 'RECEITAS OPERACIONAIS' AND (valor4 = 'Devolucao de Vendas' OR valor4 = 'Vendas / Remessa ')
            GROUP BY valor1, valor2, valor3       
            
            UNION
            
            SELECT 
                    valor1 as empresa, 
                    valor2 as ano, 
                    'LPECSLL' as categoria,
                    'Base Cálculo CSLL (Serviços) 32%' as descricao, 
                    sum(valor5) * 0.32 as jan,
                    sum(valor6) * 0.32 as feb, 
                    sum(valor7) * 0.32 as mar, 
                    sum(valor8) * 0.32 as apr, 
                    sum(valor9) * 0.32 as may, 
                    sum(valor10) * 0.32 as jun, 
                    sum(valor11) * 0.32 as jul, 
                    sum(valor12) * 0.32 as aug,
                    sum(valor13) * 0.32 as sep, 
                    sum(valor14) * 0.32 as oct, 
                    sum(valor15) * 0.32 as nov, 
                    sum(valor16) * 0.32 as dez,
                    '02' as ordem
            FROM indicador6
            WHERE valor3 = 'RECEITAS OPERACIONAIS' AND valor4 = 'Receitas Servicos '
            GROUP BY valor1, valor2, valor3
            
            UNION
            
            SELECT 
                    valor1 as empresa, 
                    valor2 as ano, 
                    'LPECSLL' as categoria,
                    'Base Cálculo IRPJ Outras Receitas - 100%' as descricao, 
                    sum(valor5) as jan,
                    sum(valor6) as feb, 
                    sum(valor7) as mar, 
                    sum(valor8) as apr, 
                    sum(valor9) as may, 
                    sum(valor10) as jun, 
                    sum(valor11) as jul, 
                    sum(valor12) as aug,
                    sum(valor13) as sep, 
                    sum(valor14) as oct, 
                    sum(valor15) as nov, 
                    sum(valor16) as dez,
                    '04' as ordem
            FROM indicador6
            WHERE valor3 = 'OUTRAS RECEITAS / DESPESAS'
            GROUP BY valor1, valor2, valor3
            
            UNION
            
            SELECT 
                    valor1 as empresa, 
                    valor2 as ano, 
                    'LPECSLL' as categoria,
                    'Base Cálculo IRPJ Receitas Financeiras - 100%' as descricao, 
                    sum(valor8) * -1 as jan,
                    sum(valor9) * -1 as feb, 
                    sum(valor10) * -1 as mar, 
                    sum(valor11) * -1 as apr, 
                    sum(valor12) * -1 as may, 
                    sum(valor13) * -1 as jun, 
                    sum(valor14) * -1 as jul, 
                    sum(valor15) * -1 as aug,
                    sum(valor16) * -1 as sep, 
                    sum(valor17) * -1 as oct, 
                    sum(valor18) * -1 as nov, 
                    sum(valor19) * -1 as dez,
                    '03' as ordem
            FROM indicador1
            WHERE valor3 = 'RECEITAS FINANCEIRAS TOTAIS'
            GROUP BY valor1, valor2
        ) as sel
        WHERE sel.ano = {$ano} 
            AND sel.empresa = {$empresa_id}
        ORDER BY sel.categoria, sel.ordem, sel.descricao ASC;
                
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
    