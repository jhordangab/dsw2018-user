<?php

$css = <<<CSS
    
    .table.table-indicador
    {
        background-color: #dbe7c4;
        border: 1px solid black;
    }
        
    .table.table-indicador > tbody > tr > th,
    .table.table-cleaned > tbody > tr > th
    {
        border-top: none;
        font-weight: 400;
    }
        
CSS;

$this->registerCss($css);

$valor_ativo = $valor_ativo_circulante = 0;
$dados_ativo_circulante = [];
$ativo_nao_circulante = ['nome' => 'Ativo não Circulante', 'valor' => 0];
$ativo_permanente = ['nome' => 'Ativo não Circulante', 'valor' => 0];

foreach($dados['Ativo'] as $ativo)
{
    $valor_ativo += $ativo['valor'];
    
    switch($ativo['descricao'])
    {
        case 'Ativo Circulante':
            $valor_ativo_circulante += $ativo['valor'];
            $dados_ativo_circulante[] = ['nome' => $ativo['titulo'], 'valor' => $ativo['valor']];
            break;
        case 'Ativo não Circulante':
            $ativo_nao_circulante['valor'] = $ativo['valor'];
            break;
        case 'Ativo Permanente':
            $ativo_permanente['valor'] = $ativo['valor'];
            break;
    }
}

$valor_passivo = $valor_passivo_circulante = 0;
$dados_passivo_circulante = [];
$passivo_nao_circulante = ['nome' => 'Pasivo não Circulante', 'valor' => 0];
$patrimonio_liquido = ['nome' => 'Patrimônio Líquido', 'valor' => 0];

foreach($dados['Passivo'] as $ativo)
{
    $valor_passivo += $ativo['valor'];
    
    switch($ativo['descricao'])
    {
        case 'Passivo Circulante':
            $valor_passivo_circulante += $ativo['valor'];
            $dados_passivo_circulante[] = ['nome' => $ativo['titulo'], 'valor' => $ativo['valor']];
            break;
        case 'Passivo não Circulante':
            $passivo_nao_circulante['valor'] = $ativo['valor'];
            break;
        case 'Patrimonio Líquido':
            $patrimonio_liquido['valor'] = $ativo['valor'];
            break;
    }
}

?>

<div class="col-lg-12">
    
    <div class="col-lg-6">
        
        <table class="table table-indicador table-condensed">

            <tbody>

                <tr>

                    <th scope="col" colspan="4"><b>ATIVO</b></th>
                    <th scope="col"><b>R$ <?= number_format($valor_ativo, 2, ',', '.') ?></b></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="3">Ativo Circulante</th>
                    <th scope="col">R$ <?= number_format($valor_ativo_circulante, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <?php foreach($dados_ativo_circulante as $dac) : ?>
                
                    <tr>

                        <th scope="col"></th>
                        <th scope="col"><?= $dac['nome'] ?></th>
                        <th scope="col">R$ <?= number_format($dac['valor'], 2, ',', '.') ?></th>
                        <th scope="col"></th>
                        <th scope="col"></th>

                    </tr>
                
                <?php endforeach; ?>
                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="2">Ativo não Circulante</th>
                    <th scope="col">R$ <?= number_format($ativo_nao_circulante['valor'], 2, ',', '.') ?></th>
                    <th scope="col">R$ <?= number_format($ativo_nao_circulante['valor'], 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="2">Ativo Permanente</th>
                    <th scope="col">R$ <?= number_format($ativo_permanente['valor'], 2, ',', '.') ?></th>
                    <th scope="col">R$ <?= number_format($ativo_permanente['valor'], 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
            </tbody>

        </table>
        
        <table class="table table-indicador table-condensed">

            <tbody>

                <tr>

                    <th scope="col" colspan="4"><b>DRE</b></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>
                    
                    <?php 
                    
                        $rob_valor = isset($dre['E']['1']['valor']) ? $dre['E']['1']['valor'] : 0;
                                
                    ?>

                    <th scope="col">Receita Operacional Bruta</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($rob_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php 
                    
                        $dsv_valor = isset($dre['E']['2']['valor']) ? $dre['E']['2']['valor'] * -1 : 0;
                                
                    ?>

                    <th scope="col" style="padding-left: 30px;">Deduções sobre Vendas</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($dsv_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php 
                    
                        $rol_valor = $rob_valor - $dsv_valor;
                                
                    ?>

                    <th scope="col">Receita Operacional Líquida</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($rol_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php 
                    
                        $cmv_valor = isset($dre['E']['3']['valor']) ? $dre['E']['3']['valor'] : 0;
                                
                    ?>

                    <th scope="col" style="padding-left: 30px;">Custos de Mercadorias Vendidas</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($cmv_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php 
                    
                        $lb_valor = $rol_valor - $cmv_valor;
                                
                    ?>

                    <th scope="col">Lucro Bruto</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($lb_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php 
                    
                        $da_valor = isset($dre['E']['4']['valor']) ? $dre['E']['4']['valor'] : 0;
                        $df_valor = isset($dre['E']['5']['valor']) ? $dre['E']['5']['valor'] : 0;
                        $dof_valor = $da_valor + $df_valor;
                        $depreciacao_valor = isset($dre['D']['1']['valor']) ? $dre['D']['1']['valor'] : 0;
                                
                    ?>

                    <th scope="col">Despesas Operacionais e Financeiras</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($dof_valor, 2, ',', '.') ?></th>
                    <th scope="col">Depreciação</th>

                </tr>
                
                <tr>

                    <th scope="col" style="padding-left: 30px;">Despesas Administrativas</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($da_valor, 2, ',', '.') ?></th>
                    <th scope="col">R$ <?= number_format($depreciacao_valor, 2, ',', '.') ?></th>

                </tr>
                
                <tr>

                    <th scope="col" style="padding-left: 30px;">Despesas Financeiras</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($df_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php 
                    
                        $rf_valor = isset($dre['E']['6']['valor']) ? $dre['E']['6']['valor'] * -1 : 0;
                                
                    ?>

                    <th scope="col" style="padding-left: 30px;">Receitas Financeiras</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($rf_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <?php 
                    
                        $ord_valor = isset($dre['E']['7']['valor']) ? $dre['E']['7']['valor'] : 0;
                                
                    ?>
                    
                    <th scope="col" style="padding-left: 30px;">Outras Receitas/Despesas</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($ord_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php 
                    
                        $pcs_valor = isset($dre['E']['8']['valor']) ? $dre['E']['8']['valor'] : 0;
                                
                    ?>

                    <th scope="col" style="padding-left: 30px;">Provisão CS</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($pcs_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php 
                    
                        $lucro_operacional = $lb_valor - $da_valor - $df_valor + $rf_valor - $ord_valor - $pcs_valor;
                                
                    ?>

                    <th scope="col">Lucro Operacional</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($lucro_operacional, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php 
                    
                        $pir_valor = isset($dre['E']['9']['valor']) ? $dre['E']['9']['valor'] : 0;
                                
                    ?>

                    <th scope="col" style="padding-left: 30px;">Provisão IR</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($pir_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>
                    
                    <?php 
                    
                        $lucro_liquido = $lucro_operacional - $pir_valor;
                                
                    ?>

                    <th scope="col" colspan="2"><b>Lucro Líquido</b></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($lucro_liquido, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
            </tbody>

        </table>
        
        <table class="table table-cleaned table-condensed">

            <tbody>

                <tr>
                    
                    <?php 
                    
                        $porc_air = ($lucro_operacional != 0) ? number_format($pir_valor/$lucro_operacional, 2, ',', '.') . '%' : '0%';
                                
                    ?>

                    <th scope="col" colspan="2">Alíquota do IR</th>
                    <th scope="col">Prov IR</th>
                    <th scope="col">R$ <?= number_format($pir_valor, 2, ',', '.') ?></th>
                    <th scope="col"><?= $porc_air ?></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="2"></th>
                    <th scope="col">Lucro Antes IR</th>
                    <th scope="col">R$ <?= number_format($lucro_operacional, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
            </tbody>

        </table>
        
        <table class="table table-indicador table-condensed">

            <tbody>

                <tr>

                    <th scope="col" colspan="4"><b>CALCULO DO LUCRO OPERACIONAL APÓS O IR </b></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" class="text-center" colspan="5"><b>DRE</b></th>

                </tr>
                
                <tr>

                    <th scope="col">Receita Operacional Bruta</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($rob_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" style="padding-left: 30px;">Deduções sobre Vendas</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($dsv_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col">Receita Operacional Líquida</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($rol_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <th scope="col" style="padding-left: 30px;">Custos de Mercadorias Vendidas</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($cmv_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col">Lucro Bruto</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($lb_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col">Despesas Operacionais e Financeiras</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" style="padding-left: 30px;">Despesas Administrativas</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($da_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" style="padding-left: 30px;">Despesas Financeiras</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($df_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" style="padding-left: 30px;">Receitas Financeiras</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($rf_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <th scope="col" style="padding-left: 30px;">Outras Receitas/Despesas</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($ord_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" style="padding-left: 30px;">Provisão CS</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($pcs_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col">Lucro Operacional</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($lucro_operacional, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" style="padding-left: 30px;">IR s/Lucro</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($pir_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                                
                <tr>
                    
                    <th scope="col" colspan="2">Lucro Operacional após IR</th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($lucro_liquido, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" style="padding-left: 30px;">Despesas Financeiras</th>
                    <th scope="col">R$ <?= number_format($df_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php 
                    
                        $economia_ir_25 = $df_valor * $porc_air;
                        $total_economia = $df_valor - $economia_ir_25;
                    ?>

                    <th scope="col" style="padding-left: 30px;">Economia de Ir 25,28%</th>
                    <th scope="col">R$ <?= number_format($economia_ir_25, 2, ',', '.') ?></th>
                    <th scope="col">R$ <?= number_format($total_economia, 2, ',', '.') ?></th>
                    <th scope="col"></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                   
                    <th scope="col" colspan="2"><b>Lucro Líquido Operacional</b></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($lucro_liquido - $total_economia, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
            </tbody>

        </table>
        
    </div>
    
    <div class="col-lg-6">
        
        <table class="table table-indicador table-condensed">

            <tbody>

                <tr>

                    <th scope="col" colspan="4"><b>PASSIVO</b></th>
                    <th scope="col"><b>R$ <?= number_format($valor_passivo, 2, ',', '.') ?></b></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="3">Passivo Circulante</th>
                    <th scope="col">R$ <?= number_format($valor_passivo_circulante, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <?php foreach($dados_passivo_circulante as $dpc) : ?>
                
                    <tr>

                        <th scope="col"></th>
                        <th scope="col"><?= $dpc['nome'] ?></th>
                        <th scope="col">R$ <?= number_format($dpc['valor'], 2, ',', '.') ?></th>
                        <th scope="col"></th>
                        <th scope="col"></th>

                    </tr>
                
                <?php endforeach; ?>
                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="2">Passivo não Circulante</th>
                    <th scope="col">R$ <?= number_format($passivo_nao_circulante['valor'], 2, ',', '.') ?></th>
                    <th scope="col">R$ <?= number_format($passivo_nao_circulante['valor'], 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="2">Patrimônio Líquido</th>
                    <th scope="col">R$ <?= number_format($patrimonio_liquido['valor'], 2, ',', '.') ?></th>
                    <th scope="col">R$ <?= number_format($patrimonio_liquido['valor'], 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
            </tbody>

        </table>
        
        <table class="table table-indicador table-condensed">

            <tbody>

                <tr>

                    <th scope="col" colspan="4"><b>VALORES DO ATIVO TOTAL E DO INVESTIMENTO</b></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="4">ATIVO TOTAL</th>
                    <th scope="col"><b>R$ <?= number_format($valor_ativo, 2, ',', '.') ?></b></th>

                </tr>
                
                <?php
                
                    $total = 0;
                    
                    foreach($dados_passivo_circulante as $index => $dpc) : ?>
                
                    <?php if($dpc['nome'] != "Empréstimos/Financiam.") : 
                    
                        $total += $dpc['valor'];
                        
                    ?>
                    
                        <tr>

                            <th scope="col"></th>
                            <th scope="col" colspan="2"><?= $dpc['nome'] ?></th>
                            <th scope="col">R$ <?= number_format($dpc['valor'], 2, ',', '.') ?></th>
                            <th scope="col"><?= ($index == sizeof($dados_passivo_circulante) - 1) ? 'R$' . number_format($total, 2, ',', '.') : '' ?></th>
                            <th scope="col"></th>

                        </tr>
                    
                    <?php endif; ?>
                
                <?php endforeach; ?>
                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="2">INVESTIMENTO</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format(($valor_ativo - $total), 2, ',', '.') ?></th>
                    
                </tr>
                
            </tbody>

        </table>
        
        <table class="table table-indicador table-condensed">

            <tbody>

                <tr>

                    <th scope="col" colspan="4"><b>% DE REMUNERAÇÃO CAPITAL PRÓPRIO</b></th>
                    <th scope="col" style="color: blue;"><b><?= ($configuracao) ? $configuracao->custo_capital_proprio . '%' : '?' ?></b></th>

                </tr>
                
            </tbody>

        </table>
        
    </div>
    
</div>

<div class="col-lg-12" style="padding-right: 30px; padding-left: 30px;">
  
    <p><b>Retorno sobre o Patrimonio Líquido / Investimento e Alavancagem Financeira</b></p>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="30%" scope="col" colspan="4">Lucro Operacional</th>
                <th width="10%" scope="col">R$ 335.556,22</th>
                <th width="20%" scope="col">Investimento</th>
                <th width="20%" scope="col">Passivo Oneroso</th>
                <th width="20%" scope="col">Despesas Financeiras</th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col">R$ 335.556,22</th>
                <th width="20%" scope="col">R$ 335.556,22</th>
                <th width="20%" scope="col">R$ 335.556,22</th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Patrimônio Líquido</th>
                <th width="20%" scope="col">Lucro Líquido</th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">R$ 335.556,22</th>
                <th width="20%" scope="col">R$ 335.556,22</th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="40%" scope="col" colspan="4">Retorno sobre investimento <b>ROI</b></th>
                <th width="20%" scope="col">Lucro Operacional</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83%</b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">Investimento - Lucro Líquido</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="40%" scope="col" colspan="4">Retorno sobre o Patrimonio Líquido - RSPL</th>
                <th width="20%" scope="col">Lucro Líquido</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83%</b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">PL - Lucro Liq</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="40%" scope="col" colspan="4">Custo da Divida (ki)</th>
                <th width="20%" scope="col">Despesas Financeiras</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83%</b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">Passivo Oneroso</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="40%" scope="col" colspan="4">Grau de Alavancagem Financeira <b>GAF</b></th>
                <th width="20%" scope="col">RSPL</th>
                <th width="20%" scope="col">-5.55%</th>
                <th width="20%" scope="col"><b>1.83</b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">ROI</th>
                <th width="20%" scope="col">1.83%</th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>

    <p><b>GIRO DO ATIVO/INVESTIMENTO EM FUNÇÃO DAS VENDAS </b></p>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="40%" scope="col" colspan="4">Giro do Ativo</th>
                <th width="20%" scope="col">Receitas Operacionais</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">Ativo Total</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="40%" scope="col" colspan="4">Giro do Investimento</th>
                <th width="20%" scope="col">Receitas Operacionais</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">Investimento - LL</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="40%" scope="col" colspan="4">Margem Operacional</th>
                <th width="20%" scope="col">Lucro Operacional</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">Receitas Operacionais</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th scope="col" colspan="7" style="background-color: #FFF;">Com o objetivo de se analisar melhor os resultados operacionais gerados pelos investimentos, é interessante que se decomponha o ROI da maneira seguinte:</th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4">ROI = margem operacional x Giro do Investimento</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"><b>1.83 =</b></th>
                <th width="20%" scope="col"><b>1.83%</b></th>

            </tr>

        </tbody>

    </table>
    
    <p><b>GIRO DOS RECURSOS PRÓPRIOS</b></p>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="40%" scope="col" colspan="4">Margem líquida</th>
                <th width="20%" scope="col">LL</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">Vendas</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="40%" scope="col" colspan="4">Giro dos Recursos Próprios</th>
                <th width="20%" scope="col">Vendas</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">PL-LL</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th scope="col" colspan="7" style="background-color: #FFF;">Conforme demonstrado, o Retorno sobre o Patrimônio líquido (RSPL) é expresso pela relação entre os resultados líquidos obtidos em determinado período e o capital próprio empregado</th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4">RSPL = margem liquida x Giro dos Recursos Próprios</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"><b>1.83 =</b></th>
                <th width="20%" scope="col"><b>1.83%</b></th>

            </tr>

        </tbody>

    </table>
    
    <p><b>INDICADORES DE COBERTURA DAS EXIGIBILIDADES E DOS JUROS </b></p>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="40%" scope="col" colspan="4">Cobertura de juros </th>
                <th width="20%" scope="col">Lucro Operacional</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">Despesas Financeiras</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th scope="col" colspan="7" style="background-color: #FFF;">EBID indica o resultado operacional antes do imposto de renda e das despesas que não representam movimentações efetivas de caixa (depreciação).  </th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"><b>EBID = Lucro operacional + depreciação</b></th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>R$ 1200,00</b></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>
            
            <tr>

                <th width="40%" scope="col" colspan="4">EBITDA = Lucro Líquido + depreciação - financeiro</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"><b>1.83%</b></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>
            
            <tr>

                <th width="40%" scope="col" colspan="4">VALUATION MÉTODO EBITDA</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col" style="color: blue;"><b>6</b></th>
                <th width="20%" scope="col"><b>R$ 1200,00</b></th>

            </tr>

        </tbody>

    </table>
    
    <p class="text-center"><b>AVALIAÇÃO ANALITICA DE DESEMPENHO ECONÔMICO </b></p>
    
    <p>Formulação Analítica do Desempenho Medido pelo ROI</p>
    
    <table class="table table-cleaned table-condensed" style="border: 1px solid black;">

        <tbody>
            
            <tr>
                <th width="20%" scope="col"></th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col"></th>
                <th width="15%" scope="col"></th>
                <th width="15%" scope="col" style="border-left: 1px solid black;">Margem Operacional</th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col">0.61%</th>
            </tr>
            
            <tr>
                <th width="20%" scope="col"></th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col" style="border-left: 1px solid black; border-bottom: 1px solid black; border-top: 1px solid black;">ROI</th>
                <th width="15%" scope="col" style="border-bottom: 1px solid black; border-top: 1px solid black;">1.83%</th>
                <th width="15%" scope="col" style="border-left: 1px solid black;"></th>
                <th width="10%" scope="col">x</th>
                <th width="15%" scope="col"></th>
            </tr>
            
            <tr>
                <th width="20%" scope="col"></th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col"></th>
                <th width="15%" scope="col"></th>
                <th width="15%" scope="col" style="border-left: 1px solid black; border-bottom: 1px solid black;">Giro Investimento</th>
                <th width="10%" scope="col" style="border-bottom: 1px solid black;"></th>
                <th width="15%" scope="col" style="border-bottom: 1px solid black;">3.02</th>
            </tr>
            
            <tr>
                <th width="20%" scope="col"></th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col">+</th>
                <th width="15%" scope="col"></th>
                <th width="15%" scope="col"></th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col"></th>
            </tr>

            <tr>
                <th width="20%" scope="col"></th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col"></th>
                <th width="15%" scope="col"></th>
                <th width="15%" scope="col" style="border-top: 1px solid black; border-left: 1px solid black;">ROI</th>
                <th width="10%" scope="col" style="border-top: 1px solid black;"></th>
                <th width="15%" scope="col" style="border-top: 1px solid black;">3.02</th>
            </tr>
            
            <tr>
                <th width="20%" scope="col" style="border-bottom: 1px solid black; border-top: 1px solid black;"><b>RSPL</b></th>
                <th width="10%" scope="col" style="border-bottom: 1px solid black; border-top: 1px solid black; border-right: 1px solid black;"><b>1299.95%</b></th>
                <th width="15%" scope="col" style="border-bottom: 1px solid black; border-top: 1px solid black;">Spread</th>
                <th width="15%" scope="col" style="border-bottom: 1px solid black; border-top: 1px solid black;">617.14%</th>
                <th width="15%" scope="col" style="border-left: 1px solid black;"></th>
                <th width="10%" scope="col">(-)</th>
                <th width="15%" scope="col"></th>
            </tr>
            
            <tr>
                <th width="20%" scope="col"></th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col"></th>
                <th width="15%" scope="col"></th>
                <th width="15%" scope="col" style="border-bottom: 1px solid black; border-left: 1px solid black;">Ki</th>
                <th width="10%" scope="col" style="border-bottom: 1px solid black;"></th>
                <th width="15%" scope="col" style="border-bottom: 1px solid black;">3.02</th>
            </tr>
            
            <tr>
                <th width="20%" scope="col"></th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col">x</th>
                <th width="15%" scope="col"></th>
                <th width="15%" scope="col"></th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col"></th>
            </tr>
            
            <tr>
                <th width="20%" scope="col"></th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col"></th>
                <th width="15%" scope="col"></th>
                <th width="15%" scope="col" style="border-left: 1px solid black; border-top: 1px solid black;">Passivo</th>
                <th width="10%" scope="col" style="border-top: 1px solid black;"></th>
                <th width="15%" scope="col" style="border-top: 1px solid black;">R$ 199.239,92</th>
            </tr>
            
            <tr>
                <th width="20%" scope="col"></th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col" style="border-left: 1px solid black; border-bottom: 1px solid black; border-top: 1px solid black;">P/PL</th>
                <th width="15%" scope="col" style="border-bottom: 1px solid black; border-top: 1px solid black;">2.10</th>
                <th width="15%" scope="col" style="border-left: 1px solid black;"></th>
                <th width="10%" scope="col">/</th>
                <th width="15%" scope="col"></th>
            </tr>
            
            <tr>
                <th width="20%" scope="col"></th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col"></th>
                <th width="15%" scope="col"></th>
                <th width="15%" scope="col" style="border-left: 1px solid black;">PL</th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col">R$ 199.239,92</th>
            </tr>
            
        </tbody>

    </table>
    
    <p><b>Retorno sobre o Ativo  - ROA</b></p>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="30%" scope="col" colspan="4">Lucro Operacional</th>
                <th width="10%" scope="col">R$ 335.556,22</th>
                <th width="20%" scope="col">Ativo Total</th>
                <th width="20%" scope="col">Passivo Funcionamento</th>
                <th width="20%" scope="col">Dívidas sem ônus</th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col">R$ 335.556,22</th>
                <th width="20%" scope="col">R$ 335.556,22</th>
                <th width="20%" scope="col">R$ 335.556,22</th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Passivo Oneroso</th>
                <th width="20%" scope="col">Despesas Financeiras</th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">R$ 335.556,22</th>
                <th width="20%" scope="col">R$ 335.556,22</th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Patrimônio Líquido</th>
                <th width="20%" scope="col">Lucro Líquido</th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">R$ 335.556,22</th>
                <th width="20%" scope="col">R$ 335.556,22</th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="40%" scope="col" colspan="4">Retorno sobre o Ativo - <b>ROA</b></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Lucro Operacional</th>
                <th width="20%" scope="col"><b>1.83%</b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Ativo Total - LL</th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>
    
    <p>Custo de Capital equivale aos retornos exigidos pelos credores e proprietarios das empresas para que ela se torne atrativa em relação ao que o mercado paga de forma alternativa a participação na empresa, ou seja, qual o percentual  que o patrimonio da empresa deve evoluir pra que a empresa seja viável aos olhos dos sócios</p>
    <br>
    <p>CMPC = W¹ x Ki + W² x Ke</p>
    <p>onde:</p>
    <p>CMPC = custo médio ponderado de capital das várias fontes de financiamento utilizadas pela empresa</p>
    <p>W¹ e W² = respectivamente, proporção de fundos de terceiros e próprios na estrutura de capital </p>
    <p>Ki = custo do capital de terceiros</p>
    <p>Ke = custo do capital próprio</p>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="80%" scope="col" colspan="6"><b>CUSTO CAPITAL PRÓPRIO</b></th>
                <th width="20%" scope="col"><b>12%</b></th>

            </tr>
            
        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="30%" scope="col" colspan="4">Lucro Operacional</th>
                <th width="10%" scope="col">R$ 335.556,22</th>
                <th width="20%" scope="col">Investimento</th>
                <th width="20%" scope="col">Passivo oneroso</th>
                <th width="20%" scope="col">Ki -615%</th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col">R$ 335.556,22</th>
                <th width="20%" scope="col">R$ 335.556,22</th>
                <th width="20%" scope="col">W' 0.10</th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Patrimônio Líquido</th>
                <th width="20%" scope="col">Ke 12.00%</th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">R$ 335.556,22</th>
                <th width="20%" scope="col">W2 0.90</th>

            </tr>
            
        </tbody>

    </table>
    
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="80%" scope="col" colspan="6"><b>CMPC</b></th>
                <th width="20%" scope="col"><b>12%</b></th>

            </tr>
            
        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="100%" scope="col" colspan="7">Significa que a empresa deve ter um resultado de <b>(9,505,449.55)</b> para atingir as expectativas de retorno dos proprietários/sócios</th>

            </tr>
            
        </tbody>

    </table>
    
    <table class="table table-cleaned table-condensed">

        <tbody>

            <tr>

                <th width="80%" scope="col" colspan="6">Lucro Operacional no período</th>
                <th width="20%" scope="col">R$ 122.223,23</th>

            </tr>
            
            <tr>

                <th width="80%" scope="col" colspan="6">Lucro estimado para remunerar o patrimonio com o percentual informado</th>
                <th width="20%" scope="col">R$ 122.223,23</th>

            </tr>
            
            <tr>

                <th width="80%" scope="col" colspan="6">Valor Economico Agregado - VEA</th>
                <th width="20%" scope="col">R$ 122.223,23</th>

            </tr>
            
        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th scope="col" colspan="7" style="background-color: #FFF;">Esse valor "VEA" seria o lucro extraordinário obtido pela empresa no período </th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4">VEA = LUCRO OPERACIONAL - (INVESTIMENTOxCMPC)</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"><b>VEA =</b></th>
                <th width="20%" scope="col"><b>R$ 122.231,23</b></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th scope="col" colspan="7" style="background-color: #FFF;">GOODWILL - reflete o preço que um investidor pagaria por uma empresa a mais do que ele gastaria na hipotese de construída na atual estrutura de investimento assim: </th>

            </tr>
            
            <tr>

                <th scope="col" colspan="7" style="background-color: #FFF;"><i>"Esse resultado indica a valorização do preço de mercado da empresa em relação do valor de seus ativos, determinada pela espectativa de produzir um lucro extraordinario positivo no futuro"</i></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"><b>GOODWILL = VEA</b></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"><b>R$ 122.231,23</b></th>
                <th width="20%" scope="col"><b>R$ 122.231,23</b></th>

            </tr>

            <tr>

                <th width="40%" scope="col" colspan="4">CMPC</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">0.5192</th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="40%" scope="col" colspan="4">Nessa hipótese a empresa estaria sendo avaliada ao preço</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"><b>AVALIAÇÃO = PL + GOODWILL</b></th>
                <th width="20%" scope="col"><b>R$ 122.231,23</b></th>

            </tr>

        </tbody>

    </table>
    
    <p class="text-center"><b>ANÁLISE DE INDICADORES DE DESEMPENHO</b></p>
    
    <p>Esses indicadores, tem com objetivo a análise da empresa sob o ponto de vista econômico de rentabilidade, e oferecem importantes entendimentos sobre o desempenho da empresa nos períodos considerados. </p>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="20%" scope="col"><b>MARGEM BRUTA</b></th>
                <th width="20%" scope="col">Lucro Bruto</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>
                <th width="20%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Receita Líquida de Vendas</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="20%" scope="col"><b>MARGEM LÍQUIDA</b></th>
                <th width="20%" scope="col">Lucro Líquido</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>
                <th width="20%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Receita Líquida de Vendas</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="20%" scope="col"><b>RETORNO PATRIMÔNIO</b></th>
                <th width="20%" scope="col">Lucro Líquido</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>
                <th width="20%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Patrimônio Líquido</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>

    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="20%" scope="col"><b>LIQUIDEZ CORRENTE</b></th>
                <th width="20%" scope="col">Ativo Circulante</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>
                <th width="20%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Passivo Circulante</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="20%" scope="col"><b>LIQUIDEZ SECA</b></th>
                <th width="20%" scope="col">Ativo Circulante-estoque</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>
                <th width="20%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Passivo Circulante</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="20%" scope="col"><b>LIQUIDEZ IMEDIATA</b></th>
                <th width="20%" scope="col">Disponibidades + Aplicações Financeiras</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>
                <th width="20%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Passivo Circulante</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="20%" scope="col"><b>CAPITAL CIRCULANTE LÍQUIDO</b></th>
                <th width="20%" scope="col">Ativo Circulante</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"><b>R$ 1200,00</b></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Passivo Circulante</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="20%" scope="col"><b>LIQUIDEZ GERAL</b></th>
                <th width="20%" scope="col">A.C + ARLP</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>
                <th width="20%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">PC + PELP </th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="20%" scope="col"><b>RETORNO S/INV TOTAL</b></th>
                <th width="20%" scope="col">LL</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>
                <th width="20%" scope="col">Lucratividade</th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Ativo Total</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="20%" scope="col"><b>INDICE DE EFICIÊNCIA</b></th>
                <th width="20%" scope="col">Despesas Operacionais</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>
                <th width="20%" scope="col">Produtividade</th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Receita Operacional Líquida</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>

    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="20%" scope="col"><b>GRAU DE ENDIVIDAMENTO</b></th>
                <th width="20%" scope="col">PC + PELP</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>
                <th width="20%" scope="col">GE</th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">PL</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="20%" scope="col"><b>PONTO DE EQUILIBRIO</b></th>
                <th width="20%" scope="col">Margem Contribuição</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>
                <th width="20%" scope="col">R$ 1200,00</th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Despesas Estimadas</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="20%" scope="col"><b>IMOBILIZAÇÃO DO PL</b></th>
                <th width="20%" scope="col">Imobilizado</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"><b>1.83</b></th>
                <th width="20%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Patrimônio Líquido</th>
                <th width="20%" scope="col">R$ 1200,00</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed" style="background-color: #80808069;">

        <tbody>

            <tr>

                <th width="100%" class="text-center" scope="col" colspan="3"><b>INDICADOR DE INSOLVENCIA SEGUNDO KANITZ </b></th>
                
            </tr>
            
            <tr>

                <th width="100%" scope="col" colspan="3"></th>
                
            </tr>
            
            <tr>

                <th width="40%" scope="col">Formula: (0,05RP+1,65LG+3,55LS) - (1,06LC + 0,33GE)</th>
                <th width="30%" scope="col"></th>
                <th width="30%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="40%" scope="col">onde:</th>
                <th width="30%" scope="col"></th>
                <th width="30%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="40%" scope="col">RP: Rentabilidade do Patrimonio</th>
                <th width="30%" scope="col"></th>
                <th width="30%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="40%" scope="col">LG: Liquidez Geral</th>
                <th width="30%" scope="col"></th>
                <th width="30%" scope="col" style="background-color: orange; border: 2px solid black;"><span>Índice Kanitz:</span> <span class="text-right"><b>4.37</b></span> </th>
                
            </tr>
            
            <tr>

                <th width="40%" scope="col">LS: Liquidez Seca</th>
                <th width="30%" scope="col"></th>
                <th width="30%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="40%" scope="col">LC: Liquidez Corrente</th>
                <th width="30%" scope="col"></th>
                <th width="30%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="40%" scope="col">GE: Grau de Endividamento</th>
                <th width="30%" scope="col"></th>
                <th width="30%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="100%" scope="col" colspan="3"></th>
                
            </tr>
            
            <tr>

                <th width="100%" scope="col" colspan="3">O Termômetro de Insolvência do Prof Kanitz é um instrumento utilizado para prever a possibilidade de falência de empresa e após a aplicação da formula, temos a seguinte ANÁLISE:</th>
                
            </tr>
            
            <tr>

                <th width="100%" scope="col" colspan="3">
                    
                    <p>.-3         indica que a empresa se encontra numa situação que poderá levá-la a falência.</p>
                    <p>.-3 a 0   indica que a empresa esta na penumbra, ou seja, uma posição que demanda certa cautela</p>
                    <p>acima 0 indica que não há razão para a Administração se preocupar com a empresa </p>
                    
                </th>
                
            </tr>
            
        </tbody>

    </table>
    
</div>