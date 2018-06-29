<?php

namespace app\magic;

use app\models\AdminEmpresa;
use Yii;

class IndicadorBiMagic
{
    public static function getDados($model)
    {
        $empresa = AdminEmpresa::findOne($model->empresa_id);
        $empresa_id = $empresa->nomeResumo;
        
        $ano = $model->ano;

        $sql = <<<SQL
         
        SELECT * FROM 
        (
            SELECT 
                1 as ordemExterna,
                'Ativo' as categoria,
                bal.descricao,
                bal.titulo as titulo, 
                bal.valor as valor,
                bal.ordemDescricao as ordemDescricao,
                bal.ordemInterna as ordemInterna
            FROM 
            (
                SELECT 
                    1 as ordemDescricao,
                    'Ativo Circulante' as descricao,
                    1 as ordemInterna,
                    'Disponibilidade' as titulo,
                    SUM(valor17) as valor
                FROM indicador14 
                WHERE valor26 IN ('1.1.1.1.01', '1.1.1.2.01')
                AND valor1 = {$empresa_id} 
                AND valor2 = {$ano}
                
                UNION ALL
                
                SELECT 
                    1 as ordemDescricao,
                    'Ativo Circulante' as descricao,
                    2 as ordemInterna,
                    'Aplicações Financeiras' as titulo,
                    SUM(valor17) as valor
                FROM indicador14 
                WHERE valor26 = '1.1.1.3.01'
                AND valor1 = {$empresa_id} 
                AND valor2 = {$ano}
                
                UNION ALL
                
                SELECT 
                    1 as ordemDescricao,
                    'Ativo Circulante' as descricao,
                    3 as ordemInterna,
                    'Contas a Receber' as titulo,
                    SUM(valor17) as valor
                FROM indicador14 
                WHERE valor26 IN 
                (
                    '1.1.1.4.01',   
                    '1.1.1.5.01',   
                    '1.1.2.1.01',   
                    '1.1.2.1.02',   
                    '1.1.2.1.10',   
                    '1.1.2.1.13',   
                    '1.1.2.1.15',   
                    '1.1.2.1.17',   
                    '1.1.2.1.20',   
                    '1.1.2.1.30',   
                    '1.1.2.1.50'   
                )
                AND valor1 = {$empresa_id} 
                AND valor2 = {$ano}
                
                UNION ALL
                
                SELECT 
                    1 as ordemDescricao,
                    'Ativo Circulante' as descricao,
                    4 as ordemInterna,
                    'Estoques' as titulo,
                    SUM(valor17) as valor
                FROM indicador14 
                WHERE valor26 IN 
                (
                    '1.1.5.1.01',   
                    '1.1.5.3.01',   
                    '1.1.5.3.02',   
                    '1.1.5.3.03',   
                    '1.1.5.3.11',   
                    '1.1.5.3.12',   
                    '1.1.5.3.13',   
                    '1.1.5.4.01',   
                    '1.1.5.4.02',   
                    '1.1.5.5.01',   
                    '1.1.5.6.01',   
                    '1.1.5.8.01'   
                )
                AND valor1 = {$empresa_id} 
                AND valor2 = {$ano}
                
                UNION ALL
                
                SELECT 
                    1 as ordemDescricao,
                    'Ativo Circulante' as descricao,
                    5 as ordemInterna,
                    'Outros' as titulo,
                    SUM(valor17) as valor
                FROM indicador14 
                WHERE valor26 IN 
                (
                    '1.1.3.1.01',  
                    '1.1.3.1.02',   
                    '1.1.3.1.03',   
                    '1.1.3.1.04',   
                    '1.1.3.1.05',   
                    '1.1.3.1.06',   
                    '1.1.3.1.07',   
                    '1.1.3.1.08',   
                    '1.1.3.1.09',   
                    '1.1.3.1.10',
                    '1.1.3.2.01',   
                    '1.1.3.2.02',   
                    '1.1.3.2.10',   
                    '1.1.3.3.01',   
                    '1.1.3.4.01',   
                    '1.1.3.4.02',   
                    '1.1.3.5.01',   
                    '1.1.3.5.03',   
                    '1.1.3.5.04',   
                    '1.1.3.5.05',   
                    '1.1.4.1.01',   
                    '1.1.4.1.02',   
                    '1.1.4.1.03',
                    '1.1.7.1.01',   
                    '1.1.7.1.03',   
                    '1.1.7.1.04',   
                    '1.1.7.1.05',   
                    '1.1.7.1.06',
                    '1.1.7.1.07'
                )
                AND valor1 = {$empresa_id} 
                AND valor2 = {$ano}
                
                UNION ALL
                
                SELECT 
                    2 as ordemDescricao,
                    'Ativo não Circulante' as descricao,
                    1 as ordemInterna,
                    '' as titulo,
                    SUM(valor17) as valor
                FROM indicador14 
                WHERE valor26 IN 
                (
                    '1.2.1.1.01', 
                    '1.2.1.1.02',   
                    '1.2.1.1.03',   
                    '1.2.1.1.04',   
                    '1.2.1.1.05',   
                    '1.2.1.1.06',   
                    '1.2.1.1.07',   
                    '1.2.1.1.08',   
                    '1.2.1.1.09',   
                    '1.2.1.1.10',   
                    '1.2.1.1.11',   
                    '1.2.1.1.12',   
                    '1.2.1.1.13',   
                    '1.2.1.1.14',   
                    '1.2.1.2.01',   
                    '1.2.1.2.02',   
                    '1.2.1.2.03',   
                    '1.2.1.3.01',   
                    '1.2.1.4.01',   
                    '1.2.2.1.01',   
                    '1.2.2.1.02',   
                    '1.2.2.1.03',   
                    '1.2.2.1.04',   
                    '1.2.2.1.05',   
                    '1.2.2.1.06',   
                    '1.2.2.1.07',   
                    '1.2.2.2.01',   
                    '1.2.2.2.02',   
                    '1.2.2.3.01'   
                )
                AND valor1 = {$empresa_id} 
                AND valor2 = {$ano}
                
                UNION ALL
                
                SELECT 
                    3 as ordemDescricao,
                    'Ativo Permanente' as descricao,
                    1 as ordemInterna,
                    '' as titulo,
                    SUM(valor17) as valor
                FROM indicador14 
                WHERE valor26 IN 
                (
                    '1.2.3.1.01',  
                    '1.2.3.1.02',   
                    '1.2.3.2.01',   
                    '1.2.3.2.02',   
                    '1.2.3.3.01',   
                    '1.2.3.3.02',   
                    '1.2.3.3.03',   
                    '1.2.3.3.04',   
                    '1.2.3.3.05',   
                    '1.2.4.1.01',   
                    '1.2.4.2.01'     
                )
                AND valor1 = {$empresa_id} 
                AND valor2 = {$ano}
                
            ) as bal

            UNION ALL

            SELECT 
                2 as ordemExterna,
                'Passivo' as categoria,
                bal.descricao,
                bal.titulo as titulo, 
                bal.valor as valor,
                bal.ordemDescricao as ordemDescricao,
                bal.ordemInterna as ordemInterna
            FROM 
            (
                SELECT 
                    1 as ordemDescricao,
                    'Passivo Circulante' as descricao,
                    1 as ordemInterna,
                    'Fornecedores' as titulo,
                    SUM(valor17) as valor
                FROM indicador14 
                WHERE valor26 = '2.1.1.1.02'
                AND valor1 = {$empresa_id} 
                AND valor2 = {$ano}
                
                UNION ALL
                
                SELECT 
                    1 as ordemDescricao,
                    'Passivo Circulante' as descricao,
                    2 as ordemInterna,
                    'Empréstimos/Financiam.' as titulo,
                    SUM(valor17) as valor
                FROM indicador14 
                WHERE valor26 = '2.1.1.1.04'
                AND valor1 = {$empresa_id} 
                AND valor2 = {$ano}
                
                UNION ALL
                
                SELECT 
                    1 as ordemDescricao,
                    'Passivo Circulante' as descricao,
                    3 as ordemInterna,
                    'Impostos a Recolher' as titulo,
                    SUM(valor17) as valor
                FROM indicador14 
                WHERE valor26 = '2.1.1.1.03'
                AND valor1 = {$empresa_id} 
                AND valor2 = {$ano}
                
                UNION ALL
                
                SELECT 
                    1 as ordemDescricao,
                    'Passivo Circulante' as descricao,
                    4 as ordemInterna,
                    'Salários e Contribuições' as titulo,
                    SUM(valor17) as valor
                FROM indicador14 
                WHERE valor26 = '2.1.1.1.01'
                AND valor1 = {$empresa_id} 
                AND valor2 = {$ano}
                
                UNION ALL
                
                SELECT 
                    1 as ordemDescricao,
                    'Passivo Circulante' as descricao,
                    5 as ordemInterna,
                    'Outros' as titulo,
                    SUM(valor17) as valor
                FROM indicador14 
                WHERE valor26 IN
                (
                    '2.1.1.1.05',   
                    '2.1.1.1.06',   
                    '2.1.1.1.07',   
                    '2.1.1.2.01'
                )
                AND valor1 = {$empresa_id} 
                AND valor2 = {$ano}
                
                UNION ALL
                
                SELECT 
                    2 as ordemDescricao,
                    'Passivo não Circulante' as descricao,
                    1 as ordemInterna,
                    '' as titulo,
                    SUM(valor17) as valor
                FROM indicador14 
                WHERE valor26 IN
                (
                    '2.2.1.1.01',   
                    '2.2.1.1.02',   
                    '2.2.1.1.03',   
                    '2.2.1.1.04',   
                    '2.2.1.1.05',   
                    '2.2.1.1.06',   
                    '2.2.1.1.07',   
                    '2.2.1.1.08',   
                    '2.2.1.1.09'   
                )
                AND valor1 = {$empresa_id} 
                AND valor2 = {$ano}
                
                UNION ALL
                
                SELECT 
                    3 as ordemDescricao,
                    'Patrimonio Líquido' as descricao,
                    1 as ordemInterna,
                    '' as titulo,
                    SUM(valor17) as valor
                FROM indicador14 
                WHERE valor26 IN
                (
                    '2.3.1.1.01',   
                    '2.3.1.1.02',   
                    '2.3.1.1.03',   
                    '2.3.1.1.04',   
                    '2.3.1.1.05',   
                    '2.3.1.1.06',   
                    '2.7.1.1.01',   
                    '2.7.1.1.05',   
                    '2.7.1.1.08'   
                )
                AND valor1 = {$empresa_id} 
                AND valor2 = {$ano}
                
            ) as bal
                
        ) as sel 
        ORDER BY sel.ordemExterna, sel.ordemDescricao, sel.ordemInterna ASC;
             
SQL;
        
        $dados = [];
        $results = Yii::$app->db->createCommand($sql)->QueryAll();
        
        foreach($results as $result)
        {
            $dados[$result['categoria']][] = $result;
        }
                
        return $dados;
    }
    
