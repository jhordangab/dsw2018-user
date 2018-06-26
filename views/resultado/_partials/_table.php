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
            
                foreach($model->meses as $mes): 
                
                    $sum[$mes] = 0;
            ?>
            
                <th scope="col" class="text-center"><?= $meses[$mes] ?></th>
                            
            <?php endforeach; ?>
                
        </tr>

    </thead>

    <tbody class="body-valor">

        <?php 
        
            foreach($dados as $i => $dado):
            
                if($dado['class'] == 'oneval')
                {
                    $sum['si'] += $dado["saldo_inicial"];
                    
                    foreach($model->meses as $mes):
                    
                        $sum[$mes] += $dado[$apelidos[$mes]];
                        
                    endforeach;
                }
        ?>
        
            <tr class="graph <?= $dado["class"]; ?>" data-json='<?= json_encode($dado); ?>'>

                
                <td style="text-align: left;"><?= $dado["codigo"]; ?></td>

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
                
                <td><?= number_format((float) $dado["saldo_inicial"], 2, ',', '.'); ?></td>
                
                <?php foreach($model->meses as $mes): ?>

                    <td><?= number_format($dado[$apelidos[$mes]], 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                
            </tr>

        <?php endforeach; ?> 
            
        <tr class="sum">

            <td colspan="2" style="text-align: left;"><b>TOTAL</b></td>  

            <td><?= number_format($sum["si"], 2, ',', '.'); ?></td>
            
            <?php foreach($model->meses as $mes): ?>

                <td><?= number_format($sum[$mes], 2, ',', '.'); ?></td>

            <?php endforeach; ?>
            
        </tr>
            
    </tbody>

</table>