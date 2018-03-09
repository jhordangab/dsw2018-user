<?php

use app\models\BalanceteValor;

$sum = 0;

$js = <<<JS
        
   
    $(document).delegate('.body-balancete .open-children .fa-plus', 'click', function()
    {
        var _id = $(this).parent().parent().data('id');
        
        $('.open-children[data-pai_id="' + _id + '"]').show();

        $(this).removeClass('fa-plus');
        $(this).addClass('fa-minus');
    });
        
    $(document).delegate('.body-balancete .open-children .fa-minus', 'click', function()
    {
        var _id = $(this).parent().parent().data('id');
        
        $('.open-children[data-pai_id="' + _id + '"]').hide();

        $(this).removeClass('fa-minus');
        $(this).addClass('fa-plus');
    });
        
    $('.i-alterar').click(function () 
    {
        var _id = $(this).data('id');
        var url = '/balancete/update?id=' + _id;
        $('#iframe_modal_balancete').attr('src', url);
        $("[id^='modal_balancete']").modal("show");
        $('.modal-backdrop').removeClass('modal-backdrop');
        $('#modal_balancete .modal-header h3').text('Alterar Balancete');
    });
        
    $('.i-inserir').click(function () 
    {
        var _balanceteid = $(this).data('balanceteid');
        var _categoriaid = $(this).data('categoriaid');
        var url = '/balancete/create?balancete_id=' + _balanceteid + '&categoria_id=' + _categoriaid;
        $('#iframe_modal_balancete').attr('src', url);
        $("[id^='modal_balancete']").modal("show");
        $('.modal-backdrop').removeClass('modal-backdrop');
        $('#modal_balancete .modal-header h3').text('Alterar Balancete');
    });
        
JS;

$this->registerJs($js);

?>

