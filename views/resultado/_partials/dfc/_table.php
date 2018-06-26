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
$sum['ACLA']['TOTAL'] = 0;
$sum['ARAO']['TOTAL'] = 0;
$sum['ARPO']['TOTAL'] = 0;
$sum['FCAI']['TOTAL'] = 0;
$sum['FCAF']['TOTAL'] = 0;
$sum['DFCTOT']['TOTAL'] = 0;
      
?>

<table class="table table-condensed table-bordered table-balancete">

    <thead>

        <tr style="background-color: #237486; color: #FFF;">

            <th scope="col"></th>
            
            <?php 
            
                foreach($model->meses as $mes): 
                
                    $sum['ACLA'][$mes] = 0;
                    $sum['ARAO'][$mes] = 0;
                    $sum['ARPO'][$mes] = 0;
                    $sum['FCAI'][$mes] = 0;
                    $sum['FCAF'][$mes] = 0;
                    $sum['DFCTOT'][$mes] = 0;
            ?>
            
                <th scope="col" class="text-center"><?= $meses[$mes] ?></th>
                            
            <?php endforeach; ?>
                
            <th scope="col" class="text-center">TOTAL (ANO)</th>
                
        </tr>

    </thead>

    <tbody class="body-valor">

        <?php 
        
            if(isset($dados["LL"])):
        
                foreach($dados["LL"] as $i => $dado):

                    foreach($model->meses as $mes)
                    {
                        $sum['ACLA'][$mes] += $dado[$apelidos[$mes]];
                    }

                    $sum['ACLA']['TOTAL'] += $dado["total"];
        ?>
        
            <tr class="title-category graph">

                <td style="text-align: left;"><b><?= $dado["descricao"]; ?></b></td>
                
                <?php foreach($model->meses as $mes): ?>
                
                    <td><b><?= number_format($dado[$apelidos[$mes]], 2, ',', '.'); ?></b></td>
                
                <?php endforeach; ?>

                <td><b><?= number_format($dado["total"], 2, ',', '.'); ?></b></td>
                
            </tr>

        <?php 
        
                endforeach; 
        
            endif;
        
        ?> 
            
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr class="title-category title-default">

            <td scope="col">Ajuste para conciliar o lucro antes do IR e da CSLL com o caixa líquido gerado pelas atividades operacionais</td>
            
            <td scope="col" colspan="13">&nbsp;</td>
                
        </tr>

        <?php 
        
            if(isset($dados["ACLA"])):
        
                foreach($dados["ACLA"] as $i => $dado):

                    foreach($model->meses as $mes)
                    {
                        $sum['ACLA'][$mes] += $dado[$apelidos[$mes]];
                    }

                    $sum['ACLA']['TOTAL'] += $dado["total"];
        ?>
        
            <tr class="graph">

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>

                <?php foreach($model->meses as $mes): ?>
                
                    <td><b><?= number_format($dado[$apelidos[$mes]], 2, ',', '.'); ?></b></td>
                
                <?php endforeach; ?>
                
                <td><?= number_format($dado["total"], 2, ',', '.'); ?></td>
                
            </tr>

        <?php
        
                endforeach; 

            endif;
        
        ?> 
            
        <tr class="title-category title-bordered">

            <th scope="col"></th>
            
            <?php foreach($model->meses as $mes) : ?>
            
                <td><b><?= number_format($sum["ACLA"][$mes], 2, ',', '.'); ?></b></td>
            
            <?php endforeach; ?>
                
            <td><b><?= number_format($sum["ACLA"]['TOTAL'], 2, ',', '.'); ?></b></td>
            
        </tr>
            
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr class="title-category title-default">

            <td scope="col">(Aumento)/redução nos Ativos Operacionais</td>
            
            <td scope="col" colspan="13">&nbsp;</td>
                
        </tr>
        
        <?php 
        
            if(isset($dados["ARAO"])):
        
                foreach($dados["ARAO"] as $i => $dado):
                
                    foreach($model->meses as $mes)
                    {
                        $sum['ARAO'][$mes] += $dado[$apelidos[$mes]];
                    }

                    $sum['ARAO']['TOTAL'] += $dado["total"];
                
                    ?>

                        <tr class="graph">

                            <td style="text-align: left;"><?= $dado["descricao"]; ?></td>

                            <?php foreach($model->meses as $mes) : ?>

                                <td><?= number_format($dado[$apelidos[$mes]], 2, ',', '.'); ?></td>

                            <?php endforeach; ?>

                            <td><?= number_format($dado["total"], 2, ',', '.'); ?></td>

                        </tr>

                    <?php 
        
                endforeach;

            endif;
        
        ?> 
            
        <tr class="title-category title-bordered">

            <th scope="col"></th>
            
            <?php foreach($model->meses as $mes) : ?>
            
                <td><b><?= number_format($sum["ARAO"][$mes], 2, ',', '.'); ?></b></td>
            
            <?php endforeach; ?>
                
            <td><b><?= number_format($sum["ARAO"]['TOTAL'], 2, ',', '.'); ?></b></td>
            
        </tr>
            
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr class="title-category title-default">

            <td scope="col">Aumento/(redução) nos Passivos Operacionais</td>
            
            <td scope="col" colspan="13">&nbsp;</td>
                
        </tr>
        
        <?php 
        
            if(isset($dados["ARPO"])):
        
                foreach($dados["ARPO"] as $i => $dado):

                    foreach($model->meses as $mes)
                    {
                        $sum['ARPO'][$mes] += $dado[$apelidos[$mes]];
                    }

                    $sum['ARPO']['TOTAL'] += $dado["total"];
                
        ?>
        
            <tr class="graph">

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>

                <?php foreach($model->meses as $mes) : ?>
            
                    <td><?= number_format($dado[$apelidos[$mes]], 2, ',', '.'); ?></td>

                <?php endforeach; ?>

                <td><?= number_format($dado["total"], 2, ',', '.'); ?></td>
                
            </tr>

        <?php   
        
                endforeach; 
                
            endif;
                
        ?> 
            
        <tr class="title-category title-bordered">

            <th scope="col"></th>
            
            <?php foreach($model->meses as $mes) : ?>
            
                <td><b><?= number_format($sum["ARPO"][$mes], 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>
                
            <td><b><?= number_format($sum["ARPO"]['TOTAL'], 2, ',', '.'); ?></b></td>
            
        </tr>
            
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr class="title-category title-bordered">

            <th scope="col">Caixa líquido proveniente/utilizado nas atividades operacionais</th>
            
            <?php foreach($model->meses as $mes) : ?>
            
                <td><b><?= number_format($sum["ACLA"][$mes] + $sum["ARAO"][$mes] + $sum["ARPO"][$mes], 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>
                
            <td><b><?= number_format($sum["ACLA"]['TOTAL'] + $sum["ARAO"]['TOTAL'] + $sum["ARPO"]['TOTAL'], 2, ',', '.'); ?></b></td>
            
        </tr>
            
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr class="title-category" style="background-color: #237486; color: #FFF;">

            <td scope="col">Fluxo de caixa das atividades de Investimento</td>
            
            <td scope="col" colspan="13" class="text-center"></td>
                
        </tr>
            
        <?php 
        
            if(isset($dados["FCAI"])):
        
                foreach($dados["FCAI"] as $i => $dado):

                    foreach($model->meses as $mes)
                    {
                        $sum['FCAI'][$mes] += $dado[$apelidos[$mes]];
                    }
                
                    $sum['FCAI']['TOTAL'] += $dado["total"];
                
        ?>
        
            <tr class="graph">

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>
                
                <?php foreach($model->meses as $mes) : ?>
            
                    <td><?= number_format($dado[$apelidos[$mes]], 2, ',', '.'); ?></td>

                <?php endforeach; ?>

                <td><?= number_format($dado["total"], 2, ',', '.'); ?></td>
                
            </tr>

        <?php 
        
                endforeach;

            endif;
        
        ?> 

        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
            
        <tr class="title-category title-bordered">

            <th scope="col">Caixa líquido utilizado nas atividades de investimentos</th>
            
            <?php foreach($model->meses as $mes) : ?>
            
                <td><?= number_format($sum["FCAI"][$mes], 2, ',', '.'); ?></td>

            <?php endforeach; ?>
            
            <td><?= number_format($sum["FCAI"]['TOTAL'], 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr class="title-category" style="background-color: #237486; color: #FFF;">

            <td scope="col">Fluxo de caixa das atividades de Financiamento</td>
            
            <td scope="col" colspan="13" class="text-center"></td>
                
        </tr>
            
        <?php 
        
            if(isset($dados["FCAF"])):
        
                foreach($dados["FCAF"] as $i => $dado):

                    foreach($model->meses as $mes)
                    {
                        $sum['FCAF'][$mes] += $dado[$apelidos[$mes]];
                    }

                    $sum['FCAF']['TOTAL'] += $dado["total"];
                
        ?>
        
            <tr class="graph">

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>

                <?php foreach($model->meses as $mes) : ?>
            
                    <td><?= number_format($dado[$apelidos[$mes]], 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                    
                <td><?= number_format($dado["total"], 2, ',', '.'); ?></td>
                
            </tr>

        <?php 
        
                endforeach;
                
            endif;
        ?> 
            
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
            
        <tr class="title-category title-bordered">

            <th scope="col">Caixa líquido utilizado/proveniente nas atividades de financiamentos</th>
            
            <?php foreach($model->meses as $mes) : ?>
            
                <td><b><?= number_format($sum["FCAF"][$mes], 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>

            <td><b><?= number_format($sum["FCAF"]['TOTAL'], 2, ',', '.'); ?></b></td>
            
        </tr>
        
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <tr class="title-category title-bordered">

            <th scope="col">Acréscimo/(redução) líquido no Caixa e Equivalentes de Caixa</th>
            
            <?php foreach($model->meses as $mes) : ?>
            
                <td><b><?= number_format($sum["ACLA"][$mes] + $sum["ARAO"][$mes] + $sum["ARPO"][$mes] + $sum["FCAI"][$mes] + $sum["FCAF"][$mes], 2, ',', '.'); ?></b></td>

            <?php endforeach; ?>
            
            <td><b><?= number_format($sum["ACLA"]['TOTAL'] + $sum["ARAO"]['TOTAL'] + $sum["ARPO"]['TOTAL'] + $sum["FCAI"]['TOTAL'] + $sum["FCAF"]['TOTAL'], 2, ',', '.'); ?></b></td>
            
        </tr>
        
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <?php 
        
            if(isset($dados["DFCTOT"])):
        
                foreach($dados["DFCTOT"] as $i => $dado):

                    if($dado['descricao'] == 'Caixa e equivalentes de caixa no final do exercicio'):
        ?>
        
            <tr class="graph">

                <td style="text-align: left;">Caixa e equivalentes de caixa no início do exercicio</td>

                <?php foreach($model->meses as $mes) : ?>
            
                    <td><?= number_format($dado[$apelidos[$mes]], 2, ',', '.'); ?></td>

                <?php endforeach; ?>

                <td><?= number_format($dado["total"], 2, ',', '.'); ?></td>
                
            </tr>

        <?php 
                    endif; 
                    
                endforeach;
                
                foreach($dados["DFCTOT"] as $i => $dado):

                    foreach($model->meses as $mes)
                    {
                        $sum['DFCTOT'][$mes] += $dado[$apelidos[$mes]];
                    }

                    $sum['DFCTOT']['TOTAL'] += $dado["total"];

                endforeach;
                
            endif;
        ?>
        
        <tr>

            <td style="text-align: left;" scope="col">Caixa e equivalentes de caixa no final do exercicio</td>
            
            <?php foreach($model->meses as $mes) : ?>
            
                <td><?= number_format($sum["DFCTOT"][$mes], 2, ',', '.'); ?></td>
            
            <?php endforeach; ?>
                
            <td><?= number_format($sum["DFCTOT"]['TOTAL'], 2, ',', '.'); ?></td>
            
        </tr>
            
        <tr class="empty-tr">

            <td scope="col" colspan="14">&nbsp;</td>
                
        </tr>
        
        <?php 
        
            if(isset($dados["DFCTOT"])):
        
                foreach($dados["DFCTOT"] as $i => $dado):

                    if($dado['descricao'] == 'Caixa e equivalentes de caixa no inicio do exercicio'): ?>
        
                        <tr class="title-category graph">

                            <th><b>Acréscimo/(redução) líquido no caixa e equivalentes de caixa</th>

                            <?php foreach($model->meses as $mes) : ?>

                                <td style="border-top: 2px solid black;"><b><?= number_format($dado[$apelidos[$mes]], 2, ',', '.'); ?></b></td>

                            <?php endforeach; ?>

                            <td style="border-top: 2px solid black;"><b><?= number_format($dado["total"], 2, ',', '.'); ?></b></td>

                        </tr>

                <?php endif; 

                endforeach;

            endif;

        ?> 
        
    </tbody>

</table>