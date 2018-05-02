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
$sum['ACLA']['TOTAL'] = 0;
$sum['ARAO']['TOTAL'] = 0;
$sum['ARPO']['TOTAL'] = 0;
$sum['FCAI']['TOTAL'] = 0;
$sum['FCAF']['TOTAL'] = 0;
$sum['DFCTOT']['TOTAL'] = 0;
      
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
                
                DEMONSTRATIVO DE FLUXO DE CAIXA
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

            <th scope="col"></th>
            
            <?php 
            
                foreach($meses as $xs => $mes): 
                
                    $sum['ACLA'][$xs] = 0;
                    $sum['ARAO'][$xs] = 0;
                    $sum['ARPO'][$xs] = 0;
                    $sum['FCAI'][$xs] = 0;
                    $sum['FCAF'][$xs] = 0;
                    $sum['DFCTOT'][$xs] = 0;
            ?>
            
                <th style="color: #FFFFFFF;" scope="col" class="text-center"><?= $mes ?></th>
                            
            <?php endforeach; ?>
                
            <th scope="col" style="color: #FFFFFFF;" class="text-center">Totais</th>
                
        </tr>

    </thead>

    <tbody class="body-valor">

        <?php 
        
            foreach($dados["LL"] as $i => $dado):
                
                $sum['ACLA'][1] += $dado["jan"];
                $sum['ACLA'][2] += $dado["feb"];
                $sum['ACLA'][3] += $dado["mar"];
                $sum['ACLA'][4] += $dado["apr"];
                $sum['ACLA'][5] += $dado["may"];
                $sum['ACLA'][6] += $dado["jun"];
                $sum['ACLA'][7] += $dado["jul"];
                $sum['ACLA'][8] += $dado["aug"];
                $sum['ACLA'][9] += $dado["sep"];
                $sum['ACLA'][10] += $dado["oct"];
                $sum['ACLA'][11] += $dado["nov"];
                $sum['ACLA'][12] += $dado["dez"];
                $sum['ACLA']['TOTAL'] += $dado["dez"];
        ?>
        
            <tr style="background-color: #a5c4d3b5">

                <td style="text-align: left;"><b><?= $dado["descricao"]; ?></b></td>

                <td><b><?= number_format($dado["jan"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["feb"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["mar"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["apr"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["may"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["jun"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["jul"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["aug"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["sep"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["oct"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["nov"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["dez"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["total"], 2, ',', '.'); ?></b></td>
                
            </tr>

        <?php endforeach; ?> 
            
        <tr>

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr style="background-color: #a5c4d3b5">

            <td scope="col">Ajuste para conciliar o lucro antes do IR e da CSLL com o caixa líquido gerado pelas atividades operacionais</td>
            
            <td scope="col" colspan="13">&nbsp;</td>
                
        </tr>

        <?php 
        
            foreach($dados["ACLA"] as $i => $dado):
                
                $sum['ACLA'][1] += $dado["jan"];
                $sum['ACLA'][2] += $dado["feb"];
                $sum['ACLA'][3] += $dado["mar"];
                $sum['ACLA'][4] += $dado["apr"];
                $sum['ACLA'][5] += $dado["may"];
                $sum['ACLA'][6] += $dado["jun"];
                $sum['ACLA'][7] += $dado["jul"];
                $sum['ACLA'][8] += $dado["aug"];
                $sum['ACLA'][9] += $dado["sep"];
                $sum['ACLA'][10] += $dado["oct"];
                $sum['ACLA'][11] += $dado["nov"];
                $sum['ACLA'][12] += $dado["dez"];
                $sum['ACLA']['TOTAL'] += $dado["dez"];
        ?>
        
            <tr>

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
                
                <td><?= number_format($dado["total"], 2, ',', '.'); ?></td>
                
            </tr>

        <?php endforeach; ?> 
            
        <tr>

            <th scope="col"></th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
            <td><b><?= number_format($sum["ACLA"][$i], 2, ',', '.'); ?></b></td>
            
            <?php endfor; ?>
                
            <td><b><?= number_format($sum["ACLA"]['TOTAL'], 2, ',', '.'); ?></b></td>
            
        </tr>
            
        <tr>

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr style="background-color: #a5c4d3b5">

            <td scope="col">(Aumento)/redução nos Ativos Operacionais</td>
            
            <td scope="col" colspan="13">&nbsp;</td>
                
        </tr>
        
        <?php 
        
            foreach($dados["ARAO"] as $i => $dado):
                
                $sum['ARAO'][1] += $dado["jan"];
                $sum['ARAO'][2] += $dado["feb"];
                $sum['ARAO'][3] += $dado["mar"];
                $sum['ARAO'][4] += $dado["apr"];
                $sum['ARAO'][5] += $dado["may"];
                $sum['ARAO'][6] += $dado["jun"];
                $sum['ARAO'][7] += $dado["jul"];
                $sum['ARAO'][8] += $dado["aug"];
                $sum['ARAO'][9] += $dado["sep"];
                $sum['ARAO'][10] += $dado["oct"];
                $sum['ARAO'][11] += $dado["nov"];
                $sum['ARAO'][12] += $dado["dez"];
                $sum['ARAO']['TOTAL'] += $dado["dez"];
                
        ?>
        
            <tr>

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
                
                <td><?= number_format($dado["total"], 2, ',', '.'); ?></td>
                
            </tr>

        <?php endforeach; ?> 
            
        <tr>

            <th scope="col"></th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
            <td><b><?= number_format($sum["ARAO"][$i], 2, ',', '.'); ?></b></td>
            
            <?php endfor; ?>
                
            <td><b><?= number_format($sum["ARAO"]['TOTAL'], 2, ',', '.'); ?></b></td>
            
        </tr>
            
        <tr>

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr style="background-color: #a5c4d3b5">

            <td scope="col">Aumento/(redução) nos Passivos Operacionais</td>
            
            <td scope="col" colspan="13">&nbsp;</td>
                
        </tr>
        
        <?php 
        
            foreach($dados["ARPO"] as $i => $dado):
                
                $sum['ARPO'][1] += $dado["jan"];
                $sum['ARPO'][2] += $dado["feb"];
                $sum['ARPO'][3] += $dado["mar"];
                $sum['ARPO'][4] += $dado["apr"];
                $sum['ARPO'][5] += $dado["may"];
                $sum['ARPO'][6] += $dado["jun"];
                $sum['ARPO'][7] += $dado["jul"];
                $sum['ARPO'][8] += $dado["aug"];
                $sum['ARPO'][9] += $dado["sep"];
                $sum['ARPO'][10] += $dado["oct"];
                $sum['ARPO'][11] += $dado["nov"];
                $sum['ARPO'][12] += $dado["dez"];
                $sum['ARPO']['TOTAL'] += $dado["dez"];
                
        ?>
        
            <tr>

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
                
                <td><?= number_format($dado["total"], 2, ',', '.'); ?></td>
                
            </tr>

        <?php endforeach; ?> 
            
        <tr>

            <th scope="col"></th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
            <td><b><?= number_format($sum["ARPO"][$i], 2, ',', '.'); ?></b></td>
            
            <?php endfor; ?>
                
            <td><b><?= number_format($sum["ARPO"]['TOTAL'], 2, ',', '.'); ?></b></td>
            
        </tr>
            
        <tr>

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr style="background-color: #a5c4d3b5">

            <th scope="col">Caixa líquido proveniente/utilizado nas atividades operacionais</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
            <td><b><?= number_format($sum["ACLA"][$i] + $sum["ARAO"][$i] + $sum["ARPO"][$i], 2, ',', '.'); ?></b></td>
            
            <?php endfor; ?>
                
            <td><b><?= number_format($sum["ACLA"]['TOTAL'] + $sum["ARAO"]['TOTAL'] + $sum["ARPO"]['TOTAL'], 2, ',', '.'); ?></b></td>
            
        </tr>
            
        <tr>

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr style="background-color: #237486;">

            <td style="color: #FFFFFFF;" scope="col">Fluxo de caixa das atividades de Investimento</td>
            
            <td style="color: #FFFFFFF;" scope="col" colspan="13" class="text-center"></td>
                
        </tr>
            
        <?php 
        
            foreach($dados["FCAI"] as $i => $dado):
                
                $sum['FCAI'][1] += $dado["jan"];
                $sum['FCAI'][2] += $dado["feb"];
                $sum['FCAI'][3] += $dado["mar"];
                $sum['FCAI'][4] += $dado["apr"];
                $sum['FCAI'][5] += $dado["may"];
                $sum['FCAI'][6] += $dado["jun"];
                $sum['FCAI'][7] += $dado["jul"];
                $sum['FCAI'][8] += $dado["aug"];
                $sum['FCAI'][9] += $dado["sep"];
                $sum['FCAI'][10] += $dado["oct"];
                $sum['FCAI'][11] += $dado["nov"];
                $sum['FCAI'][12] += $dado["dez"];
                $sum['FCAI']['TOTAL'] += $dado["dez"];
                
        ?>
        
            <tr>

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
                
                <td><?= number_format($dado["total"], 2, ',', '.'); ?></td>
                
            </tr>

        <?php endforeach; ?> 

        <tr>

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
            
        <tr style="background-color: #a5c4d3b5">

            <th scope="col">Caixa líquido utilizado nas atividades de investimentos</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= number_format($sum["FCAI"][$i], 2, ',', '.'); ?></td>
            
            <?php endfor; ?>
                
            <td><?= number_format($sum["FCAI"]['TOTAL'], 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr>

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr style="background-color: #237486;">

            <td style="color: #FFF;" scope="col">Fluxo de caixa das atividades de Financiamento</td>
            
            <td style="color: #FFF;" scope="col" colspan="13" class="text-center"></td>
                
        </tr>
            
        <?php 
        
            foreach($dados["FCAF"] as $i => $dado):
                
                $sum['FCAF'][1] += $dado["jan"];
                $sum['FCAF'][2] += $dado["feb"];
                $sum['FCAF'][3] += $dado["mar"];
                $sum['FCAF'][4] += $dado["apr"];
                $sum['FCAF'][5] += $dado["may"];
                $sum['FCAF'][6] += $dado["jun"];
                $sum['FCAF'][7] += $dado["jul"];
                $sum['FCAF'][8] += $dado["aug"];
                $sum['FCAF'][9] += $dado["sep"];
                $sum['FCAF'][10] += $dado["oct"];
                $sum['FCAF'][11] += $dado["nov"];
                $sum['FCAF'][12] += $dado["dez"];
                $sum['FCAF']['TOTAL'] += $dado["dez"];
                
        ?>
        
            <tr>

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
                
                <td><?= number_format($dado["total"], 2, ',', '.'); ?></td>
                
            </tr>

        <?php endforeach; ?> 
            
        <tr>

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
            
        <tr style="background-color: #a5c4d3b5;">

            <th scope="col">Caixa líquido utilizado/proveniente nas atividades de financiamentos</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
            <td><b><?= number_format($sum["FCAF"][$i], 2, ',', '.'); ?></b></td>
            
            <?php endfor; ?>
                
            <td><b><?= number_format($sum["FCAF"]['TOTAL'], 2, ',', '.'); ?></b></td>
            
        </tr>
        
        <tr>

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr style="background-color: #a5c4d3b5;">

            <th scope="col">Acréscimo/(redução) líquido no Caixa e Equivalentes de Caixa</th>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
            <td><b><?= number_format($sum["ACLA"][$i] + $sum["ARAO"][$i] + $sum["ARPO"][$i] + $sum["FCAI"][$i] + $sum["FCAF"][$i], 2, ',', '.'); ?></b></td>
            
            <?php endfor; ?>
                
            <td><b><?= number_format($sum["ACLA"]['TOTAL'] + $sum["ARAO"]['TOTAL'] + $sum["ARPO"]['TOTAL'] + $sum["FCAI"]['TOTAL'] + $sum["FCAF"]['TOTAL'], 2, ',', '.'); ?></b></td>
            
        </tr>
        
        <tr>

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <?php 
        
            foreach($dados["DFCTOT"] as $i => $dado):
                
                if($dado['descricao'] == 'Caixa e equivalentes de caixa no final do exercicio'):
                
                
        ?>
        
            <tr>

                <td style="text-align: left;">Caixa e equivalentes de caixa no início do exercicio</td>

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
                
                <td><?= number_format($dado["total"], 2, ',', '.'); ?></td>
                
            </tr>

        <?php endif; endforeach; ?> 
            
        <?php 
        
            foreach($dados["DFCTOT"] as $i => $dado):
                
                $sum['DFCTOT'][1] += $dado["jan"];
                $sum['DFCTOT'][2] += $dado["feb"];
                $sum['DFCTOT'][3] += $dado["mar"];
                $sum['DFCTOT'][4] += $dado["apr"];
                $sum['DFCTOT'][5] += $dado["may"];
                $sum['DFCTOT'][6] += $dado["jun"];
                $sum['DFCTOT'][7] += $dado["jul"];
                $sum['DFCTOT'][8] += $dado["aug"];
                $sum['DFCTOT'][9] += $dado["sep"];
                $sum['DFCTOT'][10] += $dado["oct"];
                $sum['DFCTOT'][11] += $dado["nov"];
                $sum['DFCTOT'][12] += $dado["dez"];
                $sum['DFCTOT']['TOTAL'] += $dado["dez"];
                
            endforeach;
        ?>
        
        <tr>

            <td style="text-align: left;" scope="col">Caixa e equivalentes de caixa no final do exercicio</td>
            
            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= number_format($sum["DFCTOT"][$i], 2, ',', '.'); ?></td>
            
            <?php endfor; ?>
                
            <td><?= number_format($sum["DFCTOT"]['TOTAL'], 2, ',', '.'); ?></td>
            
        </tr>
            
        <tr>

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <?php 
        
            foreach($dados["DFCTOT"] as $i => $dado):
                
                if($dado['descricao'] == 'Caixa e equivalentes de caixa no inicio do exercicio'):
                
                
        ?>
        
            <tr style="background-color: #a5c4d3b5;">

                <th><b>Acréscimo/(redução) líquido no caixa e equivalentes de caixa</th>

                <td><b><?= number_format($dado["jan"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["feb"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["mar"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["apr"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["may"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["jun"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["jul"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["aug"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["sep"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["oct"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["nov"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["dez"], 2, ',', '.'); ?></b></td>
                
                <td><b><?= number_format($dado["total"], 2, ',', '.'); ?></b></td>
                
            </tr>

        <?php endif; endforeach; ?> 
        
    </tbody>

</table>