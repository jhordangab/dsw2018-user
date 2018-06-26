<?php

use yii\helpers\Html;
use app\models\BalanceteValor;

$this->title = 'Meu Balancete: ' . $model->mes . '/' . $model->ano;
$this->params['breadcrumbs'][] = ['label' => 'Meus Balancetes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$sum = 0;

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

?>

<div class="balancete-view box box-success">

    <p>
        <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-default']) ?>
    </p>
    
    <div class="css-treeview" style="margin: 10px;">

        <ul>

            <?php foreach($balancetes as $ias => $bas): ?>

                <li>

                    <input type="checkbox" id="item-<?= $ias; ?>" />

                    <label for="item-<?= $ias; ?>">
                        <span class="span-left">
                            <?= $bas["attributes"]['desc_codigo'] . ' - ' . $bas["attributes"]['descricao']; ?>
                        </span>

                        <span class="span-right">
                            <?php
                                $fas = BalanceteValor::find()->andWhere(['is_ativo' => TRUE, 'is_excluido' => FALSE, 'balancete_id' => $model->id, 'categoria_id' => $bas["attributes"]['codigo']])->one(); 

                                echo ($fas) ? 'R$ ' . number_format($fas->valor, 2, ',', '.') : 'R$ 0,00';
                            ?>
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
                                        <?php
                                            $fa = BalanceteValor::find()->andWhere(['is_ativo' => TRUE, 'is_excluido' => FALSE, 'balancete_id' => $model->id, 'categoria_id' => $ba["attributes"]['codigo']])->one(); 

                                            echo ($fa) ? 'R$ ' . number_format($fa->valor, 2, ',', '.') : 'R$ 0,00';
                                        ?>
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
                                                    <?php
                                                        $fb = BalanceteValor::find()->andWhere(['is_ativo' => TRUE, 'is_excluido' => FALSE, 'balancete_id' => $model->id, 'categoria_id' => $bb["attributes"]['codigo']])->one(); 

                                                        echo ($fb) ? 'R$ ' . number_format($fb->valor, 2, ',', '.') : 'R$ 0,00';
                                                    ?>
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
                                                                <?php
                                                                    $fc = BalanceteValor::find()->andWhere(['is_ativo' => TRUE, 'is_excluido' => FALSE, 'balancete_id' => $model->id, 'categoria_id' => $bc["attributes"]['codigo']])->one(); 

                                                                    echo ($fc) ? 'R$ ' . number_format($fc->valor, 2, ',', '.') : 'R$ 0,00';
                                                                ?>
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
                                                                            <?php
                                                                                $fd = BalanceteValor::find()->andWhere(['is_ativo' => TRUE, 'is_excluido' => FALSE, 'balancete_id' => $model->id, 'categoria_id' => $bd["attributes"]['codigo']])->one(); 

                                                                                echo ($fd) ? 'R$ ' . number_format($fd->valor, 2, ',', '.') : 'R$ 0,00';
                                                                            ?>
                                                                        </span>

                                                                    </label>

                                                                    <ul>

                                                                        <?php foreach($bd["children"] as $ibe =>  $be): ?>

                                                                            <li class="service">

                                                                                <span class="span-left">
                                                                                    <i class="fa fa-arrow-right"></i> <?= $be["attributes"]['desc_codigo'] . ' - ' . $be["attributes"]['descricao']; ?>
                                                                                </span>

                                                                                <span class="span-right">
                                                                                    <?php
                                                                                        $fe = BalanceteValor::find()->andWhere(['is_ativo' => TRUE, 'is_excluido' => FALSE, 'balancete_id' => $model->id, 'categoria_id' => $be["attributes"]['codigo']])->one(); 

                                                                                        echo ($fe) ? 'R$ ' . number_format($fe->valor, 2, ',', '.') : 'R$ 0,00';
                                                                                    ?>
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
