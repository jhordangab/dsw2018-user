<?php

$this->title = 'Planos padrões';
$this->params['breadcrumbs'][] = $this->title;

$css = <<<CSS
        
    .css-treeview ul,
    .css-treeview li
    {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .css-treeview input
    {
        position: absolute;
        opacity: 0;
    }

    .css-treeview
    {
        font: normal 11px "Segoe UI", Arial, Sans-serif;
        -moz-user-select: none;
        -webkit-user-select: none;
        user-select: none;
    }

    .css-treeview a
    {
        color: #00f;
        text-decoration: none;
    }

    .css-treeview a:hover
    {
        text-decoration: underline;
    }

    .css-treeview input + label + ul
    {
        margin: 0 0 0 22px;
    }

    .css-treeview input ~ ul
    {
        display: none;
    }

    .css-treeview label,
    .css-treeview label::before
    {
        cursor: pointer;
    }

    .css-treeview input:disabled + label
    {
        cursor: default;
        opacity: .6;
    }

    .css-treeview input:checked:not(:disabled) ~ ul
    {
        display: block;
    }

    .css-treeview label,
    .css-treeview label::before
    {
        background: url("/img/icons.png") no-repeat;
    }

    .css-treeview label,
    .css-treeview a,
    .css-treeview label::before
    {
        display: inline-block;
        height: 16px;
        line-height: 16px;
        vertical-align: middle;
    }

    .css-treeview label
    {
        background-position: 18px 0;
        width: 100%;
    }
        
    .css-treeview span
    {
        margin: 2px;
        height: 16px;
        line-height: 16px;
        display: inline-block;
        vertical-align: middle;
    }
        
    .css-treeview span.span-right
    {
        float: right;
    }

    .css-treeview label::before
    {
        content: "";
        width: 16px;
        margin: 0 22px 0 0;
        vertical-align: middle;
        background-position: 0 -32px;
    }

    .css-treeview input:checked + label::before
    {
        background-position: 0 -16px;
    }
        
    span.span-right i.fa 
    {
        padding: 5px;
    }

    /* webkit adjacent element selector bugfix */
    @media screen and (-webkit-min-device-pixel-ratio:0)
    {
        .css-treeview 
        {
            -webkit-animation: webkit-adjacent-element-selector-bugfix infinite 1s;
        }

        @-webkit-keyframes webkit-adjacent-element-selector-bugfix 
        {
            from 
            { 
                padding: 0;
            } 
            to 
            { 
                padding: 0;
            }
        }
    }
        
    .css-treeview li:hover > label,
    .css-treeview > li:focus > label,
    .css-treeview li.service:hover,
    .css-treeview > li.service:focus
    {
        background-color: #e2ede8e0;
    }
        
CSS;

$this->registerCss($css);

$js = <<<JS
        
    $('.i-cadastrar').click(function () 
    {
        var _id = $(this).data('id');
        var url = '/plano-padrao/create?pai_id=' + _id;
        $('#iframe_modal_balancete').attr('src', url);
        $("[id^='modal_balancete']").modal("show");
        $('.modal-backdrop').removeClass('modal-backdrop');
        $('#modal_balancete .modal-header h3').text('Cadastrar plano de contas padrão');
    });
        
    $('.i-alterar').click(function () 
    {
        var _id = $(this).data('id');
        var url = '/plano-padrao/update?id=' + _id;
        $('#iframe_modal_balancete').attr('src', url);
        $("[id^='modal_balancete']").modal("show");
        $('.modal-backdrop').removeClass('modal-backdrop');
        $('#modal_balancete .modal-header h3').text('Alterar plano de contas padrão');
    });
        
    $('.i-excluir').click(function () 
    {
        var _id = $(this).data('id');
        
        swal({
            title: "Exclusão de plano de contas padrão",
            text: "Deseja excluir o plano selecionado?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => 
        {
            if (willDelete) 
            {
                jQuery.ajax({
                    url: '/plano-padrao/delete?id=' + _id,
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

<div class="plano-padrao-index box box-success">

    <div class="css-treeview">
    
        <ul>
            
            <?php foreach($balancetes as $ias => $bas): ?>
        
                <li>

                    <input type="checkbox" id="item-<?= $ias; ?>" />

                    <label for="item-<?= $ias; ?>">
                        <span class="span-left">
                            <?= $bas["attributes"]['desc_codigo'] . ' - ' . $bas["attributes"]['descricao']; ?>
                        </span>
                        
                        <span class="span-right">
                            <i class="fa i-cadastrar fa-plus" data-id="<?= $bas["attributes"]['id']; ?>"></i>
                            <i class="fa i-alterar fa-edit" data-id="<?= $bas["attributes"]['id']; ?>"></i>
                            <i class="fa i-excluir fa-trash" data-id="<?= $bas["attributes"]['id']; ?>"></i>
                        </span>
                    </label>

                    <ul>
                        
                        <?php foreach($bas["children"] as $iba => $ba): ?>
                        
                            <li>
                                
                                <input type="checkbox" id="item-<?= $ias; ?>-<?= $iba; ?>" />
                                
                                <label for="item-<?= $ias; ?>-<?= $iba; ?>">
                                    
                                    <span class="span-left">
                                        <?= $ba["attributes"]['desc_codigo'] . ' - ' . $ba["attributes"]['descricao']; ?>
                                    </span>

                                    <span class="span-right">
                                        <i class="fa i-cadastrar fa-plus" data-id="<?= $ba["attributes"]['id']; ?>"></i>
                                        <i class="fa i-alterar fa-edit" data-id="<?= $ba["attributes"]['id']; ?>"></i>
                                        <i class="fa i-excluir fa-trash" data-id="<?= $ba["attributes"]['id']; ?>"></i>
                                    </span>
                                    
                                </label>
                                
                                <ul>
                                    
                                    <?php foreach($ba["children"] as $ibb =>  $bb): ?>
                                    
                                        <li>

                                            <input type="checkbox" id="item-<?= $ias; ?>-<?= $iba; ?>-<?= $ibb; ?>" />
                                            
                                            <label for="item-<?= $ias; ?>-<?= $iba; ?>-<?= $ibb; ?>">
                                                
                                                <span class="span-left">
                                                    <?= $bb["attributes"]['desc_codigo'] . ' - ' . $bb["attributes"]['descricao']; ?>
                                                </span>

                                                <span class="span-right">
                                                    <i class="fa i-cadastrar fa-plus" data-id="<?= $bb["attributes"]['id']; ?>"></i>
                                                    <i class="fa i-alterar fa-edit" data-id="<?= $bb["attributes"]['id']; ?>"></i>
                                                    <i class="fa i-excluir fa-trash" data-id="<?= $bb["attributes"]['id']; ?>"></i>
                                                </span>

                                            </label>

                                            <ul>
                                    
                                                <?php foreach($bb["children"] as $ibc =>  $bc): ?>

                                                    <li>

                                                        <input type="checkbox" id="item-<?= $ias; ?>-<?= $iba; ?>-<?= $ibb; ?>-<?= $ibc; ?>" />

                                                        <label for="item-<?= $ias; ?>-<?= $iba; ?>-<?= $ibb; ?>-<?= $ibc; ?>">
                                                            
                                                            <span class="span-left">
                                                                <?= $bc["attributes"]['desc_codigo'] . ' - ' . $bc["attributes"]['descricao']; ?>
                                                            </span>

                                                            <span class="span-right">
                                                                <i class="fa i-cadastrar fa-plus" data-id="<?= $bc["attributes"]['id']; ?>"></i>
                                                                <i class="fa i-alterar fa-edit" data-id="<?= $bc["attributes"]['id']; ?>"></i>
                                                                <i class="fa i-excluir fa-trash" data-id="<?= $bc["attributes"]['id']; ?>"></i>
                                                            </span>
                                                            
                                                        </label>

                                                        <ul>
                                    
                                                            <?php foreach($bc["children"] as $ibd =>  $bd): ?>

                                                                <li>

                                                                    <input type="checkbox" id="item-<?= $ias; ?>-<?= $iba; ?>-<?= $ibb; ?>-<?= $ibc; ?>-<?= $ibd; ?>" />

                                                                    <label for="item-<?= $ias; ?>-<?= $iba; ?>-<?= $ibb; ?>-<?= $ibc; ?>-<?= $ibd; ?>">
                                                                        
                                                                        <span class="span-left">
                                                                            <?= $bd["attributes"]['desc_codigo'] . ' - ' . $bd["attributes"]['descricao']; ?>
                                                                        </span>

                                                                        <span class="span-right">
                                                                            <i class="fa i-cadastrar fa-plus" data-id="<?= $bd["attributes"]['id']; ?>"></i>
                                                                            <i class="fa i-alterar fa-edit" data-id="<?= $bd["attributes"]['id']; ?>"></i>
                                                                            <i class="fa i-excluir fa-trash" data-id="<?= $bd["attributes"]['id']; ?>"></i>
                                                                        </span>
                                                                        
                                                                    </label>

                                                                    <ul>
                                    
                                                                        <?php foreach($bd["children"] as $ibe =>  $be): ?>

                                                                            <li class="service">

                                                                                <span class="span-left">
                                                                                    <i class="fa fa-arrow-right"></i> <?= $be["attributes"]['desc_codigo'] . ' - ' . $be["attributes"]['descricao']; ?>
                                                                                </span>

                                                                                <span class="span-right">
                                                                                    <i class="fa i-alterar fa-edit" data-id="<?= $be["attributes"]['id']; ?>"></i>
                                                                                    <i class="fa i-excluir fa-trash" data-id="<?= $be["attributes"]['id']; ?>"></i>
                                                                                </span>
                                                                                
                                                                            </li>

                                                                        <?php endforeach; ?>

                                                                    </ul>

                                                                </li>

                                                            <?php endforeach; ?>

                                                        </ul>

                                                    </li>

                                                <?php endforeach; ?>

                                            </ul>

                                        </li>
                                        
                                    <?php endforeach; ?>
                                    
                                </ul>
                                
                            </li>
                        
                        <?php endforeach; ?>
                        
                    </ul>

                </li>
        
            <?php endforeach; ?>
        
        </ul>
        
    </div>

</div>
