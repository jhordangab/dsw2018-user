<aside class="main-sidebar">

    <section class="sidebar">

        <?php if(Yii::$app->user->identity->nome == 'Cliente') : ?>
        
            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => 
                    [
                        ['label' => 'Meus Balancetes', 'icon' => 'calculator', 'url' => ['/meus-balancetes']],
                    ],
                ]
            ) ?>
        
        <?php else : ?>
        
            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => 
                    [
                        ['label' => 'Categorias Padrões', 'icon' => 'tags', 'url' => ['/categoria']],
                        ['label' => 'Balancetes', 'icon' => 'calculator', 'url' => ['/balancete']],
                    ],
                ]
            ) ?>
        
        <?php endif; ?>
        
    </section>

</aside>
