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
      
$df = [];
$df['total'] = 0;
$rf = [];
$rf['total'] = 0;

$h_img = fopen('img/logo.png', "rb");
$img = fread($h_img, filesize('img/logo.png'));
fclose($h_img);

$pic = 'data://text/plain;base64,' . base64_encode($img);

?>

<table>

    <tbody>

        <tr>

            <td colspan="15"> </td>
                
        </tr>
        
        <tr>

            <td colspan="2">
                
                <img width="120px" src="<?= $pic ?>">
                
            </td>
            
            <td colspan="13" style="font-size: 12px;">
                
                DEMONSTRATIVO DO CUSTO DAS MERCADORIAS VENDIDAS
                <br>
                EMPRESA: <?= $empresa->razaoSocial ?>
                <br>
                EXERCÍCIO FISCAL: <?= $ano ?>
                
                
            </td>
                
        </tr>
        
        
    </tbody>

</table>

<table style="font-size: 8px;">

    <thead>

        <tr style="background-color: #235a69;">

            <th style="color: #FFFFFF;" colspan="2" scope="col">RESULTADO FINANCEIRO LÍQUIDO</th>
            
            <?php 
            
                foreach($meses as $xs => $mes): 
                
                    $df[$xs] = 0;
                    $rf[$xs] = 0;
            ?>
            
                <th style="color: #FFFFFF;" scope="col" class="text-center"><?= $mes ?></th>
                            
            <?php endforeach; ?>
                
            <th style="color: #FFFFFF;" scope="col" class="text-center">TOTAL</th>

        </tr>

    </thead>

    <tbody>
        
        <tr style="background-color: #247388c2;">

            <th style="color: #FFFFFF;" scope="col" colspan="2">DESPESAS FINANCEIRAS</th>
                
            <th style="color: #FFFFFF;" scope="col" colspan="13" class="text-center"></th>

        </tr>

        <?php foreach($dados['DESPESAS FINANCEIRAS TOTAIS'] as $dado): 
            
            $df[1] += $dado["jan"];
            $df[2] += $dado["feb"];
            $df[3] += $dado["mar"];
            $df[4] += $dado["apr"];
            $df[5] += $dado["may"];
            $df[6] += $dado["jun"];
            $df[7] += $dado["jul"];
            $df[8] += $dado["aug"];
            $df[9] += $dado["sep"];
            $df[10] += $dado["oct"];
            $df[11] += $dado["nov"];
            $df[12] += $dado["dez"];
            $df['total'] += $dado["total"];
            
        ?>
            
            <tr <?= ($dado["class"] == 'value') ? '' : 'style="background-color: #bed4e291"' ; ?>>

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
        
        <tr style="background-color: #237486;">

            <th style="color: #FFFFFF;" scope="col" colspan="2">TOTAL DAS DESPESAS FINANCEIRAS</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td style="color: #FFFFFF;"><?= number_format($df[$i], 2, ',', '.'); ?></td>
            
            <?php endfor; ?>
                
            <td style="color: #FFFFFF;"><?= number_format($df["total"], 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr style="background-color: #247388c2;">

            <th style="color: #FFFFFF;" scope="col" colspan="2">RECEITAS FINANCEIRAS</th>
                
            <th style="color: #FFFFFF;" scope="col" colspan="13" class="text-center"></th>

        </tr>
        
        <?php foreach($dados['RECEITAS FINANCEIRAS TOTAIS'] as $dado): 
            
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
            
            <tr <?= ($dado["class"] == 'value') ? '' : 'style="background-color: #bed4e291"' ; ?>>

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
        
        
        <tr style="background-color: #237486;">
            
            <th style="color: #FFFFFF;" scope="col" colspan="2">TOTAL DAS RECEITAS FINANCEIRAS</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td style="color: #FFFFFF;"><?= number_format($rf[$i], 2, ',', '.'); ?></td>
            
            <?php endfor; ?>
                
            <td style="color: #FFFFFF;"><?= number_format($rf["total"], 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr style="background-color: #235a69;">
            
            <th style="color: #FFFFFF;" scope="col" colspan="2">RESULTADO FINANCEIRO LÍQUIDO</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td style="color: #FFFFFF;"><?= number_format(($rf[$i] - $df[$i]), 2, ',', '.'); ?></td>
            
            <?php endfor; ?>
            
            <td style="color: #FFFFFF;"><?= number_format(($rf["total"] - $df["total"]), 2, ',', '.'); ?></td>
            
        </tr>
        
    </tbody>

</table>