    public static function getDre($model)
    {
        $empresa = AdminEmpresa::findOne($model->empresa_id);
        $empresa_id = $empresa->nomeResumo;
        
        $ano = $model->ano;
        
        $sql = <<<SQL
         
        SELECT * FROM 
        (
            SELECT 
                'E' as local,
                1 as tipo,
                1 as ordem,
                'Receita Operacional Bruta' as descricao,
                SUM(valor17) as valor
            FROM indicador6 
            WHERE valor3 = 'RECEITAS OPERACIONAIS'
                AND valor1 = {$empresa_id}
                AND valor2 = {$ano}
                AND trim(valor4) IN ('Vendas / Remessa', 'Receitas Servicos')
                
            UNION ALL
                
            SELECT 
                'E' as local,
                2 as tipo,
                2 as ordem,
                'Deduções sobre Vendas' as descricao,
                SUM(valor17) as valor
            FROM indicador6 
            WHERE valor3 = 'RECEITAS OPERACIONAIS'
                AND valor1 = {$empresa_id}
                AND valor2 = {$ano}
                AND trim(valor4) IN ('Devolucao de Vendas', 'Impostos s/ Vendas/Remessas', 'Impostos s/ Servicos')
                
            UNION ALL
                
            SELECT 
                'E' as local,
                2 as tipo,
                3 as ordem,
                'Custos de Mercadorias Vendidas' as descricao,
                SUM(valor17) as valor
            FROM indicador6 
            WHERE valor3 = 'CMV'
                AND valor1 = {$empresa_id}
                AND valor2 = {$ano}
                AND trim(valor4) = 'Custo das Mercadorias Vendidas'
                
            UNION ALL
                
            SELECT 
                'D' as local,
                1 as tipo,
                1 as ordem,
                'Depreciação' as descricao,
                SUM((valor5 + valor6 + valor7 + valor8 + valor9 + valor10 + valor11 + 
                valor12 + valor13 + valor14 + valor15 + valor16)) as total
            FROM indicador8
            WHERE valor1 = {$empresa_id}
            AND valor2 = {$ano}
            AND valor4 = 'Depreciacao e Amortizacao'
            GROUP BY valor1, valor2, valor4
                
            UNION ALL
                
            SELECT 
                'E' as local,
                2 as tipo,
                4 as ordem,
                'Despesas Administrativas' as descricao,
                SUM(valor17) as valor
            FROM indicador6 
            WHERE valor3 = 'DESPESAS OPERACIONAIS'
                AND valor1 = {$empresa_id}
                AND valor2 = {$ano}
                
            UNION ALL
                
            SELECT 
                'E' as local,
                2 as tipo,
                5 as ordem,
                'Despesas Financeiras' as descricao,
                SUM(valor17) as valor
            FROM indicador6 
            WHERE valor3 = 'RESULTADO FINANCEIRO'
                AND valor1 = {$empresa_id}
                AND valor2 = {$ano}
                AND trim(valor4) = 'Despesas Financeiras'
                
            UNION ALL
                
            SELECT 
                'E' as local,
                2 as tipo,
                6 as ordem,
                'Receitas Financeiras' as descricao,
                SUM(valor17) as valor
            FROM indicador6 
            WHERE valor3 = 'RESULTADO FINANCEIRO'
                AND valor1 = {$empresa_id}
                AND valor2 = {$ano}
                AND trim(valor4) = 'Receitas Financeiras'
                
            UNION ALL
                
            SELECT 
                'E' as local,
                2 as tipo,
                7 as ordem,
                'Outras Receitas/Despesas' as descricao,
                SUM(valor17) as valor
            FROM indicador6 
            WHERE valor3 = 'OUTRAS RECEITAS / DESPESAS'
                AND valor1 = {$empresa_id}
                AND valor2 = {$ano}
                
        ) as sel 
        ORDER BY sel.local, sel.ordem;
             
SQL;
        
        $dados = [];
        $results = Yii::$app->db->createCommand($sql)->QueryAll();
        
        foreach($results as $result)
        {
            $dados[$result['local']][$result['ordem']] = $result;
        }
                        
        return $dados;
    }
    
