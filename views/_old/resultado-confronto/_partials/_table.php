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

?>

<table class="table table-condensed table-bordered table-balancete">

    <thead>

        <tr class="title-category" style="background-color: #235a69; color: #FFF;">
            
            <th scope="col"></th>
            
            <th scope="col" class="text-center"><?= $ano - 1 ?></th>
            
            <th scope="col" class="text-center">A. Vertical</th>
            
            <th scope="col" class="text-center"><?= $ano ?></th>
            
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
        
        $ro[$ano - 1] = 0;
        $ro[$ano] = 0;
        $fin[$ano - 1] = 0;
        $fin[$ano] = 0;
        
        foreach($dados['RO'] as $dado): 
            
            $ro[$ano - 1] += $dado['ano_anterior'];
            $ro[$ano] += $dado['ano_atual'];
            
            if(in_array(trim($dado['descricao']), ['Vendas / Remessa', 'Devolucao de Vendas', 'Impostos s/ Vendas/Remessas']))
            {
                $fin[$ano - 1] += $dado['ano_anterior'];
                $fin[$ano] += $dado['ano_atual'];
            }
            
        endforeach; 
        
        ?>

        <?php foreach($dados['RO'] as $dado): 
            
            $pc = ($dado["ano_anterior"]) > 0 ? ($dado["ano_atual"] / $dado["ano_anterior"]) * 100 : 0;
            $pcan = ($ro[$ano - 1]) > 0 ? ($dado["ano_atual"] / $ro[$ano - 1]) * 100 : 0;
            $pcat = ($ro[$ano]) > 0 ? ($dado["ano_atual"] / $ro[$ano]) * 100 : 0;
            
            ?>
            
            <tr>

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
                                
                <td><?= number_format(abs($dado["ano_anterior"]), 2, ',', '.'); ?></td>
                
                <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>
                
                <td><?= number_format(abs($dado["ano_atual"]), 2, ',', '.'); ?></td>
                
                <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>
                
                <td><?= number_format(abs($dado["ano_atual"]) - abs($dado["ano_anterior"]), 2, ',', '.'); ?></td>

                <td><?= number_format($pc, 2, ',', '.'); ?>%</td>

            </tr>
 
        <?php endforeach; ?>
        
        <?php $pct = ($ro[$ano - 1]) > 0 ? ($ro[$ano] / $ro[$ano - 1]) * 100 : 0; ?>
            
        <tr class="sum">

            <td style="text-align: left;">Receita Operacional Líquida</td>  

            <td><?= number_format($ro[$ano - 1], 2, ',', '.'); ?></td>

            <td>100,00%</td>

            <td><?= number_format($ro[$ano], 2, ',', '.'); ?></td>

            <td>100,00%</td>

            <td><?= number_format($ro[$ano - 1] - $ro[$ano], 2, ',', '.'); ?></td>

            <td><?= number_format($pc, 2, ',', '.'); ?>%</td>

        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">CMV</th>
                
            <th scope="col" colspan="6" class="text-center"></th>

        </tr>
        
        <?php foreach($dados['CMV'] as $dado): 
            
            $pc = ($dado["ano_anterior"]) > 0 ? ($dado["ano_atual"] / $dado["ano_anterior"]) * 100 : 0;
            $pcan = ($ro[$ano - 1]) > 0 ? ($dado["ano_atual"] / $ro[$ano - 1]) * 100 : 0;
            $pcat = ($ro[$ano]) > 0 ? ($dado["ano_atual"] / $ro[$ano]) * 100 : 0;
            
            ?>
            
            <tr>

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
                                
                <td><?= number_format(abs($dado["ano_anterior"]), 2, ',', '.'); ?></td>
                
                <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>
                
                <td><?= number_format(abs($dado["ano_atual"]), 2, ',', '.'); ?></td>
                
                <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>
                
                <td><?= number_format(abs($dado["ano_atual"]) - abs($dado["ano_anterior"]), 2, ',', '.'); ?></td>

                <td><?= number_format($pc, 2, ',', '.'); ?>%</td>

            </tr>
 
        <?php endforeach; ?>
            
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">DESPESAS OPERACIONAIS</th>
                
            <th scope="col" colspan="6" class="text-center"></th>

        </tr>
            
        <?php 
        
        $do[$ano - 1] = 0;
        $do[$ano] = 0;
        
        foreach($dados['DO'] as $dado): 
            
            $do[$ano - 1] += $dado['ano_anterior'];
            $do[$ano] += $dado['ano_atual'];
            
        endforeach; 
        
        ?>

        <?php foreach($dados['DO'] as $dado): 
            
            $pc = ($dado["ano_anterior"]) > 0 ? ($dado["ano_atual"] / $dado["ano_anterior"]) * 100 : 0;
            $pcan = ($ro[$ano - 1]) > 0 ? ($dado["ano_atual"] / $ro[$ano - 1]) * 100 : 0;
            $pcat = ($ro[$ano]) > 0 ? ($dado["ano_atual"] / $ro[$ano]) * 100 : 0;
            
            ?>
            
            <tr>

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
                                
                <td><?= number_format(abs($dado["ano_anterior"]), 2, ',', '.'); ?></td>
                
                <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>
                
                <td><?= number_format(abs($dado["ano_atual"]), 2, ',', '.'); ?></td>
                
                <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>
                
                <td><?= number_format(abs($dado["ano_atual"]) - abs($dado["ano_anterior"]), 2, ',', '.'); ?></td>

                <td><?= number_format($pc, 2, ',', '.'); ?>%</td>

            </tr>
 
        <?php endforeach; ?>
        
        <?php $pcan = ($ro[$ano - 1]) > 0 ? ($do[$ano] / $ro[$ano - 1]) * 100 : 0; ?>
        <?php $pcat = ($ro[$ano]) > 0 ? ($do[$ano] / $ro[$ano]) * 100 : 0; ?>
        <?php $pcro = ($do[$ano - 1]) > 0 ? ($do[$ano] / $do[$ano - 1]) * 100 : 0; ?>
            
        <tr class="sum">

            <td style="text-align: left;">Total das Despesas Operacionais</td>  

            <td><?= number_format($do[$ano - 1], 2, ',', '.'); ?></td>

            <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>

            <td><?= number_format($do[$ano], 2, ',', '.'); ?></td>

            <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>

            <td><?= number_format($do[$ano - 1] - $do[$ano], 2, ',', '.'); ?></td>

            <td><?= number_format($pcro, 2, ',', '.'); ?>%</td>

        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">RESULTADO FINANCEIRO</th>
                
            <th scope="col" colspan="6" class="text-center"></th>

        </tr>
            
        <?php 
        
        $rf[$ano - 1] = 0;
        $rf[$ano] = 0;
        
        foreach($dados['RF'] as $dado): 

            $rf[$ano - 1] += $dado['ano_anterior'] * -1;
            $rf[$ano] += $dado['ano_atual'] * -1;
            
        endforeach; 
        
        ?>

        <?php foreach($dados['RF'] as $dado): 
            
            $pc = ($dado["ano_anterior"]) > 0 ? ($dado["ano_atual"] / $dado["ano_anterior"]) * 100 : 0;
            $pcan = ($ro[$ano - 1]) > 0 ? ($dado["ano_atual"] / $ro[$ano - 1]) * 100 : 0;
            $pcat = ($ro[$ano]) > 0 ? ($dado["ano_atual"] / $ro[$ano]) * 100 : 0;
            
            ?>
            
            <tr>

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
                                
                <td><?= number_format(abs($dado["ano_anterior"]), 2, ',', '.'); ?></td>
                
                <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>
                
                <td><?= number_format(abs($dado["ano_atual"]), 2, ',', '.'); ?></td>
                
                <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>
                
                <td><?= number_format(abs($dado["ano_atual"]) - abs($dado["ano_anterior"]), 2, ',', '.'); ?></td>

                <td><?= number_format($pc, 2, ',', '.'); ?>%</td>

            </tr>
 
        <?php endforeach; ?>
        
        <?php $pcan = ($ro[$ano - 1]) > 0 ? ($rf[$ano] / $ro[$ano - 1]) * 100 : 0; ?>
        <?php $pcat = ($ro[$ano]) > 0 ? ($rf[$ano] / $ro[$ano]) * 100 : 0; ?>
        <?php $pcro = ($rf[$ano - 1]) > 0 ? ($rf[$ano] / $rf[$ano - 1]) * 100 : 0; ?>
            
        <tr class="sum">

            <td style="text-align: left;">Total do Resultado Financeiro</td>  

            <td><?= number_format($rf[$ano - 1], 2, ',', '.'); ?></td>

            <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>

            <td><?= number_format($rf[$ano], 2, ',', '.'); ?></td>

            <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>

            <td><?= number_format($rf[$ano - 1] - $rf[$ano], 2, ',', '.'); ?></td>

            <td><?= number_format($pcro, 2, ',', '.'); ?>%</td>

        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">OUTRAS RECEITAS / DESPESAS</th>
                
            <th scope="col" colspan="6" class="text-center"></th>

        </tr>
            
        <?php 
        
        $ord[$ano - 1] = 0;
        $ord[$ano] = 0;
        $pdd[$ano - 1] = 0;
        $pdd[$ano] = 0;
        
        foreach($dados['ODR'] as $dado): 

            $ord[$ano - 1] += $dado['ano_anterior'] * -1;
            $ord[$ano] += $dado['ano_atual'] * -1;
            
            if(trim($dado['descricao']) == 'Provisão para Devedores Duvidosos')
            {
                $pdd[$ano - 1] += $dado['ano_anterior'];
                $pdd[$ano] += $dado['ano_atual'];
            }
            
        endforeach; 
        
        ?>

        <?php foreach($dados['ODR'] as $dado): 
            
            $pc = ($dado["ano_anterior"]) > 0 ? ($dado["ano_atual"] / $dado["ano_anterior"]) * 100 : 0;
            $pcan = ($ro[$ano - 1]) > 0 ? ($dado["ano_atual"] / $ro[$ano - 1]) * 100 : 0;
            $pcat = ($ro[$ano]) > 0 ? ($dado["ano_atual"] / $ro[$ano]) * 100 : 0;
            
            ?>
            
            <tr>

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
                                
                <td><?= number_format(abs($dado["ano_anterior"]), 2, ',', '.'); ?></td>
                
                <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>
                
                <td><?= number_format(abs($dado["ano_atual"]), 2, ',', '.'); ?></td>
                
                <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>
                
                <td><?= number_format(abs($dado["ano_atual"]) - abs($dado["ano_anterior"]), 2, ',', '.'); ?></td>

                <td><?= number_format($pc, 2, ',', '.'); ?>%</td>

            </tr>
 
        <?php endforeach; ?>
        
        <?php $pcan = ($ro[$ano - 1]) > 0 ? ($ord[$ano] / $ro[$ano - 1]) * 100 : 0; ?>
        <?php $pcat = ($ro[$ano]) > 0 ? ($ord[$ano] / $ro[$ano]) * 100 : 0; ?>
        <?php $pcro = ($ord[$ano - 1]) > 0 ? ($ord[$ano] / $ord[$ano - 1]) * 100 : 0; ?>
            
        <tr class="sum">

            <td style="text-align: left;">Total de Outras Receitas / Depesas </td>  

            <td><?= number_format($ord[$ano - 1], 2, ',', '.'); ?></td>

            <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>

            <td><?= number_format($ord[$ano], 2, ',', '.'); ?></td>

            <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>

            <td><?= number_format($ord[$ano - 1] - $ord[$ano], 2, ',', '.'); ?></td>

            <td><?= number_format($pcro, 2, ',', '.'); ?>%</td>

        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">RESULTADO C/ PDD</th>
                
            <th scope="col" colspan="6" class="text-center"></th>

        </tr>
        
       
        <tr>

            <?php 
            
                $raican = $ro[$ano - 1] - $dados['CMV']['Custo das Mercadorias Vendidas']['ano_anterior'] - $do[$ano -1] 
                    + $rf[$ano -1] - $ord[$ano -1];
                    
                $pcan = ($ro[$ano - 1]) > 0 ? ($raican / $ro[$ano - 1]) * 100 : 0;
                
                $raicat = $ro[$ano] - $dados['CMV']['Custo das Mercadorias Vendidas']['ano_atual'] - $do[$ano] 
                    + $rf[$ano] + $ord[$ano];
                
                $pcat = ($ro[$ano]) > 0 ? ($raicat / $ro[$ano]) * 100 : 0;
                $toto = ($raicat) > 0 ? (($raicat - $raican) / $raicat) * 100 : 0;
                $ptoto = ($pcat) > 0 ? (($pcat - $pcan) / $pcat) * 100 : 0;
            ?>
                                
            <td style="text-align: left;">RESULTADO ANTES IR/CSLL</td>  

            <td><?= number_format($raican, 2, ',', '.'); ?></td>

            <td>-</td>

            <td><?= number_format($raicat, 2, ',', '.'); ?></td>

            <td>-</td>

            <td><?= number_format($raicat - $raican, 2, ',', '.'); ?></td>

            <td><?= number_format($toto, 2, ',', '.'); ?>%</td>

        </tr>
        
        <tr>

            <td style="text-align: left;">Margem Líquida</td>  

            <td><?= number_format($pcan, 2, ',', '.'); ?>%</td>

            <td>-</td>

            <td><?= number_format($pcat, 2, ',', '.'); ?>%</td>

            <td>-</td>

            <td><?= number_format($pcat - $pcan, 2, ',', '.'); ?>%</td>

            <td><?= number_format($ptoto, 2, ',', '.'); ?>%</td>

        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">RESULTADO S/ PDD</th>
                
            <th scope="col" colspan="6" class="text-center"></th>

        </tr>
        
        <tr>

            <?php 
            
                $pddcan = $raican + $pdd[$ano - 1];
                $pddan = ($ro[$ano - 1]) > 0 ? ($pddcan / $ro[$ano - 1]) * 100 : 0;
                
                $pddcat = $raicat + $pdd[$ano];
                $pddat = ($ro[$ano]) > 0 ? ($pddcat / $ro[$ano]) * 100 : 0;
                
                $pddtoto = ($pddcat) > 0 ? (($pddcat - $pddan) / $pddcat) * 100 : 0;
                $pddttoto = ($pddcat) > 0 ? (($pddcat - $pddcan) / $pddcat) * 100 : 0;
            ?>
                                
            <td style="text-align: left;">RESULTADO ANTES IR/CSLL</td>  

            <td><?= number_format($pddcan, 2, ',', '.'); ?></td>

            <td>-</td>

            <td><?= number_format($pddcat, 2, ',', '.'); ?></td>

            <td>-</td>

            <td><?= number_format($pddcat - $pddcan, 2, ',', '.'); ?></td>

            <td><?= number_format($pddtoto, 2, ',', '.'); ?>%</td>

        </tr>
        
        <tr>

            <td style="text-align: left;">Margem Líquida</td>  

            <td><?= number_format($pddan, 2, ',', '.'); ?>%</td>

            <td>-</td>

            <td><?= number_format($pddat, 2, ',', '.'); ?>%</td>

            <td>-</td>

            <td><?= number_format($pddat - $pddan, 2, ',', '.'); ?>%</td>

            <td><?= number_format($pddttoto, 2, ',', '.'); ?>%</td>

        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">&nbsp</th>
                
            <th scope="col" colspan="6" class="text-center"></th>

        </tr>
        
        <?php foreach($dados['RES'] as $dado): 
            
            $res = ($dado["ano_anterior"]) > 0 ? ($dado["ano_atual"] / $dado["ano_anterior"]) * 100 : 0;
            $resan = ($ro[$ano - 1]) > 0 ? ($dado["ano_atual"] / $ro[$ano - 1]) * 100 : 0;
            $resat = ($ro[$ano]) > 0 ? ($dado["ano_atual"] / $ro[$ano]) * 100 : 0;
            
            ?>
            
            <tr>

                <td style="text-align: left;"><?= $dado["descricao"]; ?></td>  
                                
                <td><?= number_format(abs($dado["ano_anterior"]), 2, ',', '.'); ?></td>
                
                <td><?= number_format($resan, 2, ',', '.'); ?>%</td>
                
                <td><?= number_format(abs($dado["ano_atual"]), 2, ',', '.'); ?></td>
                
                <td><?= number_format($resat, 2, ',', '.'); ?>%</td>
                
                <td><?= number_format(abs($dado["ano_atual"]) - abs($dado["ano_anterior"]), 2, ',', '.'); ?></td>

                <td><?= number_format($res, 2, ',', '.'); ?>%</td>

            </tr>
 
        <?php endforeach; ?>
            
        <?php 
                $llaian = $raican - $dado["ano_anterior"];
                $llaiat = $raicat - $dado["ano_atual"];
                $llaito = ($llaiat) > 0 ? (($llaiat - $llaian) / $llaiat) * 100 : 0;
                
                $pllaian = ($ro[$ano - 1]) > 0 ? ($llaian / $ro[$ano - 1]) * 100 : 0;
                $pllaiat = ($ro[$ano]) > 0 ? ($llaiat / $ro[$ano]) * 100 : 0;
        ?>
               
        <tr>    
        
            <td style="text-align: left;">Lucro Líquido Após Impostos</td>  

            <td><?= number_format($llaian, 2, ',', '.'); ?></td>

            <td>-</td>

            <td><?= number_format($llaiat, 2, ',', '.'); ?></td>

            <td>-</td>

            <td><?= number_format($llaiat - $llaian, 2, ',', '.'); ?></td>

            <td><?= number_format($llaito, 2, ',', '.'); ?>%</td>

        </tr>
       
        <tr>

            <td style="text-align: left;">Margem Líquida Após Impostos</td>  

            <td><?= number_format($pllaian, 2, ',', '.'); ?>%</td>

            <td>-</td>

            <td><?= number_format($pllaiat, 2, ',', '.'); ?>%</td>

            <td>-</td>

            <td><?= number_format($pllaiat - $pllaian, 2, ',', '.'); ?>%</td>

            <td>-</td>

        </tr>
        
        <?php 
            $pfinan = ($fin[$ano - 1]) > 0 ? (($fin[$ano - 1] - $dados['CMV']['Custo das Mercadorias Vendidas']['ano_anterior']) / $fin[$ano - 1]) * 100 : 0;
            $pfinat = ($fin[$ano]) > 0 ? (($fin[$ano] - $dados['CMV']['Custo das Mercadorias Vendidas']['ano_atual']) / $fin[$ano]) * 100 : 0;
        ?>
        
        <tr>

            <td style="text-align: left;">Margem sobre Venda</td>  

            <td><?= number_format($pfinan, 2, ',', '.'); ?>%</td>

            <td>-</td>

            <td><?= number_format($pfinat, 2, ',', '.'); ?>%</td>

            <td>-</td>

            <td><?= number_format($pfinat - $pfinan, 2, ',', '.'); ?>%</td>

            <td>-</td>

        </tr>
        
        <tr class="title-category" style="background-color: #247388c2; color: #FFF;">

            <th scope="col">&nbsp</th>
                
            <th scope="col" colspan="6" class="text-center"></th>

        </tr>
            
    </tbody>

</table>