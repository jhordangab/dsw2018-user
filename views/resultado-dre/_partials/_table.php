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
        background-color: #247388c2;
        color: #FFF;
    }
        
    .table-balancete > tbody > tr.cools,
    .table-balancete > thead > tr.cools
    {
        background-color: #bed4e291;
    }
        
    .body-valor tr td
    {
        text-align: center;
    }
        
    .body-valor tr.title-category.sum 
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
      
$ro = [];
$ro['total'] = 0;
$rf = [];
$rf['total'] = 0;
$ord = [];
$ord['total'] = 0;
$do = [];
$do['total'] = 0;

?>

<table class="table table-condensed table-bordered table-balancete">

    <thead>

        <tr class="title-category" style="background-color: #235a69; color: #FFF;">
            
            <th scope="col">DEMONSTRATIVO DO RESULTADO DO EXERCÍCIO</th>
            
            <?php 
            
                foreach($meses as $xs => $mes): 
                
                    $ro[$xs] = 0;
                    $rf[$xs] = 0;
                    $ord[$xs] = 0;
                    $do[$xs] = 0;
            ?>
            
                <th scope="col" class="text-center"><?= $mes ?></th>
                            
            <?php endforeach; ?>
                
            <th scope="col" class="text-center">TOTAL</th>

        </tr>

    </thead>

    <tbody class="body-valor">
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">RECEITAS OPERACIONAIS</th>
                
            <th scope="col" colspan="13" class="text-center"></th>

        </tr>

        <?php foreach($dados['RECEITAS OPERACIONAIS'] as $dado): 
            
            $ro[1] += $dado["jan"];
            $ro[2] += $dado["feb"];
            $ro[3] += $dado["mar"];
            $ro[4] += $dado["apr"];
            $ro[5] += $dado["may"];
            $ro[6] += $dado["jun"];
            $ro[7] += $dado["jul"];
            $ro[8] += $dado["aug"];
            $ro[9] += $dado["sep"];
            $ro[10] += $dado["oct"];
            $ro[11] += $dado["nov"];
            $ro[12] += $dado["dez"];
            $ro['total'] += $dado["total"];
            
        ?>
            
            <tr class="graph" data-json='<?= json_encode($dado); ?>'>

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
        
        <tr class="title-category" style="background-color: #247388; color: #FFF;">

            <th scope="col">RECEITAS OPERACIONAIS LÍQUIDAS</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= number_format($ro[$i], 2, ',', '.'); ?></td>
            
            <?php endfor; ?>
                
            <td><?= number_format($ro["total"], 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">CMV</th>
                
            <th scope="col" colspan="13" class="text-center"></th>

        </tr>
        
        <?php foreach($dados['CMV'] as $dado): 
            
            ?>
            
            <tr class="graph" data-json='<?= json_encode($dado); ?>'>

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
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">DESPESAS OPERACIONAIS</th>
                
            <th scope="col" colspan="13" class="text-center"></th>

        </tr>

        <?php foreach($dados['DESPESAS OPERACIONAIS'] as $dado): 
            
            $do[1] += $dado["jan"];
            $do[2] += $dado["feb"];
            $do[3] += $dado["mar"];
            $do[4] += $dado["apr"];
            $do[5] += $dado["may"];
            $do[6] += $dado["jun"];
            $do[7] += $dado["jul"];
            $do[8] += $dado["aug"];
            $do[9] += $dado["sep"];
            $do[10] += $dado["oct"];
            $do[11] += $dado["nov"];
            $do[12] += $dado["dez"];
            $do['total'] += $dado["total"];
            
        ?>
            
            <tr class="graph" data-json='<?= json_encode($dado); ?>'>

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
        
        <tr class="title-category" style="background-color: #247388; color: #FFF;">

            <th scope="col">TOTAL DAS DESPESAS OPERACIONAIS</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= number_format($do[$i], 2, ',', '.'); ?></td>
            
            <?php endfor; ?>
                
            <td><?= number_format($do["total"], 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #247388; color: #FFF;">

            <th scope="col">% CUSTO OPERACIONAL</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= ($ro[$i] != 0) ? number_format((($do[$i]/$ro[$i]) * 100), 2, ',', '.') : 0; ?>%</td>
            
            <?php endfor; ?>
                
            <td><?= ($ro["total"] != 0) ? number_format((($do["total"]/$ro["total"]) * 100), 2, ',', '.') : 0; ?>%</td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">RESULTADO FINANCEIRO</th>
                
            <th scope="col" colspan="13" class="text-center"></th>

        </tr>

        <?php foreach($dados['RESULTADO FINANCEIRO'] as $dado): 
            
            $rf[1] += $dado["jan"];
            $rf[2] += $dado["feb"];
            $rf[3] += $dado["mar"];
            $rf[4] += $dado["apr"];
            $rf[5] += $dado["may"];
            $rf[6] += $dado["jun"];
            $rf[7] += $dado["jul"];
            $rf[8] += $dado["aug"];
            $rf[9] += $dado["sep"];
            $rf[10] += $dado["oct"];
            $rf[11] += $dado["nov"];
            $rf[12] += $dado["dez"];
            $rf['total'] += $dado["total"];
            
        ?>
            
            <tr class="graph" data-json='<?= json_encode($dado); ?>'>

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
        
        <tr class="title-category" style="background-color: #247388; color: #FFF;">

            <th scope="col">TOTAL DO RESULTADO FINANCEIRO</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= number_format($rf[$i], 2, ',', '.'); ?></td>
            
            <?php endfor; ?>
                
            <td><?= number_format($rf["total"], 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #247388; color: #FFF;">

            <th scope="col">% RESULTADO FINANCEIRO</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= ($ro[$i] != 0) ? number_format((($rf[$i]/$ro[$i]) * 100), 2, ',', '.') : 0; ?>%</td>
            
            <?php endfor; ?>
                
            <td><?= ($ro["total"] != 0) ? number_format((($rf["total"]/$ro["total"]) * 100), 2, ',', '.') : 0; ?>%</td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">OUTRAS RECEITAS / DESPESAS</th>
                
            <th scope="col" colspan="13" class="text-center"></th>

        </tr>

        <?php foreach($dados['OUTRAS RECEITAS / DESPESAS'] as $dado): 
            
            $ord[1] += $dado["jan"];
            $ord[2] += $dado["feb"];
            $ord[3] += $dado["mar"];
            $ord[4] += $dado["apr"];
            $ord[5] += $dado["may"];
            $ord[6] += $dado["jun"];
            $ord[7] += $dado["jul"];
            $ord[8] += $dado["aug"];
            $ord[9] += $dado["sep"];
            $ord[10] += $dado["oct"];
            $ord[11] += $dado["nov"];
            $ord[12] += $dado["dez"];
            $ord['total'] += $dado["total"];
            
        ?>
            
            <tr class="graph" data-json='<?= json_encode($dado); ?>'>

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
        
        <tr class="title-category" style="background-color: #247388; color: #FFF;">

            <th scope="col">TOTAL DE OUTRAS RECEITAS / DESPESAS</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= number_format($ord[$i], 2, ',', '.'); ?></td>
            
            <?php endfor; ?>
                
            <td><?= number_format($ord["total"], 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #247388; color: #FFF;">

            <th scope="col">% RESULTADO OUTRAS RECEITAS / DESPESAS</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= ($ro[$i] != 0) ? number_format((($ord[$i]/$ro[$i]) * 100), 2, ',', '.') : 0; ?>%</td>
            
            <?php endfor; ?>
                
            <td><?= ($ro["total"] != 0) ? number_format((($ord["total"]/$ro["total"]) * 100), 2, ',', '.') : 0; ?>%</td>
            
        </tr>
        
    </tbody>

</table>