    public static function getProvisao($model)
    {
        $empresa = AdminEmpresa::findOne($model->empresa_id);
        $empresa_id = $empresa->nomeResumo;
        
        $ano = $model->ano;
        
        $sql = <<<SQL
         
        SELECT
        res.*
        FROM
        (
            SELECT 
            'subtotal' as resultado,
            sel.empresa,
            sel.ano,
            sel.categoria,
            SUM(CASE
                WHEN categoria in('LL', 'AD') THEN jan
                WHEN categoria = 'EX' THEN (jan * -1)
                ELSE 0
            END) as jan,
            SUM(CASE
                WHEN categoria in('LL', 'AD') THEN feb
                WHEN categoria = 'EX' THEN (feb * -1)
                ELSE 0
            END) as feb,
            SUM(CASE
                WHEN categoria in('LL', 'AD') THEN mar
                WHEN categoria = 'EX' THEN (mar * -1)
                ELSE 0
            END) as mar,
            SUM(CASE
                WHEN categoria in('LL', 'AD') THEN apr
                WHEN categoria = 'EX' THEN (apr * -1)
                ELSE 0
            END) as apr,
            SUM(CASE
                WHEN categoria in('LL', 'AD') THEN may
                WHEN categoria = 'EX' THEN (may * -1)
                ELSE 0
            END) as may,
            SUM(CASE
                WHEN categoria in('LL', 'AD') THEN jun
                WHEN categoria = 'EX' THEN (jun * -1)
                ELSE 0
            END) as jun,
            SUM(CASE
                WHEN categoria in('LL', 'AD') THEN jul
                WHEN categoria = 'EX' THEN (jul * -1)
                ELSE 0
            END) as jul,
            SUM(CASE
                WHEN categoria in('LL', 'AD') THEN aug
                WHEN categoria = 'EX' THEN (aug * -1)
                ELSE 0
            END) as aug,
            SUM(CASE
                WHEN categoria in('LL', 'AD') THEN sep
                WHEN categoria = 'EX' THEN (sep * -1)
                ELSE 0
            END) as sep,
            SUM(CASE
                WHEN categoria in('LL', 'AD') THEN oct
                WHEN categoria = 'EX' THEN (oct * -1)
                ELSE 0
            END) as oct,
            SUM(CASE
                WHEN categoria in('LL', 'AD') THEN nov
                WHEN categoria = 'EX' THEN (nov * -1)
                ELSE 0
            END) as nov,
            SUM(CASE
                WHEN categoria in('LL', 'AD') THEN dez
                WHEN categoria = 'EX' THEN (dez * -1)
                ELSE 0
            END) as dez
            FROM 
            (
                SELECT 
                    valor1 as empresa, 
                    valor2 as ano, 
                    'LL' as categoria,
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
                    valor15 as dez
                FROM indicador7               

                UNION  ALL              

                SELECT 
                    valor1 as empresa, 
                    valor2 as ano, 
                    valor3 as categoria,
                    valor5 as jan,
                    valor5 + valor6 as feb, 
                    valor5 + valor6 + valor7 as mar, 
                    valor5 + valor6 + valor7 + valor8 as apr, 
                    valor5 + valor6 + valor7 + valor8 + valor9 as may, 
                    valor5 + valor6 + valor7 + valor8 + valor9 + valor10 as jun, 
                    valor5 + valor6 + valor7 + valor8 + valor9 + valor10 + valor11 as jul, 
                    valor5 + valor6 + valor7 + valor8 + valor9 + valor10 + valor11 + valor12 as aug,
                    valor5 + valor6 + valor7 + valor8 + valor9 + valor10 + valor11 + valor12 + valor13 as sep, 
                    valor5 + valor6 + valor7 + valor8 + valor9 + valor10 + valor11 + valor12 + valor13 + valor14 as oct, 
                    valor5 + valor6 + valor7 + valor8 + valor9 + valor10 + valor11 + valor12 + valor13 + valor14 + valor15 as nov, 
                    valor5 + valor6 + valor7 + valor8 + valor9 + valor10 + valor11 + valor12 + valor13 + valor14 + valor15 + valor16 as dez
                FROM indicador16
                WHERE valor3 not in ('COMPIR', 'COMPCS', 'BCCS', 'BCIRPJ')
            ) as sel
            WHERE sel.ano = {$ano}  
                AND sel.empresa = {$empresa_id} 
                GROUP BY sel.empresa, sel.ano, sel.categoria
            
            UNION ALL 

            SELECT 
                'compensacao' as resultado,
                valor1 as empresa, 
                valor2 as ano, 
                valor3 as categoria,
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
                valor16 as dez
            FROM indicador16
            WHERE valor3 IN ('COMPIR', 'COMPCS')
            AND valor2 = {$ano} 
            AND valor1 = {$empresa_id}
            GROUP BY valor1, valor2
            
            UNION ALL 

            SELECT 
                'base' as resultado,
                valor1 as empresa, 
                valor2 as ano, 
                valor3 as categoria,
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
                valor16 as dez
            FROM indicador16
            WHERE valor3 IN ('BCCS', 'BCIRPJ')
            AND valor2 = {$ano} 
            AND valor1 = {$empresa_id}
            GROUP BY valor1, valor2
            
            UNION ALL 
            
            SELECT 
                'base' as resultado,
                valor1 as empresa, 
                valor2 as ano, 
                'Imposto de Renda Recolhido em meses anteriores' as categoria,
                0 as jan,
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
                valor15 as dez
            FROM indicador2
            WHERE valor3 = '1.1.3.4.01.0008'
            AND valor2 = {$ano} 
            AND valor1 = {$empresa_id}
            GROUP BY valor1, valor2
            
        ) as res
             
SQL;
        $meses = 
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
        
        $dados = [];
        
        $results = Yii::$app->db->createCommand($sql)->QueryAll();
        
        foreach($results as $result)
        {
            $dados[$result['resultado']][$result['categoria']] = $result;
        }
                
        $atualizacao_dados = [];
        $total_provisao_cs = $total_previsao_irpj = 0;
        
        for($i = 1; $i <= 12; $i++)
        {
            $lucro_livre = (isset($dados['subtotal']['LL'])) ? $dados['subtotal']['LL'][$meses[$i]] : 0;
            $adicoes = (isset($dados['subtotal']['AD'])) ? $dados['subtotal']['AD'][$meses[$i]] : 0;
            $exclusoes = (isset($dados['subtotal']['EX'])) ? $dados['subtotal']['EX'][$meses[$i]] : 0;
            $comp_base_negativa = (isset($dados['compensacao']['COMPCS'])) ? $dados['compensacao']['COMPCS'][$meses[$i]] : 0;
            $comp_base_irpj = (isset($dados['compensacao']['COMPIR'])) ? $dados['compensacao']['COMPIR'][$meses[$i]] : 0;
            
            $atualizacao_dados[$i] = ($i > 1) ? $atualizacao_dados[$i - 1] + $lucro_livre : $lucro_livre;
            $base_calculo_cs = ($atualizacao_dados[$i] - $comp_base_negativa) + $adicoes - $exclusoes;
            $base_calculo_irpj = ($atualizacao_dados[$i] - $comp_base_irpj) + $adicoes - $exclusoes;
            
            $contribuicao_social_9 = ($base_calculo_cs > 0) ? $base_calculo_cs * 0.09 : 0;
            $imposto_renda_devido = ($base_calculo_irpj > 0) ? $base_calculo_irpj * 0.15 : 0;
            $adicional_imposto_renda = ($base_calculo_irpj > (20000 * $i)) ? ($base_calculo_irpj - (20000 * $i)) * 0.1 : 0;
            $total_imposto = $imposto_renda_devido + $adicional_imposto_renda;
            
            $bases_ccs = $base_irpj = 0;
            
            if(isset($dados['base']))
            {
                foreach($dados['base'] as $val)
                {
                    if($val['categoria'] == 'BCCS')
                    {
                        $bases_ccs -= $val[$meses[$i]];
                    }
                    else
                    {
                        $base_irpj -= $val[$meses[$i]];
                    }
                } 
            }
            
            $total_provisao_cs += (($contribuicao_social_9 + $bases_ccs) > 0) ? $contribuicao_social_9 + $bases_ccs : 0;
            $total_previsao_irpj += (($total_imposto + $base_irpj) > 0) ? $total_imposto + $base_irpj : 0;
        }
        
        return ['provisao_cs' => $total_provisao_cs, 'provisao_irpj' => $total_previsao_irpj];
    }
}
    