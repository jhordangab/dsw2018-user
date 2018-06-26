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
        background-color: #247388c2;
        color: #FFF;
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

$sum = [];
$sum['total'] = 0;

?>

<table class="table table-condensed table-bordered table-balancete">

    <thead>

        <tr class="title-category" style="background-color: #237486; color: #FFF;">

            <th scope="col"></th>
            
            <th scope="col">DESPESAS OPERACIONAIS</th>
            
            <?php foreach($model->meses as $mes): $sum[$mes] = 0; ?>
            
            <th scope="col" class="text-center"><?= $meses[$mes]; ?></th>
                            
            <?php endforeach; ?>
                
            <th scope="col" class="text-center">TOTAL (ANO)</th>

        </tr>

    </thead>

    <tbody class="body-valor">
        
        <?php foreach($dados as $dado): 
            
                if($dado['class'] == 'value')
                {
                    foreach($model->meses as $mes)
                    {
                        $sum[$mes] += $dado[$apelidos[$mes]];
                    }

                    $sum['total'] += $dado["total"];
                }
                
        ?>
            
            <tr class="<?= ($dado["class"] == 'value') ? 'graph' : 'title-category' ; ?>">

                <td style="text-align: left;"><?= $dado["codigo"]; ?></td>

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  

                <?php foreach($model->meses as $mes): ?>
                
                    <td><?= number_format($dado[$apelidos[$mes]], 2, ',', '.'); ?></td>
                
                <?php endforeach; ?>
                
                <td><b><?= number_format($dado["total"], 2, ',', '.'); ?></b></td>

            </tr>
 
        <?php endforeach; ?>
            
         <tr class="title-category sum">

            <td colspan="2" style="text-align: left;"><b>TOTAL</b></td>  
            
            <?php foreach($model->meses as $mes) : ?>
            
                <td><?= number_format($sum[$mes], 2, ',', '.'); ?></td>
            
            <?php endforeach; ?>

            <td><?= number_format($sum["total"], 2, ',', '.'); ?></td>

        </tr>
            
    </tbody>

</table>