<?php

$css = <<<CSS
        
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
    {
        padding: 2px;
        font-size: 10px;
    }
        
    .table-balancete
    {
        cursor: pointer;
    }
        
    .table-balancete > tbody > tr:hover
    {
        border: 2px solid #22415a;
    }
        
    .table-balancete > tbody > tr.title-category:hover
    {
        border: none;
    }
        
    .table-balancete > tbody > tr.title-category,
    .table-balancete > thead > tr.title-category
    {
        cursor: text;
    }
        
    .body-valor tr td
    {
        text-align: center;
    }
        
    .body-valor tr.sum 
    {
        font-weight: 600;
        background-color: #237486;
        color: #FFF;
    }
        
CSS;

$this->registerCss($css);

$meses = 
[
    1 => 'Janeiro',
    2 => 'Fevereiro',
    3 => 'Março',
    4 => 'Abril',
    5 => 'Maio',
    6 => 'Junho',
    7 => 'Julho',
    8 => 'Agosto',
    9 => 'Setembro',
    10 => 'Outubro',
    11 => 'Novembro',
    12 => 'Dezembro'
];

$months = 
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

$rv = [];
$rv['total'] = 0;
$cmv = [];
$cmv['total'] = 0;
$vv = [];
$vv['total'] = 0;
$vp = [];
$vp['total'] = 0;
$dv = [];
$dv['total'] = 0;

?>

