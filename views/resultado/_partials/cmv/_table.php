<?php

$css = <<<CSS
        
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
    {
        padding: 2px;
        font-size: 10px;
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
    1 => 'JANEIRO',
    2 => 'FEVEREIRO',
    3 => 'MARÇO',
    4 => 'ABRIL',
    5 => 'MAIO',
    6 => 'JUNHO',
    7 => 'JULHO',
    8 => 'AGOSTO',
    9 => 'SETEMBRO',
    10 => 'OUTUBRO',
    11 => 'NOVEMBRO',
    12 => 'DEZEMBRO'
];

$apelidos = 
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
                    
                endforeach;
                
                foreach($model->meses as $mes): 
            ?>
            
            <th scope="col" class="text-center"><?= $meses[$mes]; ?></th>
                            
            <?php endforeach; ?>
                
            <th scope="col" class="text-center">TOTAL (ANO)</th>

        </tr>

    </thead>

    <tbody class="body-valor">
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col" colspan="1">REVENDA GERAL</th>
                
            <th scope="col" colspan="13" class="text-center"></th>

        </tr>

        <?php if(isset($dados['RECEITA COM VENDAS'])) : ?>
        
            <?php foreach($dados['RECEITA COM VENDAS'] as $dado): 

                $rv['total'] += $dado["total"];
                $vv['total'] += $dado["total"];
                $dv['total'] += $dado["total"];

            ?>

                <tr class="graph">

                    <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  

                    <?php 
                    
                        foreach($meses as $xs => $mes):

                            $rv[$xs] += $dado[$apelidos[$xs]];

                            if($dado['descricao'] == 'VENDAS A VISTA')
                            {
                                $vv[$xs] += $dado[$apelidos[$xs]];
                            }
                            elseif($dado['descricao'] == 'VENDAS A PRAZO')
                            {
                                $vp[$xs] += $dado[$apelidos[$xs]];
                            }
                            elseif($dado['descricao'] == 'DEVOLUCAO DE VENDAS')
                            {
                                $dv[$xs] += $dado[$apelidos[$xs]];
                        } 

                        endforeach;
                    
                        foreach($model->meses as $mes):
                        
                    ?>

                        <td><?= number_format($dado[$apelidos[$mes]], 2, ',', '.'); ?></td>

                    <?php endforeach; ?>

                    <td><?= number_format($dado["total"], 2, ',', '.'); ?></td>

                </tr>        

            <?php endforeach; ?>
                
        <?php endif; ?>

        <tr class="title-category" style="background-color: #235a69; color: #FFF;">

            <th scope="col" colspan="1">RECEITA COM VENDAS</th>
            
            <?php foreach($model->meses as $mes) : ?>
            
                <td><?= number_format($rv[$mes], 2, ',', '.'); ?></td>
            
            <?php endforeach; ?>
                
            <td><?= number_format($rv["total"], 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col" colspan="1">CMV</th>
                
            <th scope="col" colspan="13" class="text-center"></th>

        </tr>
        
        <?php if(isset($dados['CUSTO DAS MERCADORIAS VENDIDAS'])) : ?>
        
            <?php $ei = []; foreach($dados['CUSTO DAS MERCADORIAS VENDIDAS'] as $dado): 

                if($dado['descricao'] == '( - ) ESTOQUE FINAL ')
                {
                    foreach($meses as $xs => $mes):

                        $ei[$xs] = $dado[$apelidos[$xs]] * -1;

                    endforeach;
                }

                endforeach;

            ?>
        
            <?php foreach($dados['CUSTO DAS MERCADORIAS VENDIDAS'] as $dado): 

                $cmv['total'] += $dado["total"];

            ?>

                <tr class="graph">

                    <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  

                    <?php foreach($meses as $xs => $mes):

                        $tot = 0;

                        if($dado['descricao'] == '( + ) ESTOQUE INICIAL')
                        {
                                $value = ($xs > 1) ? $ei[$xs - 1] : $dado[$apelidos[$xs]];
                                $cmv[$xs] += $value;
                                $tot = $dado[$apelidos[1]];
                                
                                if(in_array($xs, $model->meses)) :
                            ?>

                                <td><?= number_format(($value * -1), 2, ',', '.'); ?></td>

                            <?php
                            
                                endif;
                        }
                        elseif($dado['descricao'] == '( - ) ESTOQUE FINAL ')
                        {
                            $tot = $dado[$apelidos[12]];
                            $cmv[$xs] += $dado[$apelidos[$xs]];
                            
                            if(in_array($xs, $model->meses)) :
                            
                            ?>

                                <td><?= number_format(($dado[$apelidos[$xs]] * -1), 2, ',', '.'); ?></td>

                            <?php
                            
                            endif;
                        }
                        else
                        {
                            $tot = $dado["total"];
                            $cmv[$xs] += $dado[$apelidos[$xs]];
                            
                            if(in_array($xs, $model->meses)) :
                            
                            ?>

                                <td><?= number_format(($dado[$apelidos[$xs]] * -1), 2, ',', '.'); ?></td>

                            <?php
                            
                            endif;
                        }

                    ?>

                    <?php endforeach; ?>

                    <td><?= number_format(($tot * -1), 2, ',', '.'); ?></td>

                </tr>        

            <?php endforeach; ?>
                
        <?php endif; ?>
        
        <tr class="title-category" style="background-color: #235a69; color: #FFF;">

            <th scope="col" colspan="1">CUSTO DAS MERCADORIAS VENDIDAS</th>
            
            <?php foreach($model->meses as $mes) : ?>
            
                <td><?= number_format(($cmv[$mes] * -1), 2, ',', '.'); ?></td>
            
            <?php endforeach; ?>
                
            <td><?= number_format(($cmv["total"] * -1), 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #1f90a9e3; color: #FFF;">

            <th scope="col" colspan="1">MARGEM DE VENDAS</th>
            
            <?php 
            
                foreach($model->meses as $mes) : 
                
                $cos = $vv[$mes] + $vp[$mes] + $dv[$mes];  $ttv = $vv['total'] + $vp['total'] + $dv['total']; 
                
            ?>
            
                <td><?= ($cos != 0) ? number_format((($rv[$mes] + $cmv[$mes]) / $cos) * 100, 2, ',', '.') : 0; ?>%</td>
            
            <?php endforeach; ?>
            
            <td><?= ($ttv != 0) ? number_format((($rv['total'] + $cmv['total']) / $ttv) * 100, 2, ',', '.') : 0; ?>%</td>

        </tr>
        
        <tr class="title-category" style="background-color: #247388; color: #FFF;">

            <th scope="col" colspan="1">RESULTADO</th>
            
            <?php foreach($model->meses as $mes) : ?>
            
                <td><?= number_format((($rv[$mes] + $cmv[$mes])), 2, ',', '.'); ?></td>
            
            <?php endforeach; ?>
            
            <td><?= number_format(($rv["total"] + $cmv["total"]), 2, ',', '.'); ?></td>
            
        </tr>

        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col" colspan="1">INDICADORES SOBRE ESTOQUE</th>

            <th scope="col" colspan="13" class="text-center"></th>

        </tr>
            
    </tbody>

</table>