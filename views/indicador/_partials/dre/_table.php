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
        
    .table-balancete > tbody > tr.cools,
    .table-balancete > thead > tr.cools
    {
        background-color: #bed4e291;
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
      
$ro = [];
$ro['total'] = 0;
$rf = [];
$rf['total'] = 0;
$ord = [];
$ord['total'] = 0;
$do = [];
$do['total'] = 0;

?>

<table class="table table-condensed table-bordered table-balancete">

    <thead>

        <tr class="title-category" style="background-color: #235a69; color: #FFF;">
            
            <th scope="col">DEMONSTRATIVO DO RESULTADO DO EXERCÍCIO</th>
            
            <?php 
            
                foreach($model->meses as $mes): 
                
                    $ro[$mes] = 0;
                    $rf[$mes] = 0;
                    $ord[$mes] = 0;
                    $do[$mes] = 0;
            ?>
            
                <th scope="col" class="text-center"><?= $meses[$mes] ?></th>
                            
            <?php endforeach; ?>
                
            <th scope="col" class="text-center">TOTAL (ANO)</th>

        </tr>

    </thead>

    <tbody class="body-valor">
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">RECEITAS OPERACIONAIS</th>
                
            <th scope="col" colspan="13" class="text-center"></th>

        </tr>

        <?php 
        
        if(isset($dados['RECEITAS OPERACIONAIS'])):
        
            foreach($dados['RECEITAS OPERACIONAIS'] as $dado): 

                foreach($model->meses as $mes)
                {
                    $ro[$mes] += $dado[$apelidos[$mes]];
                }

                $ro['total'] += $dado["total"];
            
                ?>
            
                <tr class="graph">

                    <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  

                    <?php foreach($model->meses as $mes): ?>

                        <td><?= number_format($dado[$apelidos[$mes]], 2, ',', '.'); ?></td>

                    <?php endforeach; ?>

                    <td><b><?= number_format($dado["total"], 2, ',', '.'); ?></b></td>

                </tr>
 
                <?php 
        
                endforeach; 
    
            endif;
                
        ?>
        
        <tr class="title-category" style="background-color: #247388; color: #FFF;">

            <th scope="col">RECEITAS OPERACIONAIS LÍQUIDAS</th>
            
            <?php foreach($model->meses as $mes): ?>
            
                <td><?= number_format($ro[$mes], 2, ',', '.'); ?></td>
            
            <?php endforeach; ?>
                
            <td><?= number_format($ro["total"], 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">CMV</th>
                
            <th scope="col" colspan="13" class="text-center"></th>

        </tr>
        
        <?php 
        
        if(isset($dados['CMV'])):
        
            foreach($dados['CMV'] as $dado): 
            
            ?>
            
            <tr class="graph">

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
                                
                <?php foreach($model->meses as $mes): ?>

                    <td><?= number_format($dado[$apelidos[$mes]], 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                
                <td><b><?= number_format($dado["total"], 2, ',', '.'); ?></b></td>

            </tr>
 
        <?php 
        
            endforeach;
            
        endif;
            
        ?>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">DESPESAS OPERACIONAIS</th>
                
            <th scope="col" colspan="13" class="text-center"></th>

        </tr>

        <?php 
        
        if(isset($dados['DESPESAS OPERACIONAIS'])):
        
            foreach($dados['DESPESAS OPERACIONAIS'] as $dado): 
            
                foreach($model->meses as $mes)
                {
                    $do[$mes] += $dado[$apelidos[$mes]];
                }

                $do['total'] += $dado["total"];
            
        ?>
            
            <tr class="graph">

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
                                
                <?php foreach($model->meses as $mes): ?>

                    <td><?= number_format($dado[$apelidos[$mes]], 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                
                <td><b><?= number_format($dado["total"], 2, ',', '.'); ?></b></td>

            </tr>
 
        <?php 
        
                endforeach; 
        
            endif;
                
        ?>
        
        <tr class="title-category" style="background-color: #247388; color: #FFF;">

            <th scope="col">TOTAL DAS DESPESAS OPERACIONAIS</th>
            
            <?php foreach($model->meses as $mes): ?>

                <td><?= number_format($do[$mes], 2, ',', '.'); ?></td>

            <?php endforeach; ?>
                
            <td><?= number_format($do["total"], 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #247388; color: #FFF;">

            <th scope="col">% CUSTO OPERACIONAL</th>
            
            <?php foreach($model->meses as $mes): ?>

                <td><?= ($ro[$mes] != 0) ? number_format((($do[$mes]/$ro[$mes]) * 100), 2, ',', '.') : 0; ?>%</td>

            <?php endforeach; ?>
                
            <td><?= ($ro["total"] != 0) ? number_format((($do["total"]/$ro["total"]) * 100), 2, ',', '.') : 0; ?>%</td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">RESULTADO FINANCEIRO</th>
                
            <th scope="col" colspan="13" class="text-center"></th>

        </tr>

        <?php 
        
        if(isset($dados['RESULTADO FINANCEIRO'])):
        
            foreach($dados['RESULTADO FINANCEIRO'] as $dado): 

                foreach($model->meses as $mes)
                {
                    $rf[$mes] += $dado[$apelidos[$mes]];
                }

                $rf['total'] += $dado["total"];
            
        ?>
            
            <tr class="graph">

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
                                
                <?php foreach($model->meses as $mes): ?>

                    <td><?= number_format($dado[$apelidos[$mes]], 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                
                <td><b><?= number_format($dado["total"], 2, ',', '.'); ?></b></td>

            </tr>
 
        <?php 
        
            endforeach;
        
        endif;
        
        ?>
        
        <tr class="title-category" style="background-color: #247388; color: #FFF;">

            <th scope="col">TOTAL DO RESULTADO FINANCEIRO</th>
            
            <?php foreach($model->meses as $mes): ?>

                <td><?= number_format($rf[$mes], 2, ',', '.'); ?></td>

            <?php endforeach; ?>
                
            <td><?= number_format($rf["total"], 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #247388; color: #FFF;">

            <th scope="col">% RESULTADO FINANCEIRO</th>
            
            <?php foreach($model->meses as $mes): ?>

                <td><?= ($ro[$mes] != 0) ? number_format((($rf[$mes]/$ro[$mes]) * 100), 2, ',', '.') : 0; ?>%</td>

            <?php endforeach; ?>
                
            <td><?= ($ro["total"] != 0) ? number_format((($rf["total"]/$ro["total"]) * 100), 2, ',', '.') : 0; ?>%</td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">OUTRAS RECEITAS / DESPESAS</th>
                
            <th scope="col" colspan="13" class="text-center"></th>

        </tr>

        <?php 
        
        if(isset($dados['OUTRAS RECEITAS / DESPESAS'])):
        
            foreach($dados['OUTRAS RECEITAS / DESPESAS'] as $dado): 

                foreach($model->meses as $mes)
                {
                    $ord[$mes] += $dado[$apelidos[$mes]];
                }

                $ord['total'] += $dado["total"];
            
        ?>
            
            <tr class="graph">

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
                                
                <?php foreach($model->meses as $mes): ?>

                    <td><?= number_format($dado[$apelidos[$mes]], 2, ',', '.'); ?></td>

                <?php endforeach; ?>
                
                <td><b><?= number_format($dado["total"], 2, ',', '.'); ?></b></td>

            </tr>
 
        <?php 
        
            endforeach;
            
        endif;
            
        ?>
        
        <tr class="title-category" style="background-color: #247388; color: #FFF;">

            <th scope="col">TOTAL DE OUTRAS RECEITAS / DESPESAS</th>
            
            <?php foreach($model->meses as $mes): ?>

                <td><?= number_format($ord[$mes], 2, ',', '.'); ?></td>

            <?php endforeach; ?>
                
            <td><?= number_format($ord["total"], 2, ',', '.'); ?></td>
            
        </tr>
        
        <tr class="title-category" style="background-color: #247388; color: #FFF;">

            <th scope="col">% RESULTADO OUTRAS RECEITAS / DESPESAS</th>
            
            <?php foreach($model->meses as $mes): ?>

                <td><?= ($ro[$mes] != 0) ? number_format((($ord[$mes]/$ro[$mes]) * 100), 2, ',', '.') : 0; ?>%</td>

            <?php endforeach; ?>
                
            <td><?= ($ro["total"] != 0) ? number_format((($ord["total"]/$ro["total"]) * 100), 2, ',', '.') : 0; ?>%</td>
            
        </tr>
        
    </tbody>

</table>