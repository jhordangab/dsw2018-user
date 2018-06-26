<?php
use yii\helpers\Html;

?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">' . Html::img('@web/img/logo-mini.png', ['alt' => Yii::$app->name, 'class' => 'img-responsive']) . '</span><span class="logo-lg">' . Html::img('@web/img/agrocontar_white.png', ['alt' => Yii::$app->name, 'style' => 'width: 90px; margin-left: auto; margin-right: auto;', 'class' => 'img-responsive']) . '</span>', Yii::$app->homeUrl, ['class' => 'logo', 'style' => 'background-color: #233746']) ?>

    <nav class="navbar navbar-static-top" style="background-color: #227584;"role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        
        <?php if($this->title) : ?>
        
            <ul class="nav navbar-nav navbar-title hidden-xs">

                <li>
                    <a href="<?= \yii\helpers\Url::current(['lg'=>NULL], TRUE); ?>">
                        <span class="hidden-xs">
                            <?= Html::encode($this->title) ?>
                        </span>
                    </a>
                </li>

            </ul>
        
        <?php endif; ?>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    
                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    
                        <span><?= Html::img('@web/img/bp1_logo_branco.png', ['width' => '40px', 'style' =>['margin-right' => '10px', 'margin-top' => '-10px']]) ?><?= Yii::$app->user->identity->nome ?></span>
                        
                    </a>
                    
                </li>

            </ul>
            
        </div>
        
    </nav>
    
</header>
