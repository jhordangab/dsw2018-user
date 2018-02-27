<?php
use yii\helpers\Html;

?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">' . Html::img('@web/img/logo-mini.png', ['alt' => Yii::$app->name, 'class' => 'img-responsive']) . '</span><span class="logo-lg">' . Html::img('@web/img/logo.png', ['alt' => Yii::$app->name, 'style' => 'width: 80px;', 'class' => 'img-responsive']) . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        
        <?php if($this->title) : ?>
        
            <ul class="nav navbar-nav navbar-title hidden-xs">

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(Yii::$app->requestedRoute) ?>">
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
                    
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span><?= Yii::$app->user->identity->nome ?></span>
                    </a>
                    
                    <ul class="dropdown-menu">

                        <li class="user-footer">
                            <?= Html::a(
                                'Sair',
                                ['/site/logout'],
                                ['data-method' => 'post']
                            ) ?>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
