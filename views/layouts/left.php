<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => 
                [
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/']],
                    ['label' => 'Categorias', 'icon' => 'tags', 'url' => ['/']],
                    ['label' => 'Balancetes', 'icon' => 'file-o', 'url' => ['/']],
                    ['label' => 'Empresas', 'icon' => 'building', 'url' => ['/']],
                    ['label' => 'Configurações', 'icon' => 'cogs', 'url' => ['/']]
                ],
            ]
        ) ?>

    </section>

</aside>
