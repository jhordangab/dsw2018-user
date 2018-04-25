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

            <th scope="col"></th>
            
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

            <th scope="col" colspan="2">REVENDA GERAL</th>
                
            <th scope="col" colspan="13" class="text-center"></th>

        </tr>

        <?php foreach($dados['RECEITA COM VENDAS'] as $dado): 
            
            $rv[1] += $dado["jan"];
            $rv[2] += $dado["feb"];
            $rv[3] += $dado["mar"];
            $rv[4] += $dado["apr"];
            $rv[5] += $dado["may"];
            $rv[6] += $dado["jun"];
            $rv[7] += $dado["jul"];
            $rv[8] += $dado["aug"];
            $rv[9] += $dado["sep"];
            $rv[10] += $dado["oct"];
            $rv[11] += $dado["nov"];
            $rv[12] += $dado["dez"];
            $rv['total'] += $dado["total"];
            
            if($dado['descricao'] == 'VENDAS A VISTA')
            {
                $vv[1] += $dado["jan"];
                $vv[2] += $dado["feb"];
                $vv[3] += $dado["mar"];
                $vv[4] += $dado["apr"];
                $vv[5] += $dado["may"];
                $vv[6] += $dado["jun"];
                $vv[7] += $dado["jul"];
                $vv[8] += $dado["aug"];
                $vv[9] += $dado["sep"];
                $vv[10] += $dado["oct"];
                $vv[11] += $dado["nov"];
                $vv[12] += $dado["dez"];
                $vv['total'] += $dado["total"];
            }
            elseif($dado['descricao'] == 'VENDAS A PRAZO')
            {
                $vp[1] += $dado["jan"];
                $vp[2] += $dado["feb"];
                $vp[3] += $dado["mar"];
                $vp[4] += $dado["apr"];
                $vp[5] += $dado["may"];
                $vp[6] += $dado["jun"];
                $vp[7] += $dado["jul"];
                $vp[8] += $dado["aug"];
                $vp[9] += $dado["sep"];
                $vp[10] += $dado["oct"];
                $vp[11] += $dado["nov"];
                $vp[12] += $dado["dez"];
                $vp['total'] += $dado["total"];
            }
            elseif($dado['descricao'] == 'DEVOLUCAO DE VENDAS')
            {
                $dv[1] += $dado["jan"];
                $dv[2] += $dado["feb"];
                $dv[3] += $dado["mar"];
                $dv[4] += $dado["apr"];
                $dv[5] += $dado["may"];
                $dv[6] += $dado["jun"];
                $dv[7] += $dado["jul"];
                $dv[8] += $dado["aug"];
                $dv[9] += $dado["sep"];
                $dv[10] += $dado["oct"];
                $dv[11] += $dado["nov"];
                $dv[12] += $dado["dez"];
                $dv['total'] += $dado["total"];
            }
            
        ?>
            
            <tr class="graph" data-json='<?= json_encode($dado); ?>'>

                <td style="text-align: left;"><?= $dado["codigo"]; ?></td>

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
                                
                <td><?= number_format($dado["jan"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["feb"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["mar"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["apr"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["may"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["jun"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["jul"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["aug"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["sep"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["oct"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["nov"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["dez"], 2, ',', '.'); ?></td>
                
                <td><b><?= number_format($dado["total"], 2, ',', '.'); ?></b></td>

            </tr>
 
        <?php endforeach; ?>
        
        <tr class="title-category" style="background-color: #235a69; color: #FFF;">

            <th scope="col" colspan="2">RECEITA COM VENDAS</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= number_format($rv[$i], 2, ',', '.'); ?></td>
            
            <?php endfor; ?>
                
            <td><?= number_format($rv["total"], 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col" colspan="2">CMV</th>
                
            <th scope="col" colspan="13" class="text-center"></th>

        </tr>
        
        <?php foreach($dados['CUSTO DAS MERCADORIAS VENDIDAS'] as $dado): 
            
            $cmv[1] += $dado["jan"];
            $cmv[2] += $dado["feb"];
            $cmv[3] += $dado["mar"];
            $cmv[4] += $dado["apr"];
            $cmv[5] += $dado["may"];
            $cmv[6] += $dado["jun"];
            $cmv[7] += $dado["jul"];
            $cmv[8] += $dado["aug"];
            $cmv[9] += $dado["sep"];
            $cmv[10] += $dado["oct"];
            $cmv[11] += $dado["nov"];
            $cmv[12] += $dado["dez"];
            $cmv['total'] += $dado["total"];
            
            ?>
            
            <tr class="graph" data-json='<?= json_encode($dado); ?>'>

                <td style="text-align: left;"><?= $dado["codigo"]; ?></td>

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
                                
                <td><?= number_format($dado["jan"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["feb"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["mar"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["apr"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["may"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["jun"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["jul"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["aug"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["sep"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["oct"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["nov"], 2, ',', '.'); ?></td>
                
                <td><?= number_format($dado["dez"], 2, ',', '.'); ?></td>
                
                <td><b><?= number_format($dado["total"], 2, ',', '.'); ?></b></td>

            </tr>
 
        <?php endforeach; ?>
        
        
        <tr class="title-category" style="background-color: #235a69; color: #FFF;">

            <th scope="col" colspan="2">CUSTO DAS MERCADORIAS VENDIDAS</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= number_format($cmv[$i], 2, ',', '.'); ?></td>
            
            <?php endfor; ?>
                
            <td><?= number_format($cmv["total"], 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #1f90a9e3; color: #FFF;">

            <th scope="col" colspan="2">MARGEM DE VENDAS</th>
            
            <?php for($i = 1; $i <= 12; $i++) : $cos = $vv[$i] + $vp[$i] + $dv[$i];  $ttv = $vv['total'] + $vp['total'] + $dv['total']; ?>
            
                <td><?= ($cos != 0) ? number_format((($rv[$i] + $cmv[$i]) / $cos) * 100, 2, ',', '.') : 0; ?>%</td>
            
            <?php endfor; ?>
            
            <td><?= ($ttv != 0) ? number_format((($rv['total'] + $cmv['total']) / $ttv) * 100, 2, ',', '.') : 0; ?>%</td>

        </tr>
        
        <tr class="title-category" style="background-color: #247388; color: #FFF;">

            <th scope="col" colspan="2">RESULTADO</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= number_format((($rv[$i] + $cmv[$i])), 2, ',', '.'); ?></td>
            
            <?php endfor; ?>
            
            <td><?= number_format(($rv["total"] + $cmv["total"]), 2, ',', '.'); ?></td>
            
        </tr>
            
    </tbody>

</table>