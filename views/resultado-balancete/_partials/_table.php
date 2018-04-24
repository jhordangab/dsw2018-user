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
        
    .body-valor tr td
    {
        text-align: center;
    }
        
    .body-valor tr.oneval
    {
        background-color: #24738880;
    }
        
    .body-valor tr.twoval
    {
        background-color: #8fb6c5c9;
    }
        
    .body-valor tr.threeval
    {
        background-color: #a5c4d3b5;
    }
        
    .body-valor tr.fourval
    {
        background-color: #bed4e291;
    }
        
    .body-valor tr.fiveval
    {
        background-color: #d8e4ef54;
    }
        
    .body-valor tr.mainval
    {
        background-color: #f0f4fb2b;
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

$sum = [];
$sum['si'] = 0;
      
?>

<table class="table table-condensed table-bordered table-balancete">

    <thead>

        <tr style="background-color: #237486; color: #FFF;">

            <th scope="col"></th>
            
            <th scope="col">Receita</th>
            
            <th scope="col" class="text-center">Saldo Inicial</th>

            <?php 
            
                foreach($meses as $xs => $mes): 
                
                    $sum[$xs] = 0;
            ?>
            
                <th scope="col" class="text-center"><?= $mes ?></th>
                            
            <?php endforeach; ?>
                
        </tr>

    </thead>

    <tbody class="body-valor">

        <?php 
        
            foreach($dados as $i => $dado):
            
                if($dado['class'] == 'oneval')
                {
                    $sum['si'] += $dado["saldo_inicial"];
                    $sum[1] += $dado["jan"];
                    $sum[2] += $dado["feb"];
                    $sum[3] += $dado["mar"];
                    $sum[4] += $dado["apr"];
                    $sum[5] += $dado["may"];
                    $sum[6] += $dado["jun"];
                    $sum[7] += $dado["jul"];
                    $sum[8] += $dado["aug"];
                    $sum[9] += $dado["sep"];
                    $sum[10] += $dado["oct"];
                    $sum[11] += $dado["nov"];
                    $sum[12] += $dado["dez"];
                }
        ?>
        
            <tr class="graph <?= $dado["class"]; ?>" data-json='<?= json_encode($dado); ?>'>

                <td style="text-align: left;"><?= $dado["codigo"]; ?></td>

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
                
                <td><?= number_format((float) $dado["saldo_inicial"], 2, ',', '.'); ?></td>
                
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
                
            </tr>

        <?php endforeach; ?> 
            
        <tr class="sum">

            <td colspan="2" style="text-align: left;"><b>TOTAL</b></td>  

            <td><?= number_format($sum["si"], 2, ',', '.'); ?></td>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= number_format($sum[$i], 2, ',', '.'); ?></td>
            
            <?php endfor; ?>

        </tr>
            
    </tbody>

</table>