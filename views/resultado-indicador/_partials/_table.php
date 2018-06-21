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