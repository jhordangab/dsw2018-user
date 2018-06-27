<?php

use yii\helpers\Html;

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

$js = <<<JS
        
    $('.modal_indicadores').click(function () 
    {
        var url = $(this).attr("data-link");
        var title = $(this).attr("data-title");
        $('#iframe_modal_indicadores').attr('src', url);
        $("[id^='modal_indicadores']").modal("show");
        $('.modal-backdrop').removeClass('modal-backdrop');
        $('#modal_indicadores .modal-header h3').text(title);
    });
        
    $("[id^='modal_indicadores']").on('hidden.bs.modal', function () 
    {
        jQuery.ajax({
            url: '/indicador/get-data',
            data: $('#form-indicador').serialize(),
            type: 'POST',
            success: function (data) 
            {
                $('#render-result').html(data);
            },
        });
    });
        
JS;

$this->registerJs($js);

$ativo_total = $ativo_circulante = $ativo_nao_circulante = $ativo_permanente = 0;
$dados_ativo_circulante = [];

foreach($dados['Ativo'] as $ativo)
{
    $ativo_total += $ativo['valor'];
    
    switch($ativo['descricao'])
    {
        case 'Ativo Circulante':
            $ativo_circulante += $ativo['valor'];
            $dados_ativo_circulante[] = ['nome' => $ativo['titulo'], 'valor' => $ativo['valor']];
            break;
        case 'Ativo não Circulante':
            $ativo_nao_circulante = $ativo['valor'];
            break;
        case 'Ativo Permanente':
            $ativo_permanente = $ativo['valor'];
            break;
    }
}

$passivo_total = $passivo_circulante = $passivo_nao_circulante = $patrimonio_liquido = 0;
$dados_passivo_circulante = [];

foreach($dados['Passivo'] as $ativo)
{
    $passivo_total += $ativo['valor'];
    
    switch($ativo['descricao'])
    {
        case 'Passivo Circulante':
            $passivo_circulante += $ativo['valor'];
            $dados_passivo_circulante[] = ['nome' => $ativo['titulo'], 'valor' => $ativo['valor']];
            break;
        case 'Passivo não Circulante':
            $passivo_nao_circulante = $ativo['valor'];
            break;
        case 'Patrimonio Líquido':
            $patrimonio_liquido = $ativo['valor'];
            break;
    }
}

?>

<div class="col-lg-12">
    
    <?= Html::a('<i class="fa fa-cogs"></i> Configurar Indicadores', FALSE, 
    [
        'title' => 'Configurar Indicadores',
        'class' => 'btn btn-default modal_indicadores pull-right',
        'data-link' => '/indicador/configurar?empresa_id=' . $model->empresa_id . '&ano=' . $model->ano,
        'data-title' => 'Configurar Indicadores',
        'style' => 'cursor:pointer; margin-bottom: 10px; margin-right: 25px;'
    ]); ?>
    
</div>

<div class="col-lg-12">
    
    <div class="col-lg-6">
        
        <table class="table table-indicador table-condensed">

            <tbody>

                <tr>

                    <th scope="col" colspan="4"><b>ATIVO</b></th>
                    <th scope="col"><b>R$ <?= number_format($ativo_total, 2, ',', '.') ?></b></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="3">Ativo Circulante</th>
                    <th scope="col">R$ <?= number_format($ativo_circulante, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <?php
                
                $estoque = $disponibilidade = $aplicacoes_financeiras = 0;
                
                foreach($dados_ativo_circulante as $dac) : 
                
                    switch($dac['nome'])
                    {
                        case 'Estoques':
                            $estoque = $dac['valor'];
                            break;
                        case 'Disponibilidade':
                            $disponibilidade = $dac['valor'];
                            break;
                        case 'Aplicações Financeiras':
                            $aplicacoes_financeiras = $dac['valor'];
                            break;
                    }   
                    
                ?>
                
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
                    <th scope="col">R$ <?= number_format($ativo_nao_circulante, 2, ',', '.') ?></th>
                    <th scope="col">R$ <?= number_format($ativo_nao_circulante, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="2">Ativo Permanente</th>
                    <th scope="col">R$ <?= number_format($ativo_permanente, 2, ',', '.') ?></th>
                    <th scope="col">R$ <?= number_format($ativo_permanente, 2, ',', '.') ?></th>
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
                    
                    <?php $receita_operacional_bruta = isset($dre['E']['1']['valor']) ? $dre['E']['1']['valor'] : 0; ?>

                    <th scope="col">Receita Operacional Bruta</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($receita_operacional_bruta, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php $deducoes_sobre_vendas = isset($dre['E']['2']['valor']) ? $dre['E']['2']['valor'] * -1 : 0; ?>

                    <th scope="col" style="padding-left: 30px;">Deduções sobre Vendas</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($deducoes_sobre_vendas, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php $receita_operacional_liquida = $receita_operacional_bruta - $deducoes_sobre_vendas; ?>

                    <th scope="col">Receita Operacional Líquida</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($receita_operacional_liquida, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php $custo_mercadoria_vendidas = isset($dre['E']['3']['valor']) ? $dre['E']['3']['valor'] : 0;?>

                    <th scope="col" style="padding-left: 30px;">Custos de Mercadorias Vendidas</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($custo_mercadoria_vendidas, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php $lucro_bruto = $receita_operacional_liquida - $custo_mercadoria_vendidas;?>

                    <th scope="col">Lucro Bruto</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($lucro_bruto, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php 
                    
                        $despesa_administrativa = isset($dre['E']['4']['valor']) ? $dre['E']['4']['valor'] : 0;
                        $despesa_financeira = isset($dre['E']['5']['valor']) ? $dre['E']['5']['valor'] : 0;
                        $despesa_operacional_financeira = $despesa_administrativa + $despesa_financeira;
                        $depreciacao = isset($dre['D']['1']['valor']) ? $dre['D']['1']['valor'] : 0;
                                
                    ?>

                    <th scope="col">Despesas Operacionais e Financeiras</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($despesa_operacional_financeira, 2, ',', '.') ?></th>
                    <th scope="col">Depreciação</th>

                </tr>
                
                <tr>

                    <th scope="col" style="padding-left: 30px;">Despesas Administrativas</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($despesa_administrativa, 2, ',', '.') ?></th>
                    <th scope="col">R$ <?= number_format($depreciacao, 2, ',', '.') ?></th>

                </tr>
                
                <tr>

                    <th scope="col" style="padding-left: 30px;">Despesas Financeiras</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($despesa_financeira, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php $receita_financeira = isset($dre['E']['6']['valor']) ? $dre['E']['6']['valor'] * -1 : 0; ?>

                    <th scope="col" style="padding-left: 30px;">Receitas Financeiras</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($receita_financeira, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <?php $outras_receitas_despesas = isset($dre['E']['7']['valor']) ? $dre['E']['7']['valor'] : 0; ?>
                    
                    <th scope="col" style="padding-left: 30px;">Outras Receitas/Despesas</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($outras_receitas_despesas, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php $provisao_cs = isset($dre['E']['8']['valor']) ? $dre['E']['8']['valor'] : 0; ?>

                    <th scope="col" style="padding-left: 30px;">Provisão CS</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($provisao_cs, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php $lucro_operacional = $lucro_bruto - $despesa_administrativa - $despesa_financeira
                            + $receita_financeira - $outras_receitas_despesas - $provisao_cs; ?>

                    <th scope="col">Lucro Operacional</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($lucro_operacional, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php $provisao_ir = isset($dre['E']['9']['valor']) ? $dre['E']['9']['valor'] : 0; ?>

                    <th scope="col" style="padding-left: 30px;">Provisão IR</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($provisao_ir, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>
                    
                    <?php $lucro_liquido = $lucro_operacional - $provisao_ir; ?>

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
                    
                    <?php $porcentagem_aliquota_ir = ($lucro_operacional != 0) ? number_format($provisao_ir/$lucro_operacional, 2, ',', '.') . '%' : '0%';?>

                    <th scope="col" colspan="2">Alíquota do IR</th>
                    <th scope="col">Prov IR</th>
                    <th scope="col">R$ <?= number_format($provisao_ir, 2, ',', '.') ?></th>
                    <th scope="col"><?= $porcentagem_aliquota_ir ?></th>

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
                    <th scope="col">R$ <?= number_format($receita_operacional_bruta, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" style="padding-left: 30px;">Deduções sobre Vendas</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($deducoes_sobre_vendas, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col">Receita Operacional Líquida</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($receita_operacional_liquida, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <th scope="col" style="padding-left: 30px;">Custos de Mercadorias Vendidas</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($custo_mercadoria_vendidas, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col">Lucro Bruto</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($lucro_bruto, 2, ',', '.') ?></th>
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
                    <th scope="col">R$ <?= number_format($despesa_administrativa, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" style="padding-left: 30px;">Despesas Financeiras</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($despesa_financeira, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" style="padding-left: 30px;">Receitas Financeiras</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($receita_financeira, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <th scope="col" style="padding-left: 30px;">Outras Receitas/Despesas</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($outras_receitas_despesas, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" style="padding-left: 30px;">Provisão CS</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($provisao_cs, 2, ',', '.') ?></th>
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
                    
                    <?php $ir_s_lucro = $lucro_operacional * $porcentagem_aliquota_ir; ?>

                    <th scope="col" style="padding-left: 30px;">IR s/Lucro</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($ir_s_lucro, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                                      
                <tr>
                    
                    <?php $lucro_operacional_apos_ir = $lucro_operacional * $ir_s_lucro; ?>
                    
                    <th scope="col" colspan="2">Lucro Operacional após IR</th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($lucro_operacional_apos_ir, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" style="padding-left: 30px;">Despesas Financeiras</th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($despesa_financeira, 2, ',', '.') ?></th>
                    <th scope="col"></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php 
                    
                        $economia_ir_25_porcentagem = $despesa_financeira * $porcentagem_aliquota_ir;
                        $economia_ir_25_valor = $despesa_financeira - $economia_ir_25_porcentagem;
                    ?>

                    <th scope="col" style="padding-left: 30px;">Economia de Ir 25,28%</th>
                    <th scope="col">R$ <?= number_format($economia_ir_25_porcentagem, 2, ',', '.') ?></th>
                    <th scope="col">R$ <?= number_format($economia_ir_25_valor, 2, ',', '.') ?></th>
                    <th scope="col"></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>
                    
                    <?php $lucro_liquido_operacional = $lucro_operacional_apos_ir - $economia_ir_25_valor; ?>
                    
                    <th scope="col" colspan="2"><b>Lucro Líquido Operacional</b></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($lucro_liquido_operacional, 2, ',', '.') ?></th>
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
                    <th scope="col"><b>R$ <?= number_format($passivo_total, 2, ',', '.') ?></b></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="3">Passivo Circulante</th>
                    <th scope="col">R$ <?= number_format($passivo_circulante, 2, ',', '.') ?></th>
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
                    <th scope="col">R$ <?= number_format($passivo_nao_circulante, 2, ',', '.') ?></th>
                    <th scope="col">R$ <?= number_format($passivo_nao_circulante, 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="2">Patrimônio Líquido</th>
                    <th scope="col">R$ <?= number_format($patrimonio_liquido, 2, ',', '.') ?></th>
                    <th scope="col">R$ <?= number_format($patrimonio_liquido, 2, ',', '.') ?></th>
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
                    <th scope="col"><b>R$ <?= number_format($ativo_total, 2, ',', '.') ?></b></th>

                </tr>
                
                <?php
                
                    $passivo_funcionamento = $emprestimo_financiamento = 0;
                    
                    foreach($dados_passivo_circulante as $index => $dpc) : ?>
                
                    <?php if($dpc['nome'] != "Empréstimos/Financiam.") : 
                    
                        $passivo_funcionamento += $dpc['valor'];
                        
                    ?>
                    
                        <tr>

                            <th scope="col"></th>
                            <th scope="col" colspan="2"><?= $dpc['nome'] ?></th>
                            <th scope="col">R$ <?= number_format($dpc['valor'], 2, ',', '.') ?></th>
                            <th scope="col"><?= ($index == sizeof($dados_passivo_circulante) - 1) ? 'R$' . number_format($passivo_funcionamento, 2, ',', '.') : '' ?></th>
                            <th scope="col"></th>

                        </tr>
                    
                    <?php else: 
                        
                            $emprestimo_financiamento = $dpc['valor'];
                        
                        endif; ?>
                
                <?php endforeach; ?>
                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>
                    
                    <?php
                    
                        $investimento = $ativo_total - $emprestimo_financiamento;
                        
                    ?>

                    <th scope="col" colspan="2">INVESTIMENTO</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($investimento, 2, ',', '.') ?></th>
                    
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

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Passivo Oneroso</th>
                <th width="20%" scope="col">Despesas Financeiras</th>

            </tr>
            
            <tr>
                
                <?php 
                
                    $lucro_operacional_2 = $lucro_operacional_apos_ir + $despesa_financeira;
                    $passivo_oneroso = $passivo_nao_circulante + $emprestimo_financiamento; 
                    $despesa_financeira_2 = $economia_ir_25_valor;
                    
                ?>


                <th width="30%" scope="col" colspan="4">Lucro Operacional</th>
                <th width="10%" scope="col">R$ <?= number_format($lucro_operacional_2, 2, ',', '.') ?></th>
                <th width="20%" scope="col">Investimento</th>
                <th width="20%" scope="col">R$ <?= number_format($passivo_oneroso, 2, ',', '.') ?></th>
                <th width="20%" scope="col">R$ <?= number_format($despesa_financeira_2, 2, ',', '.') ?></th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col">R$ <?= number_format($investimento, 2, ',', '.') ?></th>
                <th width="20%" scope="col">Patrimônio Líquido</th>
                <th width="20%" scope="col">Lucro Líquido</th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">R$ <?= number_format($patrimonio_liquido, 2, ',', '.') ?></th>
                <th width="20%" scope="col">R$ <?= number_format($lucro_liquido, 2, ',', '.') ?></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php 
                
                    $investimento_lucro_liquido = $investimento - $lucro_liquido;
                    $retorno_sobre_investimento = ($investimento_lucro_liquido != 0) ? ($lucro_operacional_2 / $investimento_lucro_liquido) : 0;
                ?>

                <th width="40%" scope="col" colspan="4">Retorno sobre investimento <b>ROI</b></th>
                <th width="20%" scope="col">Lucro Operacional</th>
                <th width="20%" scope="col">R$ <?= number_format($lucro_operacional_2, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($retorno_sobre_investimento, 2, ',', '.') ?>%</b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">Investimento - Lucro Líquido</th>
                <th width="20%" scope="col"><?= number_format($investimento_lucro_liquido, 2, ',', '.') ?></th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <?php 
                
                    $pl_lucro_liquido = $patrimonio_liquido - $lucro_liquido;
                    $retorno_sobre_patrimonio_liquido = ($pl_lucro_liquido != 0) ? ($lucro_liquido / $pl_lucro_liquido) : 0;

                ?>
                
                <th width="40%" scope="col" colspan="4">Retorno sobre o Patrimonio Líquido - RSPL</th>
                <th width="20%" scope="col">Lucro Líquido</th>
                <th width="20%" scope="col">R$ <?= number_format($lucro_liquido, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($retorno_sobre_patrimonio_liquido, 2, ',', '.') ?>%</b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">PL - Lucro Liq</th>
                <th width="20%" scope="col">R$ <?= number_format($pl_lucro_liquido, 2, ',', '.') ?></th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php $custo_da_divida = ($passivo_oneroso != 0) ? ($despesa_financeira_2 / $passivo_oneroso) : 0; ?>

                <th width="40%" scope="col" colspan="4">Custo da Divida (ki)</th>
                <th width="20%" scope="col">Despesas Financeiras</th>
                <th width="20%" scope="col">R$ <?= number_format($despesa_financeira_2, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b>1.83%</b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">Passivo Oneroso</th>
                <th width="20%" scope="col">R$ <?= number_format($passivo_oneroso, 2, ',', '.') ?></th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php $grau_alavancagem_financeira = ($retorno_sobre_investimento != 0) ? ($retorno_sobre_patrimonio_liquido / $retorno_sobre_investimento) : 0; ?>

                <th width="40%" scope="col" colspan="4">Grau de Alavancagem Financeira <b>GAF</b></th>
                <th width="20%" scope="col">RSPL</th>
                <th width="20%" scope="col"><b><?= number_format($retorno_sobre_patrimonio_liquido, 2, ',', '.') ?>%</b></th>
                <th width="20%" scope="col"><b><?= number_format($grau_alavancagem_financeira, 2, ',', '.') ?></b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">ROI</th>
                <th width="20%" scope="col"><b><?= number_format($retorno_sobre_investimento, 2, ',', '.') ?>%</b></th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>

    <p><b>GIRO DO ATIVO/INVESTIMENTO EM FUNÇÃO DAS VENDAS </b></p>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <?php $giro_do_ativo = ($ativo_total != 0) ? ($receita_operacional_liquida / $ativo_total) : 0; ?>

                
                <th width="40%" scope="col" colspan="4">Giro do Ativo</th>
                <th width="20%" scope="col">Receitas Operacionais</th>
                <th width="20%" scope="col">R$ <?= number_format($receita_operacional_liquida, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($giro_do_ativo, 2, ',', '.') ?></b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">Ativo Total</th>
                <th width="20%" scope="col">R$ <?= number_format($ativo_total, 2, ',', '.') ?></th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php 
                
                    $investimento_ll = $investimento - $lucro_liquido;
                    $giro_do_investimento = ($investimento_ll != 0) ? ($receita_operacional_liquida / $investimento_ll) : 0;
                    
                ?>

                <th width="40%" scope="col" colspan="4">Giro do Investimento</th>
                <th width="20%" scope="col">Receitas Operacionais</th>
                <th width="20%" scope="col">R$ <?= number_format($receita_operacional_liquida, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($giro_do_investimento, 2, ',', '.') ?></b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">Investimento - LL</th>
                <th width="20%" scope="col">R$ <?= number_format($investimento_ll, 2, ',', '.') ?></th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php $margem_operacional = ($receita_operacional_liquida != 0) ? ($lucro_operacional_2 / $receita_operacional_liquida) : 0; ?>

                <th width="40%" scope="col" colspan="4">Margem Operacional</th>
                <th width="20%" scope="col">Lucro Operacional</th>
                <th width="20%" scope="col">R$ <?= number_format($lucro_operacional_2, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($margem_operacional, 2, ',', '.') ?>%</b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">Receitas Operacionais</th>
                <th width="20%" scope="col">R$ <?= number_format($receita_operacional_liquida, 2, ',', '.') ?></th>
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
                <th width="20%" scope="col"><b><?= number_format($retorno_sobre_investimento, 2, ',', '.') ?>% =</b></th>
                <th width="20%" scope="col"><b><?= number_format($giro_do_investimento * $margem_operacional, 2, ',', '.') ?>%</b></th>

            </tr>

        </tbody>

    </table>
    
    <p><b>GIRO DOS RECURSOS PRÓPRIOS</b></p>

    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <?php $margem_liquida = ($receita_operacional_liquida != 0) ? ($lucro_liquido / $receita_operacional_liquida) : 0; ?>
                
                <th width="40%" scope="col" colspan="4">Margem líquida</th>
                <th width="20%" scope="col">LL</th>
                <th width="20%" scope="col">R$ <?= number_format($lucro_liquido, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($margem_liquida, 2, ',', '.') ?>%</b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">Vendas</th>
                <th width="20%" scope="col">R$ <?= number_format($receita_operacional_liquida, 2, ',', '.') ?></th>
                <th width="20%" scope="col"></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php 
                
                    $pl_ll = $patrimonio_liquido - $lucro_liquido;
                    $giro_recursos_proprios = ($pl_ll != 0) ? ($receita_operacional_liquida / $pl_ll) : 0; 
                    
                ?>

                <th width="40%" scope="col" colspan="4">Giro dos Recursos Próprios</th>
                <th width="20%" scope="col">Vendas</th>
                <th width="20%" scope="col">R$ <?= number_format($receita_operacional_liquida, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($giro_recursos_proprios, 2, ',', '.') ?></b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">PL-LL</th>
                <th width="20%" scope="col">R$ <?= number_format($pl_ll, 2, ',', '.') ?></th>
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
                <th width="20%" scope="col"><b><?= number_format($retorno_sobre_patrimonio_liquido, 2, ',', '.') ?>% =</b></th>
                <th width="20%" scope="col"><b><?= number_format($margem_liquida * $giro_recursos_proprios, 2, ',', '.') ?>%</b></th>

            </tr>

        </tbody>

    </table>
    
    <p><b>INDICADORES DE COBERTURA DAS EXIGIBILIDADES E DOS JUROS </b></p>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php $cobertura_juros = ($economia_ir_25_valor != 0) ? ($lucro_operacional_2 / $economia_ir_25_valor) : 0; ?>

                <th width="40%" scope="col" colspan="4">Cobertura de juros </th>
                <th width="20%" scope="col">Lucro Operacional</th>
                <th width="20%" scope="col">R$ <?= number_format($lucro_operacional_2, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b>1.83</b></th>

            </tr>
            
            <tr>

                <th width="40%" scope="col" colspan="4"></th>
                <th width="20%" scope="col">Despesas Financeiras</th>
                <th width="20%" scope="col">R$ <?= number_format($economia_ir_25_valor, 2, ',', '.') ?></th>
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
                <th width="20%" scope="col">R$ <?= number_format($lucro_operacional_2, 2, ',', '.') ?></th>
                <th width="20%" scope="col">R$ <?= number_format($depreciacao, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b>R$ <?= number_format($lucro_operacional_2 + $depreciacao, 2, ',', '.') ?></b></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>
            
            <tr>
                
                <?php  
                
                    $ebitda_valor = $lucro_liquido + $depreciacao - $receita_financeira + $despesa_financeira;
                    $ebitda_porcentagem = ($receita_operacional_liquida != 0) ? ($ebitda_valor / $receita_operacional_liquida) : 0;
                
                ?>

                <th width="40%" scope="col" colspan="4">EBITDA = Lucro Líquido + depreciação - financeiro</th>
                <th width="20%" scope="col">R$ <?= number_format($ebitda_valor, 2, ',', '.') ?></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"><b><?= number_format($ebitda_porcentagem, 2, ',', '.') ?>%</b></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>
            
            <tr>
                
                <?php  
                
                    $valuation_metodo_ebitda = ($configuracao) ? $configuracao->valuation_metodo_ebitda : 0;
                    $valuation_metodo_ebitda_valor = $ebitda_valor * $valuation_metodo_ebitda;      
                    
                ?>

                <th width="40%" scope="col" colspan="4">VALUATION MÉTODO EBITDA</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col" style="color: blue;"><b><?= $valuation_metodo_ebitda ?></b></th>
                <th width="20%" scope="col"><b>R$ <?= number_format($valuation_metodo_ebitda_valor, 2, ',', '.') ?></b></th>

            </tr>

        </tbody>

    </table>
    
    <p class="text-center"><b>AVALIAÇÃO ANALITICA DE DESEMPENHO ECONÔMICO </b></p>
    
    <p>Formulação Analítica do Desempenho Medido pelo ROI</p>
    
    <table class="table table-cleaned table-condensed" style="border: 1px solid black;">

        <tbody>
            
            <?php
            
                $roi_avaliacao = $margem_operacional * $giro_do_investimento;
                $spread_avaliacao = $retorno_sobre_investimento - $custo_da_divida;
                $pl_avaliacao = $patrimonio_liquido - $lucro_liquido;
                $p_pl_avaliacao = ($pl_avaliacao != 0) ? $passivo_total / $pl_avaliacao : 0;
                $rspl_avaliacao = $roi_avaliacao + ($spread_avaliacao * $p_pl_avaliacao);
                
            ?>
            
            <tr>
                <th width="20%" scope="col"></th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col"></th>
                <th width="15%" scope="col"></th>
                <th width="15%" scope="col" style="border-left: 1px solid black;">Margem Operacional</th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col"><?= number_format($margem_operacional, 2, ',', '.') ?>%</th>
            </tr>
            
            <tr>
                <th width="20%" scope="col"></th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col" style="border-left: 1px solid black; border-bottom: 1px solid black; border-top: 1px solid black;">ROI</th>
                <th width="15%" scope="col" style="border-bottom: 1px solid black; border-top: 1px solid black;"><?= number_format($roi_avaliacao, 2, ',', '.') ?>%</th>
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
                <th width="15%" scope="col" style="border-bottom: 1px solid black;"><?= number_format($giro_do_investimento, 2, ',', '.') ?></th>
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
                <th width="15%" scope="col" style="border-top: 1px solid black;"><?= number_format($retorno_sobre_investimento, 2, ',', '.') ?>%</th>
            </tr>
            
            <tr>
                <th width="20%" scope="col" style="border-bottom: 1px solid black; border-top: 1px solid black;"><b>RSPL</b></th>
                <th width="10%" scope="col" style="border-bottom: 1px solid black; border-top: 1px solid black; border-right: 1px solid black;"><b><?= number_format($rspl_avaliacao, 2, ',', '.') ?>%</b></th>
                <th width="15%" scope="col" style="border-bottom: 1px solid black; border-top: 1px solid black;">Spread</th>
                <th width="15%" scope="col" style="border-bottom: 1px solid black; border-top: 1px solid black;"><?= number_format($spread_avaliacao, 2, ',', '.') ?>%</th>
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
                <th width="15%" scope="col" style="border-bottom: 1px solid black;"><?= number_format($custo_da_divida, 2, ',', '.') ?>%</th>
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
                <th width="15%" scope="col" style="border-top: 1px solid black;">R$ <?= number_format($passivo_total, 2, ',', '.') ?></th>
            </tr>
            
            <tr>
                <th width="20%" scope="col"></th>
                <th width="10%" scope="col"></th>
                <th width="15%" scope="col" style="border-left: 1px solid black; border-bottom: 1px solid black; border-top: 1px solid black;">P/PL</th>
                <th width="15%" scope="col" style="border-bottom: 1px solid black; border-top: 1px solid black;"><?= number_format($p_pl_avaliacao, 2, ',', '.') ?></th>
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
                <th width="15%" scope="col">R$ <?= number_format($pl_avaliacao, 2, ',', '.') ?></th>
            </tr>
            
        </tbody>

    </table>
    
    <p><b>Retorno sobre o Ativo  - ROA</b></p>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Passivo Funcionamento</th>
                <th width="20%" scope="col">Dívidas sem ônus</th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">R$ <?= number_format($passivo_funcionamento, 2, ',', '.') ?></th>
                <th width="20%" scope="col">R$ <?= number_format($passivo_nao_circulante, 2, ',', '.') ?></th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4">Lucro Operacional</th>
                <th width="10%" scope="col">R$ <?= number_format($lucro_operacional_2, 2, ',', '.') ?></th>
                <th width="20%" scope="col">Ativo Total</th>
                <th width="20%" scope="col">Passivo Oneroso</th>
                <th width="20%" scope="col">Despesas Financeiras</th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col">R$ <?= number_format($ativo_total, 2, ',', '.') ?></th>
                <th width="20%" scope="col">R$ <?= number_format($passivo_oneroso, 2, ',', '.') ?></th>
                <th width="20%" scope="col">R$ <?= number_format($economia_ir_25_valor, 2, ',', '.') ?></th>

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
                <th width="20%" scope="col">R$ <?= number_format($patrimonio_liquido, 2, ',', '.') ?></th>
                <th width="20%" scope="col">R$ <?= number_format($lucro_liquido, 2, ',', '.') ?></th>

            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <?php $retorno_sobre_ativo = (($ativo_total - $lucro_liquido) != 0) ? $lucro_operacional_2 / ($ativo_total - $lucro_liquido) : 0 ?>
                
                <th width="40%" scope="col" colspan="4">Retorno sobre o Ativo - <b>ROA</b></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Lucro Operacional</th>
                <th width="20%" scope="col"><b><?= number_format($retorno_sobre_ativo, 2, ',', '.') ?>%</b></th>

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
                <th width="20%" scope="col" style="color: blue;"><b><?= ($configuracao) ? $configuracao->custo_capital_proprio . '%' : '?' ?></b></th>

            </tr>
            
        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <?php 
            
                $custo_capital_proprio = ($configuracao) ? $configuracao->custo_capital_proprio : 0;
                $w1 = ($investimento != 0) ? $passivo_oneroso / $investimento : 0;
                $w2 = ($investimento != 0) ? $patrimonio_liquido / $investimento : 0;
                
            ?>
            
            <tr>

                <th width="30%" scope="col" colspan="4">Lucro Operacional</th>
                <th width="10%" scope="col">R$ <?= number_format($lucro_operacional_2, 2, ',', '.') ?></th>
                <th width="20%" scope="col">Investimento</th>
                <th width="20%" scope="col">Passivo oneroso</th>
                <th width="20%" scope="col">Ki <?= number_format($custo_da_divida, 2, ',', '.') ?>%</th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col">R$ <?= number_format($investimento, 2, ',', '.') ?></th>
                <th width="20%" scope="col">R$ <?= number_format($passivo_oneroso, 2, ',', '.') ?></th>
                <th width="20%" scope="col">W' <?= number_format($w1, 2, ',', '.') ?></th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Patrimônio Líquido</th>
                <th width="20%" scope="col">Ke <?= number_format($custo_capital_proprio, 2, ',', '.') ?>%</th>

            </tr>
            
            <tr>

                <th width="30%" scope="col" colspan="4"></th>
                <th width="10%" scope="col"></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"><?= number_format($patrimonio_liquido, 2, ',', '.') ?> %</th>
                <th width="20%" scope="col">W2 <?= number_format($w2, 2, ',', '.') ?></th>

            </tr>
            
        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php $cmpc = ($custo_da_divida * $w1) + ($custo_capital_proprio * $w2); ?>

                <th width="80%" scope="col" colspan="6"><b>CMPC</b></th>
                <th width="20%" scope="col"><b><?= number_format($cmpc, 2, ',', '.') ?> %</b></th>

            </tr>
            
        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php $lucro_estimado = ($passivo_oneroso + $patrimonio_liquido) * $cmpc; ?>

                <th width="100%" scope="col" colspan="7">Significa que a empresa deve ter um resultado de <b>R$ <?= number_format($lucro_estimado, 2, ',', '.') ?></b> para atingir as expectativas de retorno dos proprietários/sócios</th>

            </tr>
            
        </tbody>

    </table>
    
    <table class="table table-cleaned table-condensed">

        <tbody>

            <tr>

                <th width="80%" scope="col" colspan="6">Lucro Operacional no período</th>
                <th width="20%" scope="col">R$ <?= number_format($lucro_operacional_2, 2, ',', '.') ?></th>

            </tr>
            
            <tr>

                <th width="80%" scope="col" colspan="6">Lucro estimado para remunerar o patrimonio com o percentual informado</th>
                <th width="20%" scope="col">R$ <?= number_format($lucro_estimado, 2, ',', '.') ?></th>

            </tr>
            
            <tr>

                <th width="80%" scope="col" colspan="6">Valor Economico Agregado - VEA</th>
                <th width="20%" scope="col">R$ <?= number_format($lucro_operacional_2 - $lucro_estimado, 2, ',', '.') ?></th>

            </tr>
            
        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <th scope="col" colspan="7" style="background-color: #FFF;">Esse valor "VEA" seria o lucro extraordinário obtido pela empresa no período </th>

            </tr>
            
            <tr>
                
                <?php $vea = $lucro_operacional_2 - ($investimento * $cmpc); ?>

                <th width="40%" scope="col" colspan="4">VEA = LUCRO OPERACIONAL - (INVESTIMENTOxCMPC)</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"><b>VEA =</b></th>
                <th width="20%" scope="col"><b>R$ <?= number_format($vea, 2, ',', '.') ?></b></th>

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

                <?php $goodwill = ($cmpc != 0) ? $vea / $cmpc : 0; ?>
                
                <th width="40%" scope="col" colspan="4"><b>GOODWILL = VEA</b></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"><b>R$ <?= number_format($vea, 2, ',', '.') ?></b></th>
                <th width="20%" scope="col"><b>R$ <?= number_format($goodwill, 2, ',', '.') ?></b></th>

            </tr>

            <tr>

                <th width="40%" scope="col" colspan="4">CMPC</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"><?= number_format($cmpc, 2, ',', '.') ?>%</th>
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
                <th width="20%" scope="col"><b>R$ <?= number_format($patrimonio_liquido + $goodwill, 2, ',', '.') ?></b></th>

            </tr>

        </tbody>

    </table>
    
    <p class="text-center"><b>ANÁLISE DE INDICADORES DE DESEMPENHO</b></p>
    
    <p>Esses indicadores, tem com objetivo a análise da empresa sob o ponto de vista econômico de rentabilidade, e oferecem importantes entendimentos sobre o desempenho da empresa nos períodos considerados. </p>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php $margem_bruta = ($receita_operacional_liquida != 0) ? $lucro_bruto / $receita_operacional_liquida : 0; ?>

                <th width="20%" scope="col"><b>MARGEM BRUTA</b></th>
                <th width="20%" scope="col">Lucro Bruto</th>
                <th width="20%" scope="col">R$ <?= number_format($lucro_bruto, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($margem_bruta, 2, ',', '.') ?>%</b></th>
                <th width="20%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Receita Líquida de Vendas</th>
                <th width="20%" scope="col">R$ <?= number_format($receita_operacional_liquida, 2, ',', '.') ?></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php $margem_liquida_2 = ($receita_operacional_liquida != 0) ? $lucro_liquido / $receita_operacional_liquida : 0; ?>

                <th width="20%" scope="col"><b>MARGEM LÍQUIDA</b></th>
                <th width="20%" scope="col">Lucro Líquido</th>
                <th width="20%" scope="col">R$ <?= number_format($lucro_liquido, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($margem_liquida_2, 2, ',', '.') ?>%</b></th>
                <th width="20%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Receita Líquida de Vendas</th>
                <th width="20%" scope="col">R$ <?= number_format($receita_operacional_liquida, 2, ',', '.') ?></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php 
                
                    $patrimonio_liquido_2 = $patrimonio_liquido - $lucro_liquido;
                    $retorno_patrimonio = ($patrimonio_liquido_2 != 0) ? $lucro_liquido / $patrimonio_liquido_2 : 0;
                    
                ?>

                <th width="20%" scope="col"><b>RETORNO PATRIMÔNIO</b></th>
                <th width="20%" scope="col">Lucro Líquido</th>
                <th width="20%" scope="col">R$ <?= number_format($lucro_liquido, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($retorno_patrimonio, 2, ',', '.') ?>%</b></th>
                <th width="20%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Patrimônio Líquido</th>
                <th width="20%" scope="col">R$ <?= number_format($patrimonio_liquido_2, 2, ',', '.') ?></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php $liquidez_corrente = ($passivo_circulante != 0) ? $ativo_circulante / $passivo_circulante : 0; ?>

                <th width="20%" scope="col"><b>LIQUIDEZ CORRENTE</b></th>
                <th width="20%" scope="col">Ativo Circulante</th>
                <th width="20%" scope="col">R$ <?= number_format($ativo_circulante, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($liquidez_corrente, 2, ',', '.') ?></b></th>
                <th width="20%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Passivo Circulante</th>
                <th width="20%" scope="col">R$ <?= number_format($passivo_circulante, 2, ',', '.') ?></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php 
                
                    $ativo_circulante_corrente = $ativo_circulante - $estoque;
                    $liquidez_seca = ($passivo_circulante != 0) ? $ativo_circulante_corrente / $passivo_circulante : 0; 
                    
                ?>

                <th width="20%" scope="col"><b>LIQUIDEZ SECA</b></th>
                <th width="20%" scope="col">Ativo Circulante-estoque</th>
                <th width="20%" scope="col">R$ <?= number_format($ativo_circulante_corrente, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($liquidez_seca, 2, ',', '.') ?></b></th>
                <th width="20%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Passivo Circulante</th>
                <th width="20%" scope="col">R$ <?= number_format($passivo_circulante, 2, ',', '.') ?></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php 
                
                    $disponibilidade_aplicacoes_financeiras = $disponibilidade + $aplicacoes_financeiras;
                    $liquidez_imediata = ($passivo_circulante != 0) ? $disponibilidade_aplicacoes_financeiras / $passivo_circulante : 0; 
                    
                ?>

                <th width="20%" scope="col"><b>LIQUIDEZ IMEDIATA</b></th>
                <th width="20%" scope="col">Disponibidades + Aplicações Financeiras</th>
                <th width="20%" scope="col">R$ <?= number_format($disponibilidade_aplicacoes_financeiras, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($liquidez_imediata, 2, ',', '.') ?></b></th>
                <th width="20%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Passivo Circulante</th>
                <th width="20%" scope="col">R$ <?= number_format($passivo_circulante, 2, ',', '.') ?></th>
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
                <th width="20%" scope="col">R$ <?= number_format($ativo_circulante, 2, ',', '.') ?></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"><b>R$ <?= number_format($ativo_circulante - $passivo_circulante, 2, ',', '.') ?></b></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Passivo Circulante</th>
                <th width="20%" scope="col">R$ <?= number_format($passivo_circulante, 2, ',', '.') ?></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <?php $liquidez_geral = (($passivo_circulante + $passivo_nao_circulante) != 0) ? ($ativo_circulante + $ativo_nao_circulante) / ($passivo_circulante + $passivo_nao_circulante) : 0; ?>
                
                <th width="20%" scope="col"><b>LIQUIDEZ GERAL</b></th>
                <th width="20%" scope="col">A.C + ARLP</th>
                <th width="20%" scope="col">R$ <?= number_format($ativo_circulante + $ativo_nao_circulante, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($liquidez_geral, 2, ',', '.') ?></b></th>
                <th width="20%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">PC + PELP </th>
                <th width="20%" scope="col">R$ <?= number_format($passivo_circulante + $passivo_nao_circulante, 2, ',', '.') ?></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php $retorno_sinv_total = ($ativo_total != 0) ? $lucro_liquido / $ativo_total : 0; ?>

                <th width="20%" scope="col"><b>RETORNO S/INV TOTAL</b></th>
                <th width="20%" scope="col">LL</th>
                <th width="20%" scope="col">R$ <?= number_format($lucro_liquido, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($retorno_sinv_total, 2, ',', '.') ?>%</b></th>
                <th width="20%" scope="col">Lucratividade</th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Ativo Total</th>
                <th width="20%" scope="col">R$ <?= number_format($ativo_total, 2, ',', '.') ?></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php $indice_eficiencia = ($receita_operacional_liquida != 0) ? $despesa_administrativa / $receita_operacional_liquida : 0; ?>

                <th width="20%" scope="col"><b>INDICE DE EFICIÊNCIA</b></th>
                <th width="20%" scope="col">Despesas Operacionais</th>
                <th width="20%" scope="col">R$ <?= number_format($despesa_administrativa, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($indice_eficiencia, 2, ',', '.') ?>%</b></th>
                <th width="20%" scope="col">Produtividade</th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Receita Operacional Líquida</th>
                <th width="20%" scope="col">R$ <?= number_format($receita_operacional_liquida, 2, ',', '.') ?></th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>

    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>
                
                <?php $grau_endividamento = ($patrimonio_liquido != 0) ? ($passivo_circulante + $passivo_nao_circulante) / $patrimonio_liquido : 0; ?>

                <th width="20%" scope="col"><b>GRAU DE ENDIVIDAMENTO</b></th>
                <th width="20%" scope="col">PC + PELP</th>
                <th width="20%" scope="col">R$ <?= number_format($passivo_circulante + $passivo_nao_circulante, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($grau_endividamento, 2, ',', '.') ?></b></th>
                <th width="20%" scope="col">GE</th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">PL</th>
                <th width="20%" scope="col">R$ <?= number_format($patrimonio_liquido, 2, ',', '.') ?></th>
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
                <th width="20%" scope="col">#</th>
                <th width="20%" scope="col"><b>#</b></th>
                <th width="20%" scope="col">#</th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Despesas Estimadas</th>
                <th width="20%" scope="col">#</th>
                <th width="20%" scope="col"></th>
                <th width="20%" scope="col"></th>
                
            </tr>

        </tbody>

    </table>
    
    <table class="table table-indicador table-condensed">

        <tbody>

            <tr>

                <?php $imobilizacao_pl = ($patrimonio_liquido != 0) ? $ativo_permanente / $patrimonio_liquido : 0; ?>
                
                <th width="20%" scope="col"><b>IMOBILIZAÇÃO DO PL</b></th>
                <th width="20%" scope="col">Imobilizado</th>
                <th width="20%" scope="col">R$ <?= number_format($ativo_permanente, 2, ',', '.') ?></th>
                <th width="20%" scope="col"><b><?= number_format($imobilizacao_pl, 2, ',', '.') ?></b></th>
                <th width="20%" scope="col"></th>
                
            </tr>
            
            <tr>

                <th width="20%" scope="col"></th>
                <th width="20%" scope="col">Patrimônio Líquido</th>
                <th width="20%" scope="col">R$ <?= number_format($patrimonio_liquido, 2, ',', '.') ?></th>
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

                <?php $indice_kanitz = ((0.05 * $retorno_patrimonio) + (1.65 * $liquidez_geral) + 
                        (3.55 * $liquidez_seca)) - ((1.06 * $liquidez_corrente) + (0.33 * $grau_endividamento)) ?>
                
                <th width="40%" scope="col">LG: Liquidez Geral</th>
                <th width="30%" scope="col"></th>
                <th width="30%" scope="col" style="background-color: orange; border: 2px solid black;"><span>Índice Kanitz:</span> <span class="text-right"><b><?= number_format($indice_kanitz, 2, ',', '.') ?></b></span> </th>
                
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