<table class="table table-hover">

    <thead>

        <tr>

            <th scope="col"></th>

            <th scope="col">Categoria</th>

            <th scope="col">Descriçao</th>

            <th scope="col">Valor</th>

            <th scope="col"></th>

        </tr>

    </thead>

    <tbody class="body-balancete">

        <?php foreach($balancetes as $ias => $bas): ?>

            <tr class="open-children" style="background-color: #80808033" data-id="<?= $bas["attributes"]["codigo"]; ?>">

                <td><i class="fa fa-plus"></i></td>

                <td><?= $bas["attributes"]['desc_codigo']; ?></td>

                <td><?= $bas["attributes"]['descricao']; ?></td>

                <td class="val-<?= $ias ?>"></td>

                <td></td>

            </tr>

            <?php $sumba = 0; foreach($bas["children"] as $iba => $ba): ?>

                <tr class="open-children closed" style="background-color: #80808024" data-id="<?= $ba["attributes"]["codigo"]; ?>" data-pai_id="<?= $ba["attributes"]["codigo_pai"]; ?>">

                    <td><i class="fa fa-plus"></i></td>

                    <td><?= $ba["attributes"]['desc_codigo']; ?></td>

                    <td><?= $ba["attributes"]['descricao']; ?></td>

                    <td class="val-<?= $iba . '-' . $ias ?>"></td>

                    <td></td>

                </tr>

                <?php $sumbb = 0; foreach($ba["children"] as $ibb =>  $bb): ?>

                    <tr class="open-children closed" style="background-color: #8080801c" data-id="<?= $bb["attributes"]["codigo"]; ?>" data-pai_id="<?= $bb["attributes"]["codigo_pai"]; ?>">

                        <td><i class="fa fa-plus"></i></td>

                        <td><?= $bb["attributes"]['desc_codigo']; ?></td>

                        <td><?= $bb["attributes"]['descricao']; ?></td>

                        <td class="val-<?= $ibb . '-' . $iba . '-' . $ias ?>"></td>

                        <td></td>

                    </tr>

                    <?php $sumbc = 0; foreach($bb["children"] as $ibc =>  $bc): ?>

                        <tr class="open-children closed" style="background-color: #80808014" data-id="<?= $bc["attributes"]["codigo"]; ?>" data-pai_id="<?= $bc["attributes"]["codigo_pai"]; ?>">

                            <td><i class="fa fa-plus"></i></td>

                            <td><?= $bc["attributes"]['desc_codigo']; ?></td>

                            <td><?= $bc["attributes"]['descricao']; ?></td>

                            <td class="val-<?= $ibc . '-' . $ibb . '-' . $iba . '-' . $ias ?>"></td>

                            <td></td>

                        </tr>

                        <?php $sumbd = 0; foreach($bc["children"] as $ibd =>  $bd): ?>

                            <tr class="open-children closed" style="background-color: #8080800a" data-id="<?= $bd["attributes"]["codigo"]; ?>" data-pai_id="<?= $bd["attributes"]["codigo_pai"]; ?>">

                                <td><i class="fa fa-plus"></i></td>

                                <td><?= $bd["attributes"]['desc_codigo']; ?></td>

                                <td><?= $bd["attributes"]['descricao']; ?></td>

                                <td class="val-<?= $ibd . '-' . $ibc . '-' . $ibb . '-' . $iba . '-' . $ias ?>"></td>

                                <td></td>

                            </tr>

                            <?php $sumbe = 0; foreach($bd["children"] as $ibe =>  $be): ?>

                                <tr class="open-children closed" style="background-color: #80808000" data-id="<?= $be["attributes"]["codigo"]; ?>" data-pai_id="<?= $be["attributes"]["codigo_pai"]; ?>">

                                    <td></td>

                                    <td><b><?= $be["attributes"]['desc_codigo']; ?></b></td>

                                    <td><b><?= $be["attributes"]['descricao']; ?></b></td>

                                    <td><b>

                                        <?php
                                            $fe = BalanceteValor::find()->andWhere(['is_ativo' => TRUE, 'is_excluido' => FALSE, 'balancete_id' => $model->id, 'categoria_id' => $be["attributes"]['codigo']])->one(); 

                                            echo ($fe) ? 'R$ ' . number_format($fe->valor, 2, ',', '.') : 'R$ 0,00';

                                            $sum += ($fe) ? $fe->valor : 0;
                                            $sumbe += ($fe) ? $fe->valor : 0;
                                            $sumbd += ($fe) ? $fe->valor : 0;
                                            $sumbc += ($fe) ? $fe->valor : 0;
                                            $sumbb += ($fe) ? $fe->valor : 0;
                                            $sumba += ($fe) ? $fe->valor : 0;
                                        ?>

                                    </b></td>

                                    <td class="text-center">

                                        <?php if($fe) : ?>

                                            <i class="fa i-alterar fa-edit" style="cursor: pointer;" data-id="<?= ($fe) ? $fe->id : ''; ?>"></i>

                                        <?php else: ?>

                                            <i class="fa i-inserir fa-edit" style="cursor: pointer;" data-balanceteid="<?= $model->id; ?>" data-categoriaid="<?= $be["attributes"]["codigo"]; ?>"></i>

                                        <?php endif; ?>

                                    </td>

                                </tr>

                            <?php endforeach; 
                            
                            $valbe = 'R$ ' . number_format($sumbe, 2, ',', '.');    
                            $valbd = 'R$ ' . number_format($sumbd, 2, ',', '.');   
                            $valbc = 'R$ ' . number_format($sumbc, 2, ',', '.');    
                            $valbb = 'R$ ' . number_format($sumbb, 2, ',', '.');    
                            $valba = 'R$ ' . number_format($sumba, 2, ',', '.');    
                            
                            $js = <<<JS
   
   
                                $('.val-{$ibd}-{$ibc}-{$ibb}-{$iba}-{$ias}').html('{$valbe}');
                                $('.val-{$ibc}-{$ibb}-{$iba}-{$ias}').html('{$valbd}');
                                $('.val-{$ibb}-{$iba}-{$ias}').html('{$valbc}');
                                $('.val-{$iba}-{$ias}').html('{$valbb}');
                                $('.val-{$ias}').html('{$valba}');
                                    
JS;
                                $this->registerJs($js);
                            
                            ?>

                        <?php endforeach; ?>

                    <?php endforeach; ?>

                <?php endforeach; ?>

            <?php endforeach; ?>

        <?php endforeach; ?>

        <tr>

            <td></td>

            <td></td>

            <td class="text-left"><b>TOTAL</b></td>

            <td><b>R$ <?= number_format($sum, 2, ',', '.'); ?></b></td>

            <td></td>

        </tr>

    </tbody>

</table>