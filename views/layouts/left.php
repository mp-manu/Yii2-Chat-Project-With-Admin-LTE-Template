<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->session->get('username') ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    ['label' => 'Главная страница', 'icon' => '', 'url' => ['/']],
                    ['label' => 'Чат', 'icon' => '', 'url' => ['/chat/list'], 'visible' => Yii::$app->user->can('/chat/list')],
                    ['label' => 'Пользователи', 'icon' => '', 'url' => ['/user'], 'visible' => Yii::$app->user->can('/user/index')],
                    ['label' => 'Некорректные сообщение', 'icon' => '', 'url' => ['/messages/incorrect'], 'visible' => Yii::$app->user->can('/message/incorrect')],
                    [
                        'label' => 'RBAC',
                        'icon' => 'cogs',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Assignments', 'icon' => 'cogs', 'url' => ['/rbac'], 'visible' => Yii::$app->user->can('/rbac/*')],
                            ['label' => 'Roles', 'icon' => 'cogs', 'url' => ['/rbac/role'], 'visible' => Yii::$app->user->can('/rbac/*')],
                            ['label' => 'Routes', 'icon' => 'cogs', 'url' => ['/rbac/route'], 'visible' => Yii::$app->user->can('/rbac/*')],
                            ['label' => 'Permission', 'icon' => 'cogs', 'url' => ['/rbac/permission'], 'visible' => Yii::$app->user->can('/rbac/*')],
                        ], 'visible' => Yii::$app->user->can('/rbac/*')
                    ],
                    ['label' => 'Выход', 'icon' => '', 'url' => ['/site/logout']],
                ],
            ]
        ) ?>

    </section>

</aside>
