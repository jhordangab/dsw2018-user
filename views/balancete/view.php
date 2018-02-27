<?php

use yii\helpers\Html;
use app\models\BalanceteValor;

$this->title = $model->empresa->razao_social . ' - ' . $model->mes . '/' . $model->ano;
$this->params['breadcrumbs'][] = ['label' => 'Balancetes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

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
        
    $('.i-excluir').click(function () 
    {
        var _id = $(this).data('id');
        
        swal({
            title: "Exclusão de Balancete",
            text: "Deseja excluir o valor do balancete selecionado?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => 
        {
            if (willDelete) 
            {
                jQuery.ajax({
                    url: '/balancete/delete?id=' + _id,
                    success: function (data) 
                    {
                        window.location.reload();
                    },
                });
            }
        });
    });
        
    $("[id^='modal_balancete']").on('hidden.bs.modal', function () 
    {
        window.location.reload();
    });
        
        
JS;

$this->registerJs($js);

?>

<?= $this->render('_wf_iframe_balancete') ?>

<div class="balancete-view box">

    <p>
        <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-default']) ?>
    </p>
    
    <table class="table table-hover">
        
        <thead>
            
            <tr>
                
                <!-- <th scope="col"></th> -->
                
                <th scope="col">Categoria</th>
                
                <th scope="col">Descriçao</th>
                
                <th scope="col">Valor</th>
                
                <th scope="col"></th>
            
            </tr>
        
        </thead>
        
        <tbody class="body-balancete">
            
            <?php foreach($balancetes as $ias => $bas): ?>

                <tr class="open-children" data-id="<?= $bas["attributes"]["id"]; ?>">

                    <!-- <td><i class="fa fa-plus"></i></td> -->
                    
                    <td><?= $bas["attributes"]['desc_codigo']; ?></td>

                    <td><?= $bas["attributes"]['descricao']; ?></td>

                    <td></td>
                    
                    <td></td>

                </tr>
                
                <?php foreach($bas["children"] as $iba => $ba): ?>

                    <tr class="open-children" data-id="<?= $ba["attributes"]["id"]; ?>" data-pai_id="<?= $ba["attributes"]["codigo_pai"]; ?>">

                        <!-- <td><i class="fa fa-plus"></i></td> -->
                        
                        <td><?= $ba["attributes"]['desc_codigo']; ?></td>

                        <td><?= $ba["attributes"]['descricao']; ?></td>

                        <td></td>
                        
                        <td></td>

                    </tr>

                    <?php foreach($ba["children"] as $ibb =>  $bb): ?>

                        <tr class="open-children" data-id="<?= $bb["attributes"]["id"]; ?>" data-pai_id="<?= $bb["attributes"]["codigo_pai"]; ?>">

                            <!-- <td><i class="fa fa-plus"></i></td> -->
                            
                            <td><?= $bb["attributes"]['desc_codigo']; ?></td>

                            <td><?= $bb["attributes"]['descricao']; ?></td>

                            <td></td>
                            
                            <td></td>

                        </tr>

                        <?php foreach($bb["children"] as $ibc =>  $bc): ?>

                            <tr class="open-children" data-id="<?= $bc["attributes"]["id"]; ?>" data-pai_id="<?= $bc["attributes"]["codigo_pai"]; ?>">

                                <!-- <td><i class="fa fa-plus"></i></td> -->
                                
                                <td><?= $bc["attributes"]['desc_codigo']; ?></td>

                                <td><?= $bc["attributes"]['descricao']; ?></td>

                                <td></td>
                                
                                <td></td>

                            </tr>

                            <?php foreach($bc["children"] as $ibd =>  $bd): ?>

                                <tr class="open-children" data-id="<?= $bd["attributes"]["id"]; ?>" data-pai_id="<?= $bd["attributes"]["codigo_pai"]; ?>">

                                    <!-- <td><i class="fa fa-plus"></i></td> -->
                                    
                                    <td><?= $bd["attributes"]['desc_codigo']; ?></td>

                                    <td><?= $bd["attributes"]['descricao']; ?></td>

                                    <td></td>
                                    
                                    <td></td>

                                </tr>

                                <?php foreach($bd["children"] as $ibe =>  $be): ?>

                                    <tr class="open-children" data-id="<?= $be["attributes"]["id"]; ?>" data-pai_id="<?= $be["attributes"]["codigo_pai"]; ?>">

                                        <!-- <td></td> -->
                                        
                                        <td><b><?= $be["attributes"]['desc_codigo']; ?></b></td>

                                        <td><b><?= $be["attributes"]['descricao']; ?></b></td>

                                        <td><b>
                                            
                                            <?php
                                                $fe = BalanceteValor::find()->andWhere(['is_ativo' => TRUE, 'is_excluido' => FALSE, 'balancete_id' => $model->id, 'categoria_id' => $be["attributes"]['codigo']])->one(); 

                                                echo ($fe) ? 'R$ ' . number_format($fe->valor, 2, ',', '.') : '';
                                                
                                                $sum += ($fe) ? $fe->valor : 0;
                                            ?>
                                            
                                        </b></td>
                                        
                                        <td>
                                            <?php if($fe) : ?>
                                            
                                                <i class="fa i-alterar fa-edit" style="cursor: pointer;" data-id="<?= ($fe) ? $fe->id : ''; ?>"></i>
                                                <i class="fa i-excluir fa-trash" style="cursor: pointer;" data-id="<?= ($fe) ? $fe->id : ''; ?>"></i>
                                                
                                            <?php endif; ?>
                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php endforeach; ?>

                        <?php endforeach; ?>

                    <?php endforeach; ?>

                <?php endforeach; ?>

            <?php endforeach; ?>
            
            <tr>
                
                 <!--<td></td> -->
                
                <td></td>
                
                <td></td>
                                
                <td><b>R$ <?= number_format($sum, 2, ',', '.'); ?></b></td>
                
                <td></td>
            
            </tr>
            
        </tbody>
        
    </table>

</div>
