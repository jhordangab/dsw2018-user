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
        
    .body-valor tr.sum 
    {
        font-weight: 600;
        background-color: #237486;
        color: #FFF;
    }
        
    .table-balancete > tbody > tr.title-category:hover,
    .table-balancete > tbody > tr.empty-tr:hover
    {
        border: none;
    }
        
    .table-balancete > tbody > tr.title-category
    {
        cursor: text;
        background-color: #a5c4d3b5;
    }
        
    .table-balancete > tbody > tr.title-category.title-bordered > td
    {
        border-top: 2px solid black;
    }
        
    .table-balancete > tbody > tr.title-category.title-default > td
    {
        text-align: left; 
        font-weight: bold;
    }
        
    .table-balancete > tbody > tr.empty-tr
    {
        cursor: text;
        background-color: #FFF;
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

$months = 
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
      
?>

<table class="table table-condensed table-bordered table-balancete">

    <thead>

        <tr style="background-color: #237486; color: #FFF;">

            <th scope="col"></th>
            
            <?php 
            
                foreach($meses as $xs => $mes): 
                
                    $sum['LL'][$xs] = 0;
                    $sum['AD'][$xs] = 0;
                    $sum['EX'][$xs] = 0;
                    $sum['BCCS'][$xs] = 0;
                    $sum['LPEIRPJ'][$xs] = 0;
                    $sum['LPECSLL'][$xs] = 0;
                    

            ?>
            
                <th scope="col" class="text-center"><?= $mes ?></th>
                            
            <?php endforeach; ?>
                                
        </tr>

    </thead>

    <tbody class="body-valor">

        <?php 
        
            foreach($dados["LL"] as $i => $dado):
                
                foreach($meses as $xs => $mes): 
                
                    $sum['LL'][$xs] = 0;
                
                    for($x = 1; $x <= $xs; $x++): 
                
                        $sum['LL'][$xs] += $dado[$months[$x]];

                    endfor;
                    
                endforeach;
        ?>
        
            <tr style="background-color: #237486; color: #FFF;">

                <td></td>

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
                                
            </tr>
        
            <tr class="title-category graph" style="cursor: pointer;" data-json='<?= json_encode($dado); ?>'>

                <td style="text-align: left;"><b>Resultado Antes do IR e da Contribuição Social</b></td>
                
                <?php foreach($meses as $xs => $mes): ?>
                
                    <td><b><?= number_format($sum['LL'][$xs], 2, ',', '.'); ?></b></td>
                
                <?php endforeach; ?>
                
            </tr>

        <?php endforeach; ?> 
            
        <?php 
        
            foreach($dados["AD"] as $i => $dado):
                                
                foreach($meses as $xs => $mes): 
                
                    for($x = 1; $x <= $xs; $x++): 
                
                        $sum['AD'][$xs] += $dado[$months[$x]];

                    endfor;
                    
                endforeach;
                
            endforeach;
                
        ?>
            
        <tr class="title-category">

            <td style="text-align: left;"><b>(+) Adições</b></td>
            
            <?php foreach($meses as $xs => $mes): ?>
                
                <td><b><?= number_format($sum['AD'][$xs], 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>
            
        </tr>    
        
        <?php 
        
            foreach($dados["AD"] as $i => $dado):
                
        ?>
        
            <tr class="graph" style="cursor: pointer;" data-json='<?= json_encode($dado); ?>'>

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>
                
                <?php 
                
                    foreach($meses as $xs => $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $xs; $g++):
                            
                            $result += $dado[$months[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php endforeach; ?>

            </tr>

        <?php endforeach; ?> 
            
        <?php 
        
            foreach($dados["EX"] as $i => $dado):
                                
                foreach($meses as $xs => $mes): 
                
                    for($x = 1; $x <= $xs; $x++): 
                
                        $sum['EX'][$xs] += $dado[$months[$x]];

                    endfor;
                    
                endforeach;
                
            endforeach;
                
        ?>
        
        <tr class="title-category">

            <td style="text-align: left;"><b>(-) Exclusões</b></td>
            
            <?php foreach($meses as $xs => $mes): ?>
                
                <td><b><?= number_format($sum['EX'][$xs], 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>

        </tr>
        
        <?php 
        
            foreach($dados["EX"] as $i => $dado):
                
        ?>
        
            <tr class="graph" style="cursor: pointer;" data-json='<?= json_encode($dado); ?>'>

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>
                
                <?php 
                
                    foreach($meses as $xs => $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $xs; $g++):
                            
                            $result += $dado[$months[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                    
            </tr>

        <?php endforeach; ?> 
        
        <tr class="title-category">

            <td style="text-align: left;"><b>Sub-total</b></td>

            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <?php 
                
                    $result = 0;
                
                    for($j = 1; $j <= $i; $j++) : 
                    
                        $result = $sum['LL'][$j] + $sum['AD'][$j] - $sum['EX'][$j];

                    endfor; 
                ?>

                <td><b><?= number_format($result, 2, ',', '.'); ?></b></td>

            <?php endfor; ?>

        </tr>
        
        <?php 
        
            foreach($dados["COMPCS"] as $i => $dado):
                
        ?>
        
            <tr class="title-category">

                <td style="text-align: left;"><b>Compensações</b></td>

                <?php 
                
                    foreach($meses as $xs => $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $xs; $g++):
                            
                            $result += $dado[$months[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><b><?= number_format($result, 2, ',', '.'); ?></b></td>

                <?php endforeach; ?>

            </tr>
        
        
            <tr class="graph" style="cursor: pointer;" data-json='<?= json_encode($dado); ?>'>

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>

                <?php 
                
                    foreach($meses as $xs => $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $xs; $g++):
                            
                            $result += $dado[$months[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                
            </tr>

        <?php endforeach; ?>
        
        <tr class="title-category">

            <td style="text-align: left;"><b>Base de cálculo da Contribuição Social</b></td>

            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <?php 
                
                    $result = 0;
                
                    for($j = 1; $j <= $i; $j++) : 
                    
                        $result = $sum['LL'][$j] + $sum['AD'][$j] - $sum['EX'][$j] - $dado[$months[$j]];

                    endfor; 
                ?>

                <td><b><?= number_format($result, 2, ',', '.'); ?></b></td>

            <?php endfor; ?>

        </tr>
        
        <tr>

            <td style="text-align: left;">Contribuição Social devida  9%</td>

            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <?php 
                
                    $result = 0;
                
                    for($j = 1; $j <= $i; $j++) : 
                        
                        $cat = $sum['LL'][$j] + $sum['AD'][$j] - $sum['EX'][$j] - $dado[$months[$j]];
                        $result = ($cat > 0) ? $cat * 0.09 : 0;

                    endfor; 
                ?>

                <td><?= number_format($result, 2, ',', '.'); ?></td>

            <?php endfor; ?>

        </tr>
        
        <?php 
        
            foreach($dados["BCCS"] as $i => $dado):
                
                foreach($meses as $xs => $mes): 
                
                    $sum['BCCS'][$xs] = 0;
                
                    for($x = 1; $x <= $xs; $x++): 
                
                        $sum['BCCS'][$xs] += $dado[$months[$x]];

                    endfor;
                    
                endforeach;
                
        ?>
        
            <tr class="graph" style="cursor: pointer;" data-json='<?= json_encode($dado); ?>'>

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>
                
                <?php 
                
                    if($dado['descricao'] == '(-) CSLL devida em meses anteriores')
                    {
                        foreach($meses as $xs => $mes): 
                    ?>
                
                    <td>-</td>
                        
                <?php
                        endforeach;
                    }
                    else
                    {
                        foreach($meses as $xs => $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $xs; $g++):
                            
                            $result += $dado[$months[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                        <?php endforeach;
                    }
                    
                ?>
                    
            </tr>

        <?php endforeach; ?>
        
        <tr class="title-category" style="background-color: #237486; color: #FFF;">

            <td style="text-align: left;">(=) Contribuição Social a Pagar - 2484</td>

            <?php foreach($meses as $xs => $mes): ?>

                <td>-</td>

            <?php endforeach; ?>

        </tr>
        
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <?php 
        
            foreach($dados["LL"] as $i => $dado):
                
                foreach($meses as $xs => $mes): 
                
                    $sum['LL'][$xs] = 0;
                
                    for($x = 1; $x <= $xs; $x++): 
                
                        $sum['LL'][$xs] += $dado[$months[$x]];

                    endfor;
                    
                endforeach;
        ?>
        
            <tr class="title-category graph" style="cursor: pointer;" data-json='<?= json_encode($dado); ?>'>

                <td style="text-align: left;"><b>Resultado Antes do Imposto de Renda</b></td>
                
                <?php foreach($meses as $xs => $mes): ?>
                
                    <td><b><?= number_format($sum['LL'][$xs], 2, ',', '.'); ?></b></td>
                
                <?php endforeach; ?>
                
            </tr>

        <?php endforeach; ?> 
            
        <tr class="title-category">

            <td style="text-align: left;"><b>(+) Adições</b></td>
            
            <?php foreach($meses as $xs => $mes): ?>
                
                <td><b><?= number_format($sum['AD'][$xs], 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>
            
        </tr>    
        
        <?php 
        
            foreach($dados["AD"] as $i => $dado):
                
        ?>
        
            <tr class="graph" style="cursor: pointer;" data-json='<?= json_encode($dado); ?>'>

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>
                
                <?php 
                
                    foreach($meses as $xs => $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $xs; $g++):
                            
                            $result += $dado[$months[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php endforeach; ?>

            </tr>

        <?php endforeach; ?> 
            
        <tr class="title-category">

            <td style="text-align: left;"><b>(-) Exclusões</b></td>
            
            <?php foreach($meses as $xs => $mes): ?>
                
                <td><b><?= number_format($sum['EX'][$xs], 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>

        </tr>
        
        <?php 
        
            foreach($dados["EX"] as $i => $dado):
                
        ?>
        
            <tr class="graph" style="cursor: pointer;" data-json='<?= json_encode($dado); ?>'>

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>
                
                <?php 
                
                    foreach($meses as $xs => $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $xs; $g++):
                            
                            $result += $dado[$months[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                    
            </tr>

        <?php endforeach; ?> 
        
        <tr class="title-category">

            <td style="text-align: left;"><b>Sub-total</b></td>

            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <?php 
                
                    $result = 0;
                
                    for($j = 1; $j <= $i; $j++) : 
                    
                        $result = $sum['LL'][$j] + $sum['AD'][$j] - $sum['EX'][$j];

                    endfor; 
                ?>

                <td><b><?= number_format($result, 2, ',', '.'); ?></b></td>

            <?php endfor; ?>

        </tr>
        
        <?php 
        
            foreach($dados["COMPIR"] as $i => $dado):
                
        ?>
        
            <tr class="title-category">

                <td style="text-align: left;"><b>Compensações</b></td>

                <?php 
                
                    foreach($meses as $xs => $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $xs; $g++):
                            
                            $result += $dado[$months[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><b><?= number_format($result, 2, ',', '.'); ?></b></td>

                <?php endforeach; ?>

            </tr>
        
        
            <tr class="graph" style="cursor: pointer;" data-json='<?= json_encode($dado); ?>'>

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>

                <?php 
                
                    foreach($meses as $xs => $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $xs; $g++):
                            
                            $result += $dado[$months[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                
            </tr>

        <?php endforeach; ?>
        
        <tr class="title-category">

            <td style="text-align: left;"><b>Base de Cálculo do IRPJ</b></td>

            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <?php 
                
                    $result = 0;
                
                    for($j = 1; $j <= $i; $j++) : 
                    
                        $result = $sum['LL'][$j] + $sum['AD'][$j] - $sum['EX'][$j] - $dado[$months[$j]];

                    endfor; 
                ?>

                <td><b><?= number_format($result, 2, ',', '.'); ?></b></td>

            <?php endfor; ?>

        </tr>
        
        <tr>

            <td style="text-align: left;">Imposto de Renda Devido 15%</td>

            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <?php 
                
                    $result = 0;
                
                    for($j = 1; $j <= $i; $j++) : 
                        
                        $cat = $sum['LL'][$j] + $sum['AD'][$j] - $sum['EX'][$j] - $dado[$months[$j]];
                        $result = ($cat > 0) ? $cat * 0.15 : 0;

                    endfor; 
                ?>

                <td><?= number_format($result, 2, ',', '.'); ?></td>

            <?php endfor; ?>

        </tr>
        
        <tr>

            <td style="text-align: left;">Adicional do Imposto de Renda</td>

            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <?php 
                
                    $result = 0;
                
                    for($j = 1; $j <= $i; $j++) : 
                        
                        $cat = $sum['LL'][$j] + $sum['AD'][$j] - $sum['EX'][$j] - $dado[$months[$j]];
                        $result = ($cat > ($i * 20000)) ? ($cat - ($i * 20000)) * 0.1 : 0;

                    endfor; 
                ?>

                <td><?= number_format($result, 2, ',', '.'); ?></td>

            <?php endfor; ?>

        </tr>
        
        <tr>

            <td style="text-align: left;">Total de Imposto de Renda + Adicional</td>

            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <?php 
                
                    $result = 0;
                
                    for($j = 1; $j <= $i; $j++) : 
                        
                        $cat = $sum['LL'][$j] + $sum['AD'][$j] - $sum['EX'][$j] - $dado[$months[$j]];
                        $impostos = ($cat > 0) ? $cat * 0.15 : 0;
                        $adicional = ($cat > ($i * 20000)) ? ($cat - ($i * 20000)) * 0.1 : 0;

                        $result = $impostos + $adicional;
                        
                    endfor; 
                ?>

                <td><?= number_format($result, 2, ',', '.'); ?></td>

            <?php endfor; ?>

        </tr>
        
        <?php 
        
            foreach($dados["BCIRPJ"] as $i => $dado):
                
                foreach($meses as $xs => $mes): 
                
                    $sum['BCIRPJ'][$xs] = 0;
                
                    for($x = 1; $x <= $xs; $x++): 
                
                        $sum['BCIRPJ'][$xs] += $dado[$months[$x]];

                    endfor;
                    
                endforeach;
                
        ?>
        
            <tr class="graph" style="cursor: pointer;" data-json='<?= json_encode($dado); ?>'>

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>
                
                <?php 
                
                    foreach($meses as $xs => $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $xs; $g++):
                            
                            $result += $dado[$months[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                    
            </tr>

        <?php endforeach; ?>
        
        <tr class="title-category" style="background-color: #237486; color: #FFF;">

            <td style="text-align: left;">Saldo do Imposto de Renda a Recolher - 5993</td>

            <?php foreach($meses as $xs => $mes): ?>

                <td>-</td>

            <?php endforeach; ?>

        </tr>
        
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr class="title-category" style="background-color: #237486; color: #FFF;">

            <td style="text-align: left;">Total IRPJ + CSLL - Redução/Suspensão</td>

            <?php foreach($meses as $xs => $mes): ?>

                <td>-</td>

            <?php endforeach; ?>

        </tr>
        
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr class="title-category" style="background-color: #237486; color: #FFF;">

            <td style="text-align: left;">Lucro Presumido / Estimativa</td>

            <?php foreach($meses as $xs => $mes): ?>

                <td>-</td>

            <?php endforeach; ?>

        </tr>
        
        <?php 
        
            foreach($dados["LPEIRPJ"] as $i => $dado):

        ?>
        
            <tr class="graph" style="cursor: pointer;" data-json='<?= json_encode($dado); ?>'>

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>
                
                <?php 
                
                    foreach($meses as $xs => $mes): 
                    
                        $result = $dado[$months[$xs]];
                        $sum['LPEIRPJ'][$xs] += $dado[$months[$xs]];
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                    
            </tr>

        <?php endforeach; ?>
        
        <tr>

            <td style="text-align: left;"><b>Total Base IRPJ</b></td>

            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><b><?= number_format($sum["LPEIRPJ"][$i], 2, ',', '.'); ?></b></td>
            
            <?php endfor; ?>

        </tr>
            

        </tr>
        
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr>

            <td style="text-align: left;">IRPJ Estimativa - 15%</td>

            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><?= number_format($sum["LPEIRPJ"][$i] * 0.15, 2, ',', '.'); ?></td>
            
            <?php endfor; ?>

        </tr>
        
        <tr>

            <td style="text-align: left;">Adicional IR Estimativa - 10%</td>

            <?php for($i = 1; $i <= 12; $i++) : 
                
                
                $result = (($sum["LPEIRPJ"][$i] - (20000 * 1)) > 0) ? ($sum["LPEIRPJ"][$i] - (20000 * 1)) * 0.1 : 0;
                
                ?>
            
                <td><?= number_format($result, 2, ',', '.'); ?></td>
            
            <?php endfor; ?>

        </tr>
        
        <tr class="title-category">

            <td style="text-align: left;"><b>Total IRPJ - 15% + 10%</b></td>

            <?php for($i = 1; $i <= 12; $i++) : 
                
                $fifteen = $sum["LPEIRPJ"][$i] * 0.15;
                $ten = (($sum["LPEIRPJ"][$i] - (20000 * 1)) > 0) ? ($sum["LPEIRPJ"][$i] - (20000 * 1)) * 0.1 : 0;
                
                ?>
            
                <td><b><?= number_format($fifteen + $ten, 2, ',', '.'); ?></b></td>
            
            <?php endfor; ?>

        </tr>
        
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <?php 
        
            foreach($dados["LPECSLL"] as $i => $dado):
                
        ?>
        
            <tr class="graph" style="cursor: pointer;" data-json='<?= json_encode($dado); ?>'>

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>
                
                <?php 
                
                    foreach($meses as $xs => $mes): 
                    
                        $result = $dado[$months[$xs]];
                        $sum['LPECSLL'][$xs] += $dado[$months[$xs]];
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                    
            </tr>

        <?php endforeach; ?>
        
        <tr>

            <td style="text-align: left;"><b>Total Base CSLL</b></td>

            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><b><?= number_format($sum["LPECSLL"][$i], 2, ',', '.'); ?></b></td>
            
            <?php endfor; ?>
                
        </tr>
        
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr class="title-category">

            <td style="text-align: left;"><b>CSLL Estimativa - 9%</b></td>

            <?php for($i = 1; $i <= 12; $i++) : ?>
            
                <td><b><?= number_format($sum["LPECSLL"][$i] * 0.09, 2, ',', '.'); ?></b></td>
            
            <?php endfor; ?>

        </tr>
        
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr class="title-category" style="background-color: #237486; color: #FFF;">

            <td style="text-align: left;">Total a Pagar IRPJ + CSLL Estimado</td>

            <?php for($i = 1; $i <= 12; $i++) : 
                
                $fifteen = $sum["LPEIRPJ"][$i] * 0.15;
                $ten = (($sum["LPEIRPJ"][$i] - (20000 * 1)) > 0) ? ($sum["LPEIRPJ"][$i] - (20000 * 1)) * 0.1 : 0;
                $nine = $sum["LPECSLL"][$i] * 0.09;
                ?>
            
                <td><b><?= number_format($fifteen + $ten + $nine, 2, ',', '.'); ?></b></td>
            
            <?php endfor; ?>

        </tr>

        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr class="title-category" style="background-color: #237486; color: #FFF;">

            <td style="text-align: left;">Variação L.Real x L.Presumido</td>

            <?php foreach($meses as $xs => $mes): ?>

                <td>-</td>

            <?php endforeach; ?>

        </tr>
        
    </tbody>

</table>