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
      
?>

<table class="table table-condensed table-bordered table-balancete">

    <thead>

        <tr class="title-category" style="background-color: #237486; color: #FFF; cursor: text;">

            <th scope="col"></th>
            
            <?php 
            
                foreach($meses as $xs => $mes): 
                
                    $sum['LL'][$xs] = 0;
                    $sum['AD'][$xs] = 0;
                    $sum['EX'][$xs] = 0;
                    $sum['BCCSB'][$xs] = 0;
                    $sum['BCCSC'][$xs] = 0;
                    $sum['LPEIRPJ'][$xs] = 0;
                    $sum['LPECSLL'][$xs] = 0;
                    
                endforeach; 
                    
                foreach($model->meses as $mes):
            ?>
            
                <th scope="col" class="text-center"><?= $meses[$mes] ?></th>
                            
            <?php endforeach; ?>
                                
        </tr>

    </thead>

    <tbody class="body-valor">

        <?php 
        
            if(isset($dados["LL"])):
            
                foreach($dados["LL"] as $i => $dado):

                    foreach($meses as $xs => $mes): 

                        $sum['LL'][$xs] = 0;

                        for($x = 1; $x <= $xs; $x++): 

                            $sum['LL'][$xs] += $dado[$apelidos[$x]];

                        endfor;

                    endforeach;
        ?>
        
            <tr class="title-category" style="background-color: #237486; color: #FFF;">

                <td></td>
                
                <?php foreach($model->meses as $mes): ?>
                
                    <td><b><?= number_format($dado[$apelidos[$mes]], 2, ',', '.'); ?></b></td>
                
                <?php endforeach; ?>
                                
            </tr>
        
            <tr class="title-category">

                <td style="text-align: left;"><b>Resultado Antes do IR e da Contribuição Social</b></td>
                
                <?php foreach($model->meses as $mes): ?>
                
                    <td><b><?= number_format($sum['LL'][$mes], 2, ',', '.'); ?></b></td>
                
                <?php endforeach; ?>
                
            </tr>

        <?php 
        
                endforeach; 
                
            endif;
                
        ?> 
            
        <?php 
        
            if(isset($dados["AD"])):
        
                foreach($dados["AD"] as $i => $dado):

                    foreach($meses as $xs => $mes): 

                        for($x = 1; $x <= $xs; $x++): 

                            $sum['AD'][$xs] += $dado[$apelidos[$x]];

                        endfor;

                    endforeach;

                endforeach;
                
            endif;
                
        ?>
            
        <tr class="title-category">

            <td style="text-align: left;"><b>(+) Adições</b></td>
            
            <?php foreach($model->meses as $mes): ?>
                
                <td><b><?= number_format($sum['AD'][$mes], 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>
            
        </tr>    
        
        <?php 
        
            if(isset($dados["AD"])):
                
                foreach($dados["AD"] as $i => $dado):
                
        ?>
        
            <tr class="graph">

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>
                
                <?php 
                
                    foreach($model->meses as $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $mes; $g++):
                            
                            $result += $dado[$apelidos[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php endforeach; ?>

            </tr>

        <?php
        
                endforeach;
                
            endif;
            
        ?> 
            
        <?php 
        
            if(isset($dados["EX"])):
        
                foreach($dados["EX"] as $i => $dado):

                    foreach($meses as $xs => $mes): 

                        for($x = 1; $x <= $xs; $x++): 

                            $sum['EX'][$xs] += $dado[$apelidos[$x]];

                        endfor;

                    endforeach;

                endforeach;
                    
            endif;
                
        ?>
        
        <tr class="title-category">

            <td style="text-align: left;"><b>(-) Exclusões</b></td>
            
            <?php foreach($model->meses as $mes): ?>
                
                <td><b><?= number_format($sum['EX'][$xs], 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>

        </tr>
        
        <?php 
        
            if(isset($dados["EX"])):
        
                foreach($dados["EX"] as $i => $dado):
                
        ?>
        
            <tr class="graph">

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>
                
                <?php 
                
                    foreach($model->meses as $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $mes; $g++):
                            
                            $result += $dado[$apelidos[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                    
            </tr>

        <?php 
        
                endforeach; 

            endif;
        
        ?> 
        
        <tr class="title-category">

            <td style="text-align: left;"><b>Sub-total</b></td>

            <?php foreach($model->meses as $mes) : ?>
            
                <?php 
                
                    $result = 0;
                
                    for($j = 1; $j <= $mes; $j++) : 
                    
                        $result = $sum['LL'][$j] + $sum['AD'][$j] - $sum['EX'][$j];

                    endfor; 
                ?>

                <td><b><?= number_format($result, 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>

        </tr>
        
        <?php 
        
            if(isset($dados["COMPCS"])):
        
                foreach($dados["COMPCS"] as $i => $dado):
                
        ?>
        
            <tr class="title-category">

                <td style="text-align: left;"><b>Compensações</b></td>

                <?php 
                
                    foreach($model->meses as $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $mes; $g++):
                            
                            $result += $dado[$apelidos[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><b><?= number_format($result, 2, ',', '.'); ?></b></td>

                <?php endforeach; ?>

            </tr>
        
        
            <tr class="graph">

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>

                <?php 
                
                    foreach($model->meses as $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $mes; $g++):
                            
                            $result += $dado[$apelidos[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                
            </tr>

        <?php 
        
                endforeach;
                
            endif;
            
        ?>
        
        <tr class="title-category">

            <td style="text-align: left;"><b>Base de cálculo da Contribuição Social</b></td>

            <?php foreach($model->meses as $mes) : ?>
            
                <?php 
                
                    $result = 0;
                
                    for($j = 1; $j <= $mes; $j++) : 
                    
                        $result = $sum['LL'][$j] + $sum['AD'][$j] - $sum['EX'][$j] - $dado[$apelidos[$j]];

                    endfor; 
                ?>

                <td><b><?= number_format($result, 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>

        </tr>
        
        <tr>

            <td style="text-align: left;">Contribuição Social devida  9%</td>

            <?php
            
                $csp = [];
            
                for($i = 1; $i <= 12; $i++) :
                
                    $result = 0;
                
                    for($j = 1; $j <= $i; $j++) : 
                        
                        $cat = $sum['LL'][$j] + $sum['AD'][$j] - $sum['EX'][$j] - $dado[$apelidos[$j]];
                        $result = ($cat > 0) ? $cat * 0.09 : 0;
                        $csp[$i] = $result; 

                    endfor; 
                    
                    if(in_array($i, $model->meses)) :
                ?>

                <td><?= number_format($result, 2, ',', '.'); ?></td>

            <?php 
                
                    endif; 
            
                endfor;
                
            ?>

        </tr>
        
        <?php 
        
            if(isset($dados["BCCS"])):
                
                foreach($dados["BCCS"] as $i => $dado):
        ?>
        
            <tr class="graph">

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>
                
                <?php foreach($meses as $xs => $mes): ?>
                
                    <?php 

                        if($dado['descricao'] == '(-) CSLL devida em meses anteriores')
                        {
                            $result = ($xs > 1) ? $dado[$apelidos[$xs]] + $csp[$xs - 1] : 0;
                        }
                        else
                        {
                            $result = $dado[$apelidos[$xs]];
                        }
                        
                        $csp[$xs] -= $result;
                        
                        if(in_array($xs, $model->meses)) :
                    ?>

                        <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php 
                
                        endif;
                    
                    endforeach; ?>
                        
            </tr>

        <?php
        
                endforeach; 
                
            endif;
                
        ?>
        
        <tr class="title-category" style="background-color: #237486; color: #FFF;">

            <td style="text-align: left;"><b>(=) Contribuição Social a Pagar - 2484</b></td>

            <?php foreach($model->meses as $mes) : ?>
            
                <td><b><?= number_format(($csp[$mes] > 0) ? $csp[$mes] : 0, 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>

        </tr>
        
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <?php 
        
            if(isset($dados["LL"])):
        
                foreach($dados["LL"] as $i => $dado):

                    foreach($model->meses as $mes): 

                        $sum['LL'][$mes] = 0;

                        for($x = 1; $x <= $mes; $x++): 

                            $sum['LL'][$mes] += $dado[$apelidos[$x]];

                        endfor;

                    endforeach;
        ?>
        
            <tr class="title-category">

                <td style="text-align: left;"><b>Resultado Antes do Imposto de Renda</b></td>
                
                <?php foreach($model->meses as $mes): ?>
                
                    <td><b><?= number_format($sum['LL'][$mes], 2, ',', '.'); ?></b></td>
                
                <?php endforeach; ?>
                
            </tr>

        <?php 
        
                endforeach;
                
            endif;
            
        ?> 
            
        <tr class="title-category">

            <td style="text-align: left;"><b>(+) Adições</b></td>
            
            <?php foreach($model->meses as $mes): ?>
                
                <td><b><?= number_format($sum['AD'][$mes], 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>
            
        </tr>    
        
        <?php 
        
            if(isset($dados["AD"])):
        
                foreach($dados["AD"] as $i => $dado):
                
        ?>
        
            <tr class="graph">

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>
                
                <?php 
                
                    foreach($model->meses as $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $mes; $g++):
                            
                            $result += $dado[$apelidos[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php endforeach; ?>

            </tr>

        <?php 
                
                endforeach;
                
            endif;
                
        ?> 
            
        <tr class="title-category">

            <td style="text-align: left;"><b>(-) Exclusões</b></td>
            
            <?php foreach($model->meses as $mes): ?>
                
                <td><b><?= number_format($sum['EX'][$mes], 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>

        </tr>
        
        <?php 
        
            if(isset($dados["EX"])):
        
                foreach($dados["EX"] as $i => $dado):
                
        ?>
        
            <tr class="graph">

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>
                
                <?php 
                
                    foreach($model->meses as $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $mes; $g++):
                            
                            $result += $dado[$apelidos[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                    
            </tr>

        <?php 
        
                endforeach; 
        
            endif;
        
        ?> 
        
        <tr class="title-category">

            <td style="text-align: left;"><b>Sub-total</b></td>

            <?php foreach($model->meses as $mes) : ?>
            
                <?php 
                
                    $result = 0;
                
                    for($j = 1; $j <= $mes; $j++) : 
                    
                        $result = $sum['LL'][$j] + $sum['AD'][$j] - $sum['EX'][$j];

                    endfor; 
                ?>

                <td><b><?= number_format($result, 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>

        </tr>
        
        <?php 
        
            if(isset($dados["COMPIR"])):
        
                foreach($dados["COMPIR"] as $i => $dado):
                
        ?>
        
            <tr class="title-category">

                <td style="text-align: left;"><b>Compensações</b></td>

                <?php 
                
                    foreach($model->meses as $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $mes; $g++):
                            
                            $result += $dado[$apelidos[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><b><?= number_format($result, 2, ',', '.'); ?></b></td>

                <?php endforeach; ?>

            </tr>
        
        
            <tr class="graph">

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>

                <?php 
                
                    foreach($model->meses as $mes): 
                    
                        $result = 0;
                    
                        for($g = 1; $g <= $mes; $g++):
                            
                            $result += $dado[$apelidos[$g]];
                            
                        endfor;
                    
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                
            </tr>

        <?php
        
                endforeach;
                
            endif;
                
        ?>
        
        <tr class="title-category">

            <td style="text-align: left;"><b>Base de Cálculo do IRPJ</b></td>

            <?php foreach($model->meses as $mes) : ?>
            
                <?php 
                
                    $result = 0;
                
                    for($j = 1; $j <= $mes; $j++) : 
                    
                        $result = $sum['LL'][$j] + $sum['AD'][$j] - $sum['EX'][$j] - $dado[$apelidos[$j]];

                    endfor; 
                ?>

                <td><b><?= number_format($result, 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>

        </tr>
        
        <tr>

            <td style="text-align: left;">Imposto de Renda Devido 15%</td>

            <?php foreach($model->meses as $mes) : ?>
            
                <?php 
                
                    $result = 0;
                
                    for($j = 1; $j <= $mes; $j++) : 
                        
                        $cat = $sum['LL'][$j] + $sum['AD'][$j] - $sum['EX'][$j] - $dado[$apelidos[$j]];
                        $result = ($cat > 0) ? $cat * 0.15 : 0;

                    endfor; 
                ?>

                <td><?= number_format($result, 2, ',', '.'); ?></td>

            <?php endforeach; ?>

        </tr>
        
        <tr>

            <td style="text-align: left;">Adicional do Imposto de Renda</td>

            <?php foreach($model->meses as $mes) : ?>
            
                <?php 
                
                    $result = 0;
                
                    for($j = 1; $j <= $mes; $j++) : 
                        
                        $cat = $sum['LL'][$j] + $sum['AD'][$j] - $sum['EX'][$j] - $dado[$apelidos[$j]];
                        $result = ($cat > ($mes * 20000)) ? ($cat - ($mes * 20000)) * 0.1 : 0;

                    endfor; 
                ?>

                <td><?= number_format($result, 2, ',', '.'); ?></td>

            <?php endforeach; ?>

        </tr>
        
        <tr>

            <td style="text-align: left;">Total de Imposto de Renda + Adicional</td>

            <?php $sirs = []; for($i = 1; $i <= 12; $i++) : ?>
            
                <?php 
                
                    $result = 0;
                
                    for($j = 1; $j <= $i; $j++) : 
                        
                        $cat = $sum['LL'][$j] + $sum['AD'][$j] - $sum['EX'][$j] - $dado[$apelidos[$j]];
                        $impostos = ($cat > 0) ? $cat * 0.15 : 0;
                        $adicional = ($cat > ($i * 20000)) ? ($cat - ($i * 20000)) * 0.1 : 0;

                        $result = $impostos + $adicional;
                        $sirs[$i] = $result;
                        
                    endfor; 
                    
                    if(in_array($i, $model->meses)) :
                ?>

                <td><?= number_format($result, 2, ',', '.'); ?></td>

            <?php
            
                    endif;

                endfor;
            
            ?>

        </tr>
        
        <?php 
        
            if(isset($dados["BCIRPJ"])):
        
                foreach($dados["BCIRPJ"] as $i => $dado):
                
        ?>
        
            <tr class="graph">

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>
                
                <?php foreach($meses as $xs => $mes): 

                    if($dado['descricao'] == '(-) Imposto de Renda Recolhido em meses anteriores')
                    {
                        $result = ($xs > 1) ? $dado[$apelidos[$xs]] + $sirs[$xs - 1] : 0;
                    }
                    else
                    {
                        $result = $dado[$apelidos[$xs]];
                    }

                    $sirs[$xs] -= $result;
                    
                    if(in_array($i, $model->meses)) :
                ?>
                    
                    <td><?= number_format($result, 2, ',', '.'); ?></td>
                
                <?php
                
                    endif;
                
                endforeach; 
                
                ?>
    
            </tr>

        <?php
        
                endforeach;
                
            endif;
                
        ?>
        
        <tr class="title-category" style="background-color: #237486; color: #FFF;">

            <td style="text-align: left;"><b>Saldo do Imposto de Renda a Recolher - 5993</b></td>

            <?php foreach($model->meses as $mes): ?>

                <td><b><?= number_format(($sirs[$mes] > 0) ? $sirs[$mes] : 0, 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>

        </tr>
        
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr class="title-category" style="background-color: #237486; color: #FFF;">

            <td style="text-align: left;"><b>Total IRPJ + CSLL - Redução/Suspensão</b></td>

            <?php 
            
                $oais = [];
            
                foreach($model->meses as $mes):
            
                    $csp[$mes] = ($csp[$mes] > 0) ? $csp[$mes] : 0; 
                    $sirs[$mes] = ($sirs[$mes] > 0) ? $sirs[$mes] : 0; 
                    $oais[$mes] = $csp[$mes] + $sirs[$mes];
                
            ?>

                <td><b><?= number_format($oais[$mes], 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>

        </tr>
        
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr class="title-category" style="background-color: #237486; color: #FFF;">

            <td style="text-align: left;"><b>Lucro Presumido / Estimativa</b></td>

            <td scope="col" colspan="13">&nbsp;</td>

        </tr>
        
        <?php 
        
            if(isset($dados["LPEIRPJ"])):
        
                foreach($dados["LPEIRPJ"] as $i => $dado):

        ?>
        
            <tr class="graph">

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>
                
                <?php 
                
                    foreach($model->meses as $mes): 
                    
                        $result = $dado[$apelidos[$mes]];
                        $sum['LPEIRPJ'][$mes] += $dado[$apelidos[$mes]];
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                    
            </tr>

        <?php 
        
                endforeach;
        
            endif;
        
        ?>
        
        <tr>

            <td style="title-category" style="text-align: left;"><b>Total Base IRPJ</b></td>

            <?php foreach($model->meses as $mes) : ?>
            
                <td><b><?= number_format($sum["LPEIRPJ"][$mes], 2, ',', '.'); ?></b></td>
            
            <?php endforeach; ?>

        </tr>
            

        </tr>
        
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr>

            <td style="text-align: left;">IRPJ Estimativa - 15%</td>

            <?php foreach($model->meses as $mes) : ?>
            
                <td><?= number_format($sum["LPEIRPJ"][$mes] * 0.15, 2, ',', '.'); ?></td>
            
            <?php endforeach; ?>

        </tr>
        
        <tr>

            <td style="text-align: left;">Adicional IR Estimativa - 10%</td>

            <?php 
            
                foreach($model->meses as $mes) : 
                
                    $result = (($sum["LPEIRPJ"][$mes] - (20000 * 1)) > 0) ? ($sum["LPEIRPJ"][$mes] - (20000 * 1)) * 0.1 : 0;
                
                ?>
            
                <td><?= number_format($result, 2, ',', '.'); ?></td>
            
            <?php endforeach; ?>

        </tr>
        
        <tr class="title-category">

            <td style="text-align: left;"><b>Total IRPJ - 15% + 10%</b></td>

            <?php foreach($model->meses as $mes) : 
                
                $fifteen = $sum["LPEIRPJ"][$mes] * 0.15;
                $ten = (($sum["LPEIRPJ"][$mes] - (20000 * 1)) > 0) ? ($sum["LPEIRPJ"][$mes] - (20000 * 1)) * 0.1 : 0;
                
                ?>
            
                <td><b><?= number_format($fifteen + $ten, 2, ',', '.'); ?></b></td>
            
            <?php endforeach; ?>

        </tr>
        
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <?php 
        
            if(isset($dados["LPECSLL"])):
        
                foreach($dados["LPECSLL"] as $i => $dado):
                
        ?>
        
            <tr class="graph">

                <td style="text-align: left;"><?= $dado['descricao'] ?></td>
                
                <?php 
                
                    foreach($model->meses as $mes): 
                    
                        $result = $dado[$apelidos[$mes]];
                        $sum['LPECSLL'][$mes] += $dado[$apelidos[$mes]];
                    ?>
                
                    <td><?= number_format($result, 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                    
            </tr>

        <?php 
                endforeach;
                
            endif;
                
        ?>
        
        <tr>

            <td style="text-align: left;"><b>Total Base CSLL</b></td>

            <?php foreach($model->meses as $mes) : ?>
            
                <td><b><?= number_format($sum["LPECSLL"][$mes], 2, ',', '.'); ?></b></td>
            
            <?php endforeach; ?>
                
        </tr>
        
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr class="title-category">

            <td style="text-align: left;"><b>CSLL Estimativa - 9%</b></td>

            <?php foreach($model->meses as $mes) : ?>
            
                <td><b><?= number_format($sum["LPECSLL"][$mes] * 0.09, 2, ',', '.'); ?></b></td>
            
            <?php endforeach; ?>

        </tr>
        
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr class="title-category" style="background-color: #237486; color: #FFF;">

            <td style="text-align: left;"><b>Total a Pagar IRPJ + CSLL Estimado</b></td>

            <?php 
            
                $tatas = []; 
                
                foreach($model->meses as $mes) : 
                
                    $fifteen = $sum["LPEIRPJ"][$mes] * 0.15;
                    $ten = (($sum["LPEIRPJ"][$mes] - (20000 * 1)) > 0) ? ($sum["LPEIRPJ"][$mes] - (20000 * 1)) * 0.1 : 0;
                    $nine = $sum["LPECSLL"][$mes] * 0.09;
                    $tatas[$mes] = $fifteen + $ten + $nine;
            ?>
            
                <td><b><?= number_format($tatas[$mes], 2, ',', '.'); ?></b></td>
            
            <?php endforeach; ?>

        </tr>

        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr class="title-category" style="background-color: #237486; color: #FFF;">

            <td style="text-align: left;"><b>Variação L.Real x L.Presumido</b></td>

            <?php foreach($model->meses as $mes): ?>

                <td><b><?= number_format($tatas[$mes] - $oais[$mes], 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>

        </tr>
        
    </tbody>

</table>