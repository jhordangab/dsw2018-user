<?php

namespace app\magic;

use Yii;

class IndicadorBiMagic
{
    public static function getDados($empresa_id, $ano)
    {
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
    
    public static function getDre($empresa_id, $ano)
    {
        $sql = <<<SQL
         
        SELECT * FROM 
        (
            SELECT 
                'E' as local,
                1 as tipo,
                1 as ordem,
                'Receita Operacional Bruta' as descricao,
                SUM(valor17) as valor
            FROM agrocontar_atualizado.indicador6 
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
            FROM agrocontar_atualizado.indicador6 
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
            FROM agrocontar_atualizado.indicador6 
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
                SUM(valor17) as valor
            FROM agrocontar_atualizado.indicador6 
            WHERE valor3 = 'RECEITAS OPERACIONAIS'
                AND valor1 = {$empresa_id}
                AND valor2 = {$ano}
                AND trim(valor4) = 'Impostos s/ Servicos'
                
            UNION ALL
                
            SELECT 
                'E' as local,
                2 as tipo,
                4 as ordem,
                'Despesas Administrativas' as descricao,
                SUM(valor17) as valor
            FROM agrocontar_atualizado.indicador6 
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
            FROM agrocontar_atualizado.indicador6 
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
            FROM agrocontar_atualizado.indicador6 
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
            FROM agrocontar_atualizado.indicador6 
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
}
    