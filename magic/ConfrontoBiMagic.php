<?php

namespace app\magic;

use Yii;
use app\models\AdminEmpresa;

class ConfrontoBiMagic
{
    public static function get($model)
    {
        $empresa = AdminEmpresa::findOne($model->empresa_id);
        $empresa_nome = $empresa->nomeResumo;
        
//        ----
        
        $ano_x = $model->ano_x;
        $meses_x = implode(',', $model->meses_x);
        $sum_x = "";
        
        foreach($model->meses_x as $index => $mx)
        {
            $column = $mx + 4;
            $sum_x .= ($index > 0) ? " + " : "";
            $sum_x .= " SUM(valor{$column}) ";
        }
        
        $sum_x .= ' as valor';
        
//        ----
        
        $ano_y = $model->ano_y;
        $meses_y = implode(',', $model->meses_x);
        $sum_y = "";
        
        foreach($model->meses_y as $index => $my)
        {
            $column = $my + 4;
            $sum_y .= ($index > 0) ? " + " : "";
            $sum_y .= " SUM(valor{$column}) ";
        }
        
        $sum_y .= ' as valor';

//        ----

        $sql = <<<SQL
         
        SELECT 
            sel.categoria,
            sel.empresa,
            sel.descricao,
            CASE WHEN sel.ano = {$ano_x} 
                THEN sel.valor 
                ELSE 0
            END as ano_x,
            CASE WHEN sel.ano = {$ano_y} 
                THEN sel.valor 
                ELSE 0
            END as ano_y
        FROM 
        (
            	SELECT 
                        'RO' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        {$sum_x}
                FROM indicador6
                WHERE valor3 = 'RECEITAS OPERACIONAIS' AND valor1 = {$empresa_nome} and valor2 = {$ano_x}
                GROUP BY valor1, valor2, valor3, valor4

            UNION

                SELECT 
                        'RO' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        {$sum_y}
                FROM indicador6
                WHERE valor3 = 'RECEITAS OPERACIONAIS' AND valor1 = {$empresa_nome} and valor2 = {$ano_y}
                GROUP BY valor1, valor2,  valor3, valor4

            UNION ALL

                SELECT 
                        'CMV' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        {$sum_x}
                FROM indicador6
                WHERE valor3 = 'CMV' AND valor1 = {$empresa_nome} and valor2 = {$ano_x}
                GROUP BY valor1, valor2, valor3, valor4

            UNION

                SELECT 
                        'CMV' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        {$sum_y}
                FROM indicador6
                WHERE valor3 = 'CMV' AND valor1 = {$empresa_nome} and valor2 = {$ano_y}
                GROUP BY valor1, valor2,  valor3, valor4

             UNION ALL

                SELECT 
                        'DO' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        {$sum_x}
                FROM indicador6
                WHERE valor3 = 'DESPESAS OPERACIONAIS' AND valor1 = {$empresa_nome} and valor2 = {$ano_x}
                GROUP BY valor1, valor2, valor3, valor4

            UNION

                SELECT 
                        'DO' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        {$sum_y}
                FROM indicador6
                WHERE valor3 = 'DESPESAS OPERACIONAIS' AND valor1 = {$empresa_nome} and valor2 = {$ano_y}
                GROUP BY valor1, valor2,  valor3, valor4

            UNION ALL

                SELECT 
                        'RF' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        {$sum_x}
                FROM indicador6
                WHERE valor3 = 'RESULTADO FINANCEIRO' AND valor1 = {$empresa_nome} and valor2 = {$ano_x}
                GROUP BY valor1, valor2, valor3, valor4

            UNION

                SELECT 
                        'RF' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        {$sum_y}
                FROM indicador6
                WHERE valor3 = 'RESULTADO FINANCEIRO' AND valor1 = {$empresa_nome} and valor2 = {$ano_y}
                GROUP BY valor1, valor2,  valor3, valor4

            UNION ALL

                SELECT 
                        'ODR' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        {$sum_x}
                FROM indicador6
                WHERE valor3 = 'OUTRAS RECEITAS / DESPESAS' AND valor1 = {$empresa_nome} and valor2 = {$ano_x}
                GROUP BY valor1, valor2, valor3, valor4

            UNION

                SELECT 
                        'ODR' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        {$sum_y}
                FROM indicador6
                WHERE valor3 = 'OUTRAS RECEITAS / DESPESAS' AND valor1 = {$empresa_nome} and valor2 = {$ano_y}
                GROUP BY valor1, valor2,  valor3, valor4

            UNION ALL

                SELECT 
                        'RES' as categoria,
                        ab.empresa_nome,
                        ab.ano,
                        'Imposto de Renda + Csll' as descricao,
                        SUM(abv.valor) as valor
                FROM balancete_valor abv
                LEFT JOIN balancete ab on ab.id = abv.balancete_id and ab.status = 'V'
                LEFT JOIN categoria_padrao acp on acp.codigo = abv.categoria_id AND acp.is_excluido = 0 AND acp.is_ativo = 1
                WHERE abv.categoria_id in (1134010008, 1134010009)
                        AND abv.is_excluido = 0
                AND ab.is_excluido = 0
                        AND ab.is_ativo = 1
                        AND abv.is_ativo = 1
                        AND ab.empresa_nome = {$empresa_nome}
                        AND ab.ano = {$ano_x}
                        AND ab.mes in ({$meses_x})
                GROUP BY ab.empresa_nome, ab.ano

                UNION

                SELECT 
                        'RES' as categoria,
                        ab.empresa_nome,
                        ab.ano,
                        'Imposto de Renda + Csll' as descricao,
                        SUM(abv.valor) as valor
                FROM balancete_valor abv
                LEFT JOIN balancete ab on ab.id = abv.balancete_id and ab.status = 'V'
                LEFT JOIN categoria_padrao acp on acp.codigo = abv.categoria_id AND acp.is_excluido = 0 AND acp.is_ativo = 1
                WHERE abv.categoria_id in (1134010008, 1134010009)
                        AND abv.is_excluido = 0
                AND ab.is_excluido = 0
                        AND ab.is_ativo = 1
                        AND abv.is_ativo = 1
                        AND ab.ano = {$ano_y}
                        AND ab.mes in ({$meses_y})
                GROUP BY ab.empresa_nome, ab.ano

        ) as sel
                
SQL;
        $dados = [];
        $results = Yii::$app->db->createCommand($sql)->QueryAll();

        foreach($results as $result)
        {
            $dados[$result['categoria']][$result['descricao']]['categoria'] = $result['categoria'];
            $dados[$result['categoria']][$result['descricao']]['empresa'] = $result['empresa'];
            $dados[$result['categoria']][$result['descricao']]['descricao'] = $result['descricao'];
            if(isset($dados[$result['categoria']][$result['descricao']]['ano_x']))
            {
                $dados[$result['categoria']][$result['descricao']]['ano_x'] += $result['ano_x'];
            }
            else
            {
                $dados[$result['categoria']][$result['descricao']]['ano_x'] = $result['ano_x'];
            }
            
            if(isset($dados[$result['categoria']][$result['descricao']]['ano_y']))
            {
                $dados[$result['categoria']][$result['descricao']]['ano_y'] += $result['ano_y'];
            }
            else
            {
                $dados[$result['categoria']][$result['descricao']]['ano_y'] = $result['ano_y'];
            }
        }
        
        return $dados;
    }
}
    