<?php

namespace app\magic;

use Yii;

class ConfrontoBiMagic
{
    public static function get($empresa_nome, $ano)
    {
        $ano_anterior = ($ano - 1);
        
        $sql = <<<SQL
         
        SELECT 
            sel.categoria,
            sel.empresa,
            sel.descricao,
            CASE WHEN sel.ano = {$ano} 
                THEN sel.valor 
                ELSE 0
            END as ano_atual,
            CASE WHEN sel.ano = {$ano_anterior} 
                THEN sel.valor 
                ELSE 0
            END as ano_anterior
        FROM 
        (
            	SELECT 
                        'RO' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        SUM(valor5) + SUM(valor6) + SUM(valor7) + SUM(valor8) + SUM(valor9) + SUM(valor10) +
                        SUM(valor11) + SUM(valor12)  + SUM(valor13)  + SUM(valor14) + SUM(valor15) + SUM(valor16) as valor
                FROM indicador6
                WHERE valor3 = 'RECEITAS OPERACIONAIS' AND valor1 = {$empresa_nome} and valor2 = {$ano}
                GROUP BY valor1, valor2, valor3, valor4

            UNION

                SELECT 
                        'RO' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        SUM(valor5) + SUM(valor6) + SUM(valor7) + SUM(valor8) + SUM(valor9) + SUM(valor10) +
                        SUM(valor11) + SUM(valor12)  + SUM(valor13)  + SUM(valor14) + SUM(valor15) + SUM(valor16) as valor
                FROM indicador6
                WHERE valor3 = 'RECEITAS OPERACIONAIS' AND valor1 = {$empresa_nome} and valor2 = {$ano_anterior}
                GROUP BY valor1, valor2,  valor3, valor4

            UNION ALL

                SELECT 
                        'CMV' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        SUM(valor5) + SUM(valor6) + SUM(valor7) + SUM(valor8) + SUM(valor9) + SUM(valor10) +
                        SUM(valor11) + SUM(valor12)  + SUM(valor13)  + SUM(valor14) + SUM(valor15) + SUM(valor16) as valor
                FROM indicador6
                WHERE valor3 = 'CMV' AND valor1 = {$empresa_nome} and valor2 = {$ano}
                GROUP BY valor1, valor2, valor3, valor4

            UNION

                SELECT 
                        'CMV' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        SUM(valor5) + SUM(valor6) + SUM(valor7) + SUM(valor8) + SUM(valor9) + SUM(valor10) +
                        SUM(valor11) + SUM(valor12)  + SUM(valor13)  + SUM(valor14) + SUM(valor15) + SUM(valor16) as valor
                FROM indicador6
                WHERE valor3 = 'CMV' AND valor1 = {$empresa_nome} and valor2 = {$ano_anterior}
                GROUP BY valor1, valor2,  valor3, valor4

             UNION ALL

                SELECT 
                        'DO' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        SUM(valor5) + SUM(valor6) + SUM(valor7) + SUM(valor8) + SUM(valor9) + SUM(valor10) +
                        SUM(valor11) + SUM(valor12)  + SUM(valor13)  + SUM(valor14) + SUM(valor15) + SUM(valor16) as valor
                FROM indicador6
                WHERE valor3 = 'DESPESAS OPERACIONAIS' AND valor1 = {$empresa_nome} and valor2 = {$ano}
                GROUP BY valor1, valor2, valor3, valor4

            UNION

                SELECT 
                        'DO' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        SUM(valor5) + SUM(valor6) + SUM(valor7) + SUM(valor8) + SUM(valor9) + SUM(valor10) +
                        SUM(valor11) + SUM(valor12)  + SUM(valor13)  + SUM(valor14) + SUM(valor15) + SUM(valor16) as valor
                FROM indicador6
                WHERE valor3 = 'DESPESAS OPERACIONAIS' AND valor1 = {$empresa_nome} and valor2 = {$ano_anterior}
                GROUP BY valor1, valor2,  valor3, valor4

            UNION ALL

                SELECT 
                        'RF' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        SUM(valor5) + SUM(valor6) + SUM(valor7) + SUM(valor8) + SUM(valor9) + SUM(valor10) +
                        SUM(valor11) + SUM(valor12)  + SUM(valor13)  + SUM(valor14) + SUM(valor15) + SUM(valor16) as valor
                FROM indicador6
                WHERE valor3 = 'RESULTADO FINANCEIRO' AND valor1 = {$empresa_nome} and valor2 = {$ano}
                GROUP BY valor1, valor2, valor3, valor4

            UNION

                SELECT 
                        'RF' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        SUM(valor5) + SUM(valor6) + SUM(valor7) + SUM(valor8) + SUM(valor9) + SUM(valor10) +
                        SUM(valor11) + SUM(valor12)  + SUM(valor13)  + SUM(valor14) + SUM(valor15) + SUM(valor16) as valor
                FROM indicador6
                WHERE valor3 = 'RESULTADO FINANCEIRO' AND valor1 = {$empresa_nome} and valor2 = {$ano_anterior}
                GROUP BY valor1, valor2,  valor3, valor4

            UNION ALL

                SELECT 
                        'ODR' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        SUM(valor5) + SUM(valor6) + SUM(valor7) + SUM(valor8) + SUM(valor9) + SUM(valor10) +
                        SUM(valor11) + SUM(valor12)  + SUM(valor13)  + SUM(valor14) + SUM(valor15) + SUM(valor16) as valor
                FROM indicador6
                WHERE valor3 = 'OUTRAS RECEITAS / DESPESAS' AND valor1 = {$empresa_nome} and valor2 = {$ano}
                GROUP BY valor1, valor2, valor3, valor4

            UNION

                SELECT 
                        'ODR' as categoria,
                        valor1 as empresa, 
                        valor2 as ano, 
                        valor4 as descricao,
                        SUM(valor5) + SUM(valor6) + SUM(valor7) + SUM(valor8) + SUM(valor9) + SUM(valor10) +
                        SUM(valor11) + SUM(valor12)  + SUM(valor13)  + SUM(valor14) + SUM(valor15) + SUM(valor16) as valor
                FROM indicador6
                WHERE valor3 = 'OUTRAS RECEITAS / DESPESAS' AND valor1 = {$empresa_nome} and valor2 = {$ano_anterior}
                GROUP BY valor1, valor2,  valor3, valor4

            UNION ALL

                SELECT 
                        'RES' as categoria,
                        ab.empresa_nome,
                        ab.ano,
                        'Imposto de Renda + Csll' as descricao,
                        SUM(abv.valor) as valor
                FROM agrocontar.balancete_valor abv
                LEFT JOIN agrocontar.balancete ab on ab.id = abv.balancete_id and ab.status = 'V'
                LEFT JOIN agrocontar.categoria_padrao acp on acp.codigo = abv.categoria_id AND acp.is_excluido = 0 AND acp.is_ativo = 1
                WHERE abv.categoria_id in (1134010008, 1134010009)
                        AND abv.is_excluido = 0
                AND ab.is_excluido = 0
                        AND ab.is_ativo = 1
                        AND abv.is_ativo = 1
                        AND ab.empresa_nome = {$empresa_nome}
                        AND ab.ano = {$ano}
                GROUP BY ab.empresa_nome, ab.ano

                UNION

                SELECT 
                        'RES' as categoria,
                        ab.empresa_nome,
                        ab.ano,
                        'Imposto de Renda + Csll' as descricao,
                        SUM(abv.valor) as valor
                FROM agrocontar.balancete_valor abv
                LEFT JOIN agrocontar.balancete ab on ab.id = abv.balancete_id and ab.status = 'V'
                LEFT JOIN agrocontar.categoria_padrao acp on acp.codigo = abv.categoria_id AND acp.is_excluido = 0 AND acp.is_ativo = 1
                WHERE abv.categoria_id in (1134010008, 1134010009)
                        AND abv.is_excluido = 0
                AND ab.is_excluido = 0
                        AND ab.is_ativo = 1
                        AND abv.is_ativo = 1
                        AND ab.empresa_nome = {$empresa_nome}
                        AND ab.ano = {$ano_anterior}
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
            if(isset($dados[$result['categoria']][$result['descricao']]['ano_anterior']))
            {
                $dados[$result['categoria']][$result['descricao']]['ano_anterior'] += $result['ano_anterior'];
            }
            else
            {
                $dados[$result['categoria']][$result['descricao']]['ano_anterior'] = $result['ano_anterior'];
            }
            
            if(isset($dados[$result['categoria']][$result['descricao']]['ano_atual']))
            {
                $dados[$result['categoria']][$result['descricao']]['ano_atual'] += $result['ano_atual'];
            }
            else
            {
                $dados[$result['categoria']][$result['descricao']]['ano_atual'] = $result['ano_atual'];
            }
        }
        
        return $dados;
    }
}
    