<aside class="main-sidebar" style="background-color: #224158">

    <section class="sidebar">

        <?php if(in_array(Yii::$app->user->identity->perfil_id, ['1', '26'])) : ?>
        
            <?= dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => 
                    [
                        ['label' => 'Resultados', 'icon' => 'line-chart', 'url' => ['/resultado']],
                        ['label' => 'Confronto', 'icon' => 'bar-chart', 'url' => ['/confronto']],
                        ['label' => 'Média de Mercado', 'icon' => 'trophy', 'url' => ['/media-mercado']],
                        ['label' => 'Balancetes', 'icon' => 'calculator', 'url' => ['/balancete']],
                        ['label' => 'Cadastros', 'icon' => 'edit',
                            'items' =>
                            [
                                ['label' => 'Empresa', 'icon' => 'building', 'url' => ['/empresa']],
                                ['label' => 'Bandeira', 'icon' => 'flag', 'url' => ['/bandeira']],
                                ['label' => 'Faturamento', 'icon' => 'money', 'url' => ['/faturamento']],
                                ['label' => 'Região', 'icon' => 'map', 'url' => ['/regiao']],
                                ['label' => 'Segmento', 'icon' => 'barcode', 'url' => ['/segmento']],
                                ['label' => 'Planos Padrões', 'icon' => 'tags', 'url' => ['/plano-padrao']],
                                ['label' => 'DE - PARA', 'icon' => 'retweet', 'url' => ['/de-para']],
                            ]
                        ],
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
