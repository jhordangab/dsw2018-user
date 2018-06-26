<?php 

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
                
                DEMONSTRATIVO DE DESPESAS
                <br>
                EMPRESA: <?= $empresa->razaoSocial ?>
                <br>
                EXERCÍCIO FISCAL: <?= $ano ?>
                
                
            </td>
                
        </tr>
        
        
    </tbody>

</table>

<table style="font-size: 10px;">

    <thead>

        <tr style="background-color: #237486;">

            <th style="color: #FFFFFFF;" colspan="2">DESPESAS OPERACIONAIS</th>
            
            <?php foreach($meses as $xs => $mes): $sum[$xs] = 0; ?>
            
                <th style="color: #FFFFFFF;" class="text-center"><?= $mes ?></th>
                            
            <?php endforeach; ?>
                
            <th style="color: #FFFFFFF;" class="text-center">TOTAL</th>

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
            
            <tr <?= ($dado["class"] == 'value') ? '' : 'style="background-color: #a5c4d3b5"' ; ?>>

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

            <td style="color: #FFFFFFF; text-align: left;" colspan="2"><b>TOTAL</b></td>  
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td style="color: #FFFFFFF;"><?= number_format($sum[$i], 2, ',', '.'); ?></td>
            
            <?php endfor; ?>

            <td style="color: #FFFFFFF;"><?= number_format($sum["total"], 2, ',', '.'); ?></td>

        </tr>
            
    </tbody>

</table>