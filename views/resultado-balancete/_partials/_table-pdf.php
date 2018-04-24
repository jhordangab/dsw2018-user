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
$sum['si'] = 0;
      
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
                
                BALANCETES
                <br>
                EMPRESA: <?= $empresa->razaoSocial ?>
                <br>
                EXERCÍCIO FISCAL: <?= $ano ?>
                
                
            </td>
                
        </tr>
        
        
    </tbody>

</table>

<table>

    <thead>

        <tr style="background-color: #237486;">

            <th style="color: #FFFFFF;" scope="col" colspan="2">Receita</th>
            
            <th style="color: #FFFFFF;"  scope="col" class="text-center">Saldo Inicial</th>

            <?php 
            
                foreach($meses as $xs => $mes): 
                
                    $sum[$xs] = 0;
            ?>
            
                <th style="color: #FFFFFF;"  scope="col" class="text-center"><?= $mes ?></th>
                            
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
                
                switch ($dado['class'])
                {
                    case 'oneval':
                        $background = '#8fb6c5';
                        break;
                    case 'twoval':
                        $background = '#8fb6c5ad';
                        break;
                    case 'threeval':
                        $background = '#a5c4d3b5';
                        break;
                    case 'fourval':
                        $background = '#bed4e291';
                        break;
                    case 'fiveval':
                        $background = '#d8e4ef54';
                        break;
                    case 'mainval':
                        $background = '#f0f4fb2b';
                        break;
                }
        ?>
        
            <tr style="background-color: <?= $background ?>">

                <td style="text-align: left;"><?= $dado["codigo"]; ?></td>

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
                
                <td style="text-align: center;"><?= number_format((float) $dado["saldo_inicial"], 2, ',', '.'); ?></td>
                
                <td style="text-align: center;"><?= number_format($dado["jan"], 2, ',', '.'); ?></td>
                
                <td style="text-align: center;"><?= number_format($dado["feb"], 2, ',', '.'); ?></td>
                
                <td style="text-align: center;"><?= number_format($dado["mar"], 2, ',', '.'); ?></td>
                
                <td style="text-align: center;"><?= number_format($dado["apr"], 2, ',', '.'); ?></td>
                
                <td style="text-align: center;"><?= number_format($dado["may"], 2, ',', '.'); ?></td>
                
                <td style="text-align: center;"><?= number_format($dado["jun"], 2, ',', '.'); ?></td>
                
                <td style="text-align: center;"><?= number_format($dado["jul"], 2, ',', '.'); ?></td>
                
                <td style="text-align: center;"><?= number_format($dado["aug"], 2, ',', '.'); ?></td>
                
                <td style="text-align: center;"><?= number_format($dado["sep"], 2, ',', '.'); ?></td>
                
                <td style="text-align: center;"><?= number_format($dado["oct"], 2, ',', '.'); ?></td>
                
                <td style="text-align: center;"><?= number_format($dado["nov"], 2, ',', '.'); ?></td>
                
                <td style="text-align: center;"><?= number_format($dado["dez"], 2, ',', '.'); ?></td>
                
            </tr>

        <?php endforeach; ?> 
            
        <tr class="sum" style="background-color: #237486;">

            <td style="color: #FFFFFF; text-align: left;" colspan="2"><b>TOTAL</b></td>  

            <td style="color: #FFFFFF; text-align: center;"><?= number_format($sum["si"], 2, ',', '.'); ?></td>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td style="color: #FFFFFF; text-align: center;"><?= number_format($sum[$i], 2, ',', '.'); ?></td>
            
            <?php endfor; ?>

        </tr>
            
    </tbody>

</table>