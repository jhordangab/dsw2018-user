<?php

$css = <<<CSS
    
    .table.table-indicador
    {
        background-color: #dbe7c4;
        border: 1px solid black;
    }
        
    .table.table-indicador > tbody > tr > th
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
        
<!--        <table class="table table-indicador table-condensed">

            <tbody>

                <tr>

                    <th scope="col" colspan="4"><b>DRE</b></th>
                    <th scope="col"></th>

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
                        <th scope="col"></th>
                        <th scope="col">R$ <?= number_format($dac['valor'], 2, ',', '.') ?></th>
                        <th scope="col"></th>

                    </tr>
                
                <?php endforeach; ?>
                    
                <?php foreach($dados_ativo_circulante as $dac) : ?>
                
                    <tr>

                        <th scope="col"></th>
                        <th scope="col"><?= $dac['nome'] ?></th>
                        <th scope="col"></th>
                        <th scope="col">R$ <?= number_format($dac['valor'], 2, ',', '.') ?></th>
                        <th scope="col"></th>

                    </tr>
                
                <?php endforeach; ?>
                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="2"><b>Lucro Líquido</b></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($ativo_permanente['valor'], 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
            </tbody>

        </table>
        
        <table class="table table-indicador table-condensed">

            <tbody>

                <tr>

                    <th scope="col" colspan="4"><b>CÁLCULO DO LUCRO OPERACIONAL APÓS O IR</b></th>
                    <th scope="col"></th>

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
                        <th scope="col"></th>
                        <th scope="col">R$ <?= number_format($dac['valor'], 2, ',', '.') ?></th>
                        <th scope="col"></th>

                    </tr>
                
                <?php endforeach; ?>
                    
                <?php foreach($dados_ativo_circulante as $dac) : ?>
                
                    <tr>

                        <th scope="col"></th>
                        <th scope="col"><?= $dac['nome'] ?></th>
                        <th scope="col"></th>
                        <th scope="col">R$ <?= number_format($dac['valor'], 2, ',', '.') ?></th>
                        <th scope="col"></th>

                    </tr>
                
                <?php endforeach; ?>
                
                <tr>

                    <th scope="col" colspan="5"></th>

                </tr>
                
                <tr>

                    <th scope="col" colspan="2"><b>Lucro Líquido</b></th>
                    <th scope="col"></th>
                    <th scope="col">R$ <?= number_format($ativo_permanente['valor'], 2, ',', '.') ?></th>
                    <th scope="col"></th>

                </tr>
                
            </tbody>

        </table>-->
        
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
                    <th scope="col"><b>12%</b></th>

                </tr>
                
            </tbody>

        </table>
        
    </div>
    
</div>