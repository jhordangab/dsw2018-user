<?php

$css = <<<CSS
        
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
    {
        padding: 2px;
        font-size: 10px;
    }
        
    .table-balancete > tbody > tr.title-category,
    .table-balancete > thead > tr.title-category
    {
        cursor: text;
        background-color: #247388c2;
        color: #FFF;
    }
        
    .table-balancete > tbody > tr.sum,
    .table-balancete > thead > tr.sum
    {
        font-weight: 600;
    }
        
    .body-valor tr td
    {
        text-align: center;
    }
        
CSS;

$this->registerCss($css);

$pc = 0;

?>

<table class="table table-condensed table-bordered table-balancete">

    <thead>

        <tr class="title-category" style="background-color: #235a69; color: #FFF;">
            
            <th scope="col"></th>
            
            <th scope="col" class="text-center"><?= $model->ano_x ?></th>
            
            <th scope="col" class="text-center">A. Vertical</th>
            
            <th scope="col" class="text-center"><?= $model->ano_y ?></th>
            
            <th scope="col" class="text-center">A. Vertical</th>
                            
            <th scope="col" class="text-center">Variação</th>
            
            <th scope="col" class="text-center">A. Horizontal</th>

        </tr>

    </thead>

    <tbody class="body-valor">
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">RECEITAS OPERACIONAIS</th>
                
            <th scope="col" colspan="6" class="text-center"></th>

        </tr>
        
        <?php 
        
        $ro[$model->ano_x] = 0;
        $ro[$model->ano_y] = 0;
        $fin[$model->ano_x] = 0;
        $fin[$model->ano_y] = 0;
        
        if(isset($dados['RO'])) :
            
            foreach($dados['RO'] as $dado): 

                $ro[$model->ano_x] += $dado['ano_x'];
                $ro[$model->ano_y] += $dado['ano_y'];

                if(in_array(trim($dado['descricao']), ['Vendas / Remessa', 'Devolucao de Vendas', 'Impostos s/ Vendas/Remessas']))
                {
                    $fin[$model->ano_x] += $dado['ano_x'];
                    $fin[$model->ano_y] += $dado['ano_y'];
                }

            endforeach;
            
            foreach($dados['RO'] as $dado): 
            
                $pc = ($dado["ano_x"]) > 0 ? ($dado["ano_y"] / $dado["ano_x"]) * 100 : 0;
                $pcan = ($ro[$model->ano_x]) > 0 ? ($dado["ano_y"] / $ro[$model->ano_x]) * 100 : 0;
                $pcat = ($ro[$model->ano_y]) > 0 ? ($dado["ano_y"] / $ro[$model->ano_y]) * 100 : 0;

                ?>

                <tr>

                    <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  

                    <td><?= number_format(abs($dado["ano_x"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>

                    <td><?= number_format(abs($dado["ano_y"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>

                    <td><?= number_format(abs($dado["ano_y"]) - abs($dado["ano_x"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($pc, 2, ',', '.'); ?>%</td>

                </tr>
 
            <?php endforeach;
            
        endif; 
        
        $pct = ($ro[$model->ano_x]) > 0 ? ($ro[$model->ano_y] / $ro[$model->ano_x]) * 100 : 0; 
        
        ?>
            
        <tr class="sum">

            <td style="text-align: left;">Receita Operacional Líquida</td>  

            <td><?= number_format($ro[$model->ano_x], 2, ',', '.'); ?></td>

            <td>100,00%</td>

            <td><?= number_format($ro[$model->ano_y], 2, ',', '.'); ?></td>

            <td>100,00%</td>

            <td><?= number_format($ro[$model->ano_x] - $ro[$model->ano_y], 2, ',', '.'); ?></td>

            <td><?= number_format($pc, 2, ',', '.'); ?>%</td>

        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">CMV</th>
                
            <th scope="col" colspan="6" class="text-center"></th>

        </tr>
        
        <?php
        
            if(isset($dados['CMV'])):

                foreach($dados['CMV'] as $dado): 

                    $pc = ($dado["ano_x"]) > 0 ? ($dado["ano_y"] / $dado["ano_x"]) * 100 : 0;
                    $pcan = ($ro[$model->ano_x]) > 0 ? ($dado["ano_y"] / $ro[$model->ano_x]) * 100 : 0;
                    $pcat = ($ro[$model->ano_y]) > 0 ? ($dado["ano_y"] / $ro[$model->ano_y]) * 100 : 0;
            
            ?>
            
                <tr>

                    <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  

                    <td><?= number_format(abs($dado["ano_x"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>

                    <td><?= number_format(abs($dado["ano_y"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>

                    <td><?= number_format(abs($dado["ano_y"]) - abs($dado["ano_x"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($pc, 2, ',', '.'); ?>%</td>

                </tr>
 
        <?php 
        
                endforeach;
        
            endif;
        
        ?>
            
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">DESPESAS OPERACIONAIS</th>
                
            <th scope="col" colspan="6" class="text-center"></th>

        </tr>
            
        <?php 
        
        $do[$model->ano_x] = 0;
        $do[$model->ano_y] = 0;
        
        if(isset($dados['DO'])) :
        
            foreach($dados['DO'] as $dado): 

                $do[$model->ano_x] += $dado['ano_x'];
                $do[$model->ano_y] += $dado['ano_y'];

            endforeach; 

            foreach($dados['DO'] as $dado): 
            
                $pc = ($dado["ano_x"]) > 0 ? ($dado["ano_y"] / $dado["ano_x"]) * 100 : 0;
                $pcan = ($ro[$model->ano_x]) > 0 ? ($dado["ano_y"] / $ro[$model->ano_x]) * 100 : 0;
                $pcat = ($ro[$model->ano_y]) > 0 ? ($dado["ano_y"] / $ro[$model->ano_y]) * 100 : 0;
            
            ?>
            
                <tr>

                    <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  

                    <td><?= number_format(abs($dado["ano_x"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>

                    <td><?= number_format(abs($dado["ano_y"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>

                    <td><?= number_format(abs($dado["ano_y"]) - abs($dado["ano_x"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($pc, 2, ',', '.'); ?>%</td>

                </tr>
 
            <?php 
            
            endforeach;
        
        endif;
            
        $pcan = ($ro[$model->ano_x]) > 0 ? ($do[$model->ano_y] / $ro[$model->ano_x]) * 100 : 0;
        $pcat = ($ro[$model->ano_y]) > 0 ? ($do[$model->ano_y] / $ro[$model->ano_y]) * 100 : 0;
        $pcro = ($do[$model->ano_x]) > 0 ? ($do[$model->ano_y] / $do[$model->ano_x]) * 100 : 0; 
            
        ?>
            
        <tr class="sum">

            <td style="text-align: left;">Total das Despesas Operacionais</td>  

            <td><?= number_format($do[$model->ano_x], 2, ',', '.'); ?></td>

            <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>

            <td><?= number_format($do[$model->ano_y], 2, ',', '.'); ?></td>

            <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>

            <td><?= number_format($do[$model->ano_x] - $do[$model->ano_y], 2, ',', '.'); ?></td>

            <td><?= number_format($pcro, 2, ',', '.'); ?>%</td>

        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">RESULTADO FINANCEIRO</th>
                
            <th scope="col" colspan="6" class="text-center"></th>

        </tr>
            
        <?php 
        
        $rf[$model->ano_x] = 0;
        $rf[$model->ano_y] = 0;
        
        if(isset($dados['RF'])):
        
            foreach($dados['RF'] as $dado): 

                $rf[$model->ano_x] += $dado['ano_x'] * -1;
                $rf[$model->ano_y] += $dado['ano_y'] * -1;

            endforeach; 
        
            foreach($dados['RF'] as $dado): 
            
                $pc = ($dado["ano_x"]) > 0 ? ($dado["ano_y"] / $dado["ano_x"]) * 100 : 0;
                $pcan = ($ro[$model->ano_x]) > 0 ? ($dado["ano_y"] / $ro[$model->ano_x]) * 100 : 0;
                $pcat = ($ro[$model->ano_y]) > 0 ? ($dado["ano_y"] / $ro[$model->ano_y]) * 100 : 0;
            
            ?>
            
                <tr>

                    <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  

                    <td><?= number_format(abs($dado["ano_x"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>

                    <td><?= number_format(abs($dado["ano_y"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>

                    <td><?= number_format(abs($dado["ano_y"]) - abs($dado["ano_x"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($pc, 2, ',', '.'); ?>%</td>

                </tr>
 
            <?php
            
            endforeach; 
        
        endif;
        
        $pcan = ($ro[$model->ano_x]) > 0 ? ($rf[$model->ano_y] / $ro[$model->ano_x]) * 100 : 0;
        $pcat = ($ro[$model->ano_y]) > 0 ? ($rf[$model->ano_y] / $ro[$model->ano_y]) * 100 : 0;
        $pcro = ($rf[$model->ano_x]) > 0 ? ($rf[$model->ano_y] / $rf[$model->ano_x]) * 100 : 0;
        
        ?>
            
        <tr class="sum">

            <td style="text-align: left;">Total do Resultado Financeiro</td>  

            <td><?= number_format($rf[$model->ano_x], 2, ',', '.'); ?></td>

            <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>

            <td><?= number_format($rf[$model->ano_y], 2, ',', '.'); ?></td>

            <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>

            <td><?= number_format($rf[$model->ano_x] - $rf[$model->ano_y], 2, ',', '.'); ?></td>

            <td><?= number_format($pcro, 2, ',', '.'); ?>%</td>

        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">OUTRAS RECEITAS / DESPESAS</th>
                
            <th scope="col" colspan="6" class="text-center"></th>

        </tr>
            
        <?php 
        
        $ord[$model->ano_x] = 0;
        $ord[$model->ano_y] = 0;
        $pdd[$model->ano_x] = 0;
        $pdd[$model->ano_y] = 0;
        
        if(isset($dados['ODR'])):
        
            foreach($dados['ODR'] as $dado): 

                $ord[$model->ano_x] += $dado['ano_x'] * -1;
                $ord[$model->ano_y] += $dado['ano_y'] * -1;

                if(trim($dado['descricao']) == 'Provisão para Devedores Duvidosos')
                {
                    $pdd[$model->ano_x] += $dado['ano_x'];
                    $pdd[$model->ano_y] += $dado['ano_y'];
                }

            endforeach; 

            foreach($dados['ODR'] as $dado): 
            
                $pc = ($dado["ano_x"]) > 0 ? ($dado["ano_y"] / $dado["ano_x"]) * 100 : 0;
                $pcan = ($ro[$model->ano_x]) > 0 ? ($dado["ano_y"] / $ro[$model->ano_x]) * 100 : 0;
                $pcat = ($ro[$model->ano_y]) > 0 ? ($dado["ano_y"] / $ro[$model->ano_y]) * 100 : 0;
            
            ?>
            
                <tr>

                    <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  

                    <td><?= number_format(abs($dado["ano_x"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>

                    <td><?= number_format(abs($dado["ano_y"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>

                    <td><?= number_format(abs($dado["ano_y"]) - abs($dado["ano_x"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($pc, 2, ',', '.'); ?>%</td>

                </tr>
 
            <?php 
            
            endforeach; 
        
        endif;
            
        $pcan = ($ro[$model->ano_x]) > 0 ? ($ord[$model->ano_y] / $ro[$model->ano_x]) * 100 : 0;
        $pcat = ($ro[$model->ano_y]) > 0 ? ($ord[$model->ano_y] / $ro[$model->ano_y]) * 100 : 0;
        $pcro = ($ord[$model->ano_x]) > 0 ? ($ord[$model->ano_y] / $ord[$model->ano_x]) * 100 : 0; 
            
        ?>
            
        <tr class="sum">

            <td style="text-align: left;">Total de Outras Receitas / Depesas </td>  

            <td><?= number_format($ord[$model->ano_x], 2, ',', '.'); ?></td>

            <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>

            <td><?= number_format($ord[$model->ano_y], 2, ',', '.'); ?></td>

            <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>

            <td><?= number_format($ord[$model->ano_x] - $ord[$model->ano_y], 2, ',', '.'); ?></td>

            <td><?= number_format($pcro, 2, ',', '.'); ?>%</td>

        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">RESULTADO C/ PDD</th>
                
            <th scope="col" colspan="6" class="text-center"></th>

        </tr>
        
       
        <tr>

            <?php 
                        
                $raican = (isset($dados['CMV'])) ? $ro[$model->ano_x] - $dados['CMV']['Custo das Mercadorias Vendidas']['ano_x'] - $do[$model->ano_x] 
                    + $rf[$model->ano_x] - $ord[$model->ano_x] : 0;
                    
                $pcan = ($ro[$model->ano_x]) > 0 ? ($raican / $ro[$model->ano_x]) * 100 : 0;
                
                $raicat = (isset($dados['CMV'])) ? $ro[$model->ano_y] - $dados['CMV']['Custo das Mercadorias Vendidas']['ano_y'] - $do[$model->ano_y] 
                    + $rf[$model->ano_y] + $ord[$model->ano_y] : 0;
                
                $pcat = ($ro[$model->ano_y]) > 0 ? ($raicat / $ro[$model->ano_y]) * 100 : 0;
                $toto = ($raicat) > 0 ? (($raicat - $raican) / $raicat) * 100 : 0;
                $ptoto = ($pcat) > 0 ? (($pcat - $pcan) / $pcat) * 100 : 0;
            ?>
                                
            <td style="text-align: left;">RESULTADO ANTES IR/CSLL</td>  

            <td><?= number_format($raican, 2, ',', '.'); ?></td>

            <td></td>

            <td><?= number_format($raicat, 2, ',', '.'); ?></td>

            <td></td>

            <td><?= number_format($raicat - $raican, 2, ',', '.'); ?></td>

            <td><?= number_format($toto, 2, ',', '.'); ?>%</td>

        </tr>
        
        <tr>

            <td style="text-align: left;">Margem Líquida</td>  

            <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>

            <td></td>

            <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>

            <td></td>

            <td><?= number_format($pcat - $pcan, 2, ',', '.'); ?>%</td>

            <td><?= number_format($ptoto, 2, ',', '.'); ?>%</td>

        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">RESULTADO S/ PDD</th>
                
            <th scope="col" colspan="6" class="text-center"></th>

        </tr>
        
        <tr>

            <?php 
            
                $pddcan = $raican + $pdd[$model->ano_x];
                $pddan = ($ro[$model->ano_x]) > 0 ? ($pddcan / $ro[$model->ano_x]) * 100 : 0;
                
                $pddcat = $raicat + $pdd[$model->ano_y];
                $pddat = ($ro[$model->ano_y]) > 0 ? ($pddcat / $ro[$model->ano_y]) * 100 : 0;
                
                $pddtoto = ($pddcat) > 0 ? (($pddcat - $pddan) / $pddcat) * 100 : 0;
                $pddttoto = ($pddcat) > 0 ? (($pddcat - $pddcan) / $pddcat) * 100 : 0;
            ?>
                                
            <td style="text-align: left;">RESULTADO ANTES IR/CSLL</td>  

            <td><?= number_format($pddcan, 2, ',', '.'); ?></td>

            <td></td>

            <td><?= number_format($pddcat, 2, ',', '.'); ?></td>

            <td></td>

            <td><?= number_format($pddcat - $pddcan, 2, ',', '.'); ?></td>

            <td><?= number_format($pddtoto, 2, ',', '.'); ?>%</td>

        </tr>
        
        <tr>

            <td style="text-align: left;">Margem Líquida</td>  

            <td><?= number_format($pddan, 2, ',', '.'); ?>%</td>

            <td></td>

            <td><?= number_format($pddat, 2, ',', '.'); ?>%</td>

            <td></td>

            <td><?= number_format($pddat - $pddan, 2, ',', '.'); ?>%</td>

            <td><?= number_format($pddttoto, 2, ',', '.'); ?>%</td>

        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">&nbsp</th>
                
            <th scope="col" colspan="6" class="text-center"></th>

        </tr>
        
        <?php 
        
            if(isset($dados['RES'])): 
            
                foreach($dados['RES'] as $dado): 

                    $res = ($dado["ano_x"]) > 0 ? ($dado["ano_y"] / $dado["ano_x"]) * 100 : 0;
                    $resan = ($ro[$model->ano_x]) > 0 ? ($dado["ano_y"] / $ro[$model->ano_x]) * 100 : 0;
                    $resat = ($ro[$model->ano_y]) > 0 ? ($dado["ano_y"] / $ro[$model->ano_y]) * 100 : 0;
            
            ?>
            
                <tr>

                    <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  

                    <td><?= number_format(abs($dado["ano_x"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($resan, 2, ',', '.'); ?>%</td>

                    <td><?= number_format(abs($dado["ano_y"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($resat, 2, ',', '.'); ?>%</td>

                    <td><?= number_format(abs($dado["ano_y"]) - abs($dado["ano_x"]), 2, ',', '.'); ?></td>

                    <td><?= number_format($res, 2, ',', '.'); ?>%</td>

                </tr>
 
        <?php 
        
                endforeach;
                
            endif; 

            $llaian = (isset($dado["ano_x"])) ?  $raican - $dado["ano_x"] : 0;
            $llaiat = (isset($dado["ano_x"])) ?  $raicat - $dado["ano_y"] : 0;
            $llaito = ($llaiat) > 0 ? (($llaiat - $llaian) / $llaiat) * 100 : 0;

            $pllaian = ($ro[$model->ano_x]) > 0 ? ($llaian / $ro[$model->ano_x]) * 100 : 0;
            $pllaiat = ($ro[$model->ano_y]) > 0 ? ($llaiat / $ro[$model->ano_y]) * 100 : 0;
        ?>
               
        <tr>    
        
            <td style="text-align: left;">Lucro Líquido Após Impostos</td>  

            <td><?= number_format($llaian, 2, ',', '.'); ?></td>

            <td></td>

            <td><?= number_format($llaiat, 2, ',', '.'); ?></td>

            <td></td>

            <td><?= number_format($llaiat - $llaian, 2, ',', '.'); ?></td>

            <td><?= number_format($llaito, 2, ',', '.'); ?>%</td>

        </tr>
       
        <tr>

            <td style="text-align: left;">Margem Líquida Após Impostos</td>  

            <td><?= number_format($pllaian, 2, ',', '.'); ?>%</td>

            <td></td>

            <td><?= number_format($pllaiat, 2, ',', '.'); ?>%</td>

            <td></td>

            <td><?= number_format($pllaiat - $pllaian, 2, ',', '.'); ?>%</td>

            <td></td>

        </tr>
        
        <?php 
            $pfinan = ($fin[$model->ano_x]) > 0 ? (($fin[$model->ano_x] - $dados['CMV']['Custo das Mercadorias Vendidas']['ano_x']) / $fin[$model->ano_x]) * 100 : 0;
            $pfinat = ($fin[$model->ano_y]) > 0 ? (($fin[$model->ano_y] - $dados['CMV']['Custo das Mercadorias Vendidas']['ano_y']) / $fin[$model->ano_y]) * 100 : 0;
        ?>
        
        <tr>

            <td style="text-align: left;">Margem sobre Venda</td>  

            <td><?= number_format($pfinan, 2, ',', '.'); ?>%</td>

            <td></td>

            <td><?= number_format($pfinat, 2, ',', '.'); ?>%</td>

            <td></td>

            <td><?= number_format($pfinat - $pfinan, 2, ',', '.'); ?>%</td>

            <td></td>

        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">&nbsp</th>
                
            <th scope="col" colspan="6" class="text-center"></th>

        </tr>
            
    </tbody>

</table>