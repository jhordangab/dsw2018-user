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

$sum = [];
$sum['total'] = 0;
      
?>

<table class="table table-condensed table-bordered table-balancete">

    <thead>

        <tr class="title-category" style="background-color: #237486; color: #FFF;">

            <th scope="col"></th>
            
            <th scope="col">OUTRAS RECEITAS / DESPESAS</th>
            
            <?php foreach($meses as $xs => $mes): $sum[$xs] = 0; ?>
            
                <th scope="col" class="text-center"><?= $mes ?></th>
                            
            <?php endforeach; ?>
                
            <th scope="col" class="text-center">TOTAL</th>

        </tr>

    </thead>

    <tbody class="body-valor">
        
        <?php foreach($dados as $dado): 
            
                if($dado['class'] == 'value')
                {
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
                    $sum['total'] += $dado["total"];
                }
                
        ?>
            
            <tr class="<?= ($dado["class"] == 'value') ? 'graph' : 'title-category' ; ?>" data-json='<?= json_encode($dado); ?>'>

                <td style="text-align: left;"><?= $dado["codigo"]; ?></td>

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
                                
                <td><?= number_format(($dado["jan"] * -1), 2, ',', '.'); ?></td>
                
                <td><?= number_format(($dado["feb"] * -1), 2, ',', '.'); ?></td>
                
                <td><?= number_format(($dado["mar"] * -1), 2, ',', '.'); ?></td>
                
                <td><?= number_format(($dado["apr"] * -1), 2, ',', '.'); ?></td>
                
                <td><?= number_format(($dado["may"] * -1), 2, ',', '.'); ?></td>
                
                <td><?= number_format(($dado["jun"] * -1), 2, ',', '.'); ?></td>
                
                <td><?= number_format(($dado["jul"] * -1), 2, ',', '.'); ?></td>
                
                <td><?= number_format(($dado["aug"] * -1), 2, ',', '.'); ?></td>
                
                <td><?= number_format(($dado["sep"] * -1), 2, ',', '.'); ?></td>
                
                <td><?= number_format(($dado["oct"] * -1), 2, ',', '.'); ?></td>
                
                <td><?= number_format(($dado["nov"] * -1), 2, ',', '.'); ?></td>
                
                <td><?= number_format(($dado["dez"] * -1), 2, ',', '.'); ?></td>
                
                <td><b><?= number_format(($dado["total"] * -1), 2, ',', '.'); ?></b></td>

            </tr>
 
        <?php endforeach; ?>
            
        <tr class="title-category sum">

            <td colspan="2" style="text-align: left;"><b>TOTAL</b></td>  
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= number_format(($sum[$i] * -1), 2, ',', '.'); ?></td>
            
            <?php endfor; ?>

            <td><?= number_format(($sum["total"] * -1), 2, ',', '.'); ?></td>

        </tr>
            
    </tbody>

</table>