<table class="table table-condensed table-bordered table-balancete">

    <thead>

        <tr class="title-category" style="background-color: #237486; color: #FFF;">
 
            <th scope="col">DEMONSTRATIVO DE CUSTO DE MERCADORIAS</th>
            
            <?php 
            
                foreach($meses as $xs => $mes): 
                
                    $rv[$xs] = 0;
                    $cmv[$xs] = 0;
                    $vv[$xs] = 0;
                    $vp[$xs] = 0;
                    $dv[$xs] = 0;
            ?>
            
                <th scope="col" class="text-center"><?= $mes ?></th>
                            
            <?php endforeach; ?>
                
            <th scope="col" class="text-center">TOTAL</th>

        </tr>

    </thead>

    <tbody class="body-valor">
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col" colspan="1">REVENDA GERAL</th>
                
            <th scope="col" colspan="13" class="text-center"></th>

        </tr>

        <?php foreach($dados['RECEITA COM VENDAS'] as $dado): 
            
            $rv['total'] += $dado["total"];
            $vv['total'] += $dado["total"];
            $dv['total'] += $dado["total"];
            
        ?>
        
            <tr class="graph" data-json='<?= json_encode($dado); ?>'>

                <!-- <td style="text-align: left;"><?= $dado["codigo"]; ?></td> -->

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
        
                <?php foreach($meses as $xs => $mes):

                    $rv[$xs] += $dado[$months[$xs]];

                    if($dado['descricao'] == 'VENDAS A VISTA')
                    {
                        $vv[$xs] += $dado[$months[$xs]];
                    }
                    elseif($dado['descricao'] == 'VENDAS A PRAZO')
                    {
                        $vp[$xs] += $dado[$months[$xs]];
                    }
                    elseif($dado['descricao'] == 'DEVOLUCAO DE VENDAS')
                    {
                        $dv[$xs] += $dado[$months[$xs]];
                    } 

                ?>

                    <td><?= number_format($dado[$months[$xs]], 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                    
                <td><?= number_format($dado["total"], 2, ',', '.'); ?></td>
                
            </tr>        
                
        <?php endforeach; ?>
            
        <tr class="title-category" style="background-color: #235a69; color: #FFF;">

            <th scope="col" colspan="1">RECEITA COM VENDAS</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= number_format($rv[$i], 2, ',', '.'); ?></td>
            
            <?php endfor; ?>
                
            <td><?= number_format($rv["total"], 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col" colspan="1">CMV</th>
                
            <th scope="col" colspan="13" class="text-center"></th>

        </tr>
        
        <?php $ei = []; foreach($dados['CUSTO DAS MERCADORIAS VENDIDAS'] as $dado): 
            
            if($dado['descricao'] == '( - ) ESTOQUE FINAL ')
            {
                foreach($meses as $xs => $mes):
                    
                    $ei[$xs] = $dado[$months[$xs]] * -1;
                    
                endforeach;
            }
                        
            endforeach;
            
        ?>
        
        <?php foreach($dados['CUSTO DAS MERCADORIAS VENDIDAS'] as $dado): 
            
            $cmv['total'] += $dado["total"];
            
        ?>
        
            <tr class="graph" data-json='<?= json_encode($dado); ?>'>

                <!-- <td style="text-align: left;"><?= $dado["codigo"]; ?></td> -->

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
        
                <?php foreach($meses as $xs => $mes):
                    
                    $tot = 0;
                    
                    if($dado['descricao'] == '( + ) ESTOQUE INICIAL')
                    {
                            $value = ($xs > 1) ? $ei[$xs - 1] : $dado[$months[$xs]];
                            $cmv[$xs] += $value;
                            $tot = $dado[$months[1]];
                        ?>
                
                            <td><?= number_format(($value * -1), 2, ',', '.'); ?></td>
                            
                        <?php
                    }
                    elseif($dado['descricao'] == '( - ) ESTOQUE FINAL ')
                    {
                        $tot = $dado[$months[12]];
                        $cmv[$xs] += $dado[$months[$xs]];
                        ?>
                
                            <td><?= number_format(($dado[$months[$xs]] * -1), 2, ',', '.'); ?></td>
                            
                        <?php
                    }
                    else
                    {
                        $tot = $dado["total"];
                        $cmv[$xs] += $dado[$months[$xs]];
                        ?>
                
                            <td><?= number_format(($dado[$months[$xs]] * -1), 2, ',', '.'); ?></td>
                            
                        <?php
                    }
                
                ?>
                                
                <?php endforeach; ?>
                    
                <td><?= number_format(($tot * -1), 2, ',', '.'); ?></td>
                
            </tr>        
                
        <?php endforeach; ?>
        
        <tr class="title-category" style="background-color: #235a69; color: #FFF;">

            <th scope="col" colspan="1">CUSTO DAS MERCADORIAS VENDIDAS</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= number_format(($cmv[$i] * -1), 2, ',', '.'); ?></td>
            
            <?php endfor; ?>
                
            <td><?= number_format(($cmv["total"] * -1), 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #1f90a9e3; color: #FFF;">

            <th scope="col" colspan="1">MARGEM DE VENDAS</th>
            
            <?php for($i = 1; $i <= 12; $i++) : $cos = $vv[$i] + $vp[$i] + $dv[$i];  $ttv = $vv['total'] + $vp['total'] + $dv['total']; ?>
            
                <td><?= ($cos != 0) ? number_format((($rv[$i] + $cmv[$i]) / $cos) * 100, 2, ',', '.') : 0; ?>%</td>
            
            <?php endfor; ?>
            
            <td><?= ($ttv != 0) ? number_format((($rv['total'] + $cmv['total']) / $ttv) * 100, 2, ',', '.') : 0; ?>%</td>

        </tr>
        
        <tr class="title-category" style="background-color: #247388; color: #FFF;">

            <th scope="col" colspan="1">RESULTADO</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= number_format((($rv[$i] + $cmv[$i])), 2, ',', '.'); ?></td>
            
            <?php endfor; ?>
            
            <td><?= number_format(($rv["total"] + $cmv["total"]), 2, ',', '.'); ?></td>
            
        </tr>

        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col" colspan="1">INDICADORES SOBRE ESTOQUE</th>

            <th scope="col" colspan="13" class="text-center"></th>

        </tr>
            
    </tbody>

</table>