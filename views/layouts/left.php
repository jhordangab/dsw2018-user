<aside class="main-sidebar" style="background-color: #224158">

    <section class="sidebar">

        <?php if(in_array(Yii::$app->user->identity->perfil_id, ['1', '26'])) : ?>
        
            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => 
                    [
                        ['label' => 'Resultados', 'icon' => 'bar-chart',
                            'items' =>
                            [
                                ['label' => 'Balancete', 'icon' => 'tag', 'url' => ['/resultado-balancete/']],
                                ['label' => 'CMV', 'icon' => 'tag', 'url' => ['/resultado-cmv']],
                                ['label' => 'Despesas', 'icon' => 'tag', 'url' => ['/resultado-despesa']],
                                ['label' => 'Outras Despesas', 'icon' => 'tag', 'url' => ['/resultado-outra-despesa']],
                            ]
                        ],
                        ['label' => 'Planos Padrões', 'icon' => 'tags', 'url' => ['/categoria']],
                        ['label' => 'Balancetes', 'icon' => 'calculator', 'url' => ['/balancete']],
                        ['label' => 'Logs', 'icon' => 'eye', 'url' => ['/log']],
                        ['label' => 'Sair', 'icon' => 'sign-out', 'url' => ['/site/logout']],
                    ],
                ]
            ) ?>
            
        <?php else : ?>
        
            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => 
                    [
                        ['label' => 'Meus Balancetes', 'icon' => 'calculator', 'url' => ['/meus-balancetes']],
                        ['label' => 'Sair', 'icon' => 'sign-out', 'url' => ['/site/logout']],
                    ],
                ]
            ) ?>
        
        <?php endif; ?>
        
    </section>

</aside>
