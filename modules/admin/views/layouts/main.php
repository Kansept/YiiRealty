<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

use yii\helpers\Html;

app\assets\AdminAsset::register($this);
$bundle = yiister\gentelella\assets\Asset::register($this);

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="nav-md">
<?php $this->beginBody(); ?>
<div class="container body">

    <div class="main_container">

        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">

                <div class="navbar nav_title" style="border: 0;">
                    <a href="/" class="site_title"><i class="fa fa-home"></i> <span>PLATINUM!</span></a>
                </div>
                <div class="clearfix"></div>

                <!-- menu prile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="/images/logo-small.png" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Добро пожаловать,</span>
                        <h2><?= Yii::$app->user->identity->username ?></h2>
                    </div>
                </div>
                <!-- /menu prile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="clear"></div>
                    <div class="menu_section">
                        <?=
                        \yiister\gentelella\widgets\Menu::widget(
                            [
                                "items" => [
                                    ["label" => "Главная", "url" => ['/admin/dashboard'], "icon" => "home"],
                                    [
                                        "label" => "Контент",
                                        "icon" => "th",
                                        "url" => "#",
                                        "items" => [
                                            ["label" => "Категории", 'icon' => 'list', "url" => ['/admin/page/category']],
                                            ["label" => "Страницы", 'icon' => 'newspaper-o', "url" => ['/admin/page']],
                                            ["label" => "Меню", 'icon' => 'navicon', "url" => ['/admin/menu']],
                                        ],
                                    ],
                                    [
                                        "label" => "Недвижимость",
                                        "icon" => "th",
                                        "url" => "#",
                                        "items" => [
                                            ["label" => "Типы объектов", 'icon' => 'building', "url" => ['/admin/realty/realty-type']],
                                            ["label" => "Типы сделок", 'icon' => 'list', "url" => ['/admin/realty/realty-transaction']],
                                            ["label" => "Объекты", 'icon' => 'newspaper-o', "url" => ['/admin/realty/realty']],
                                        ],
                                    ],
                                    [
                                        "label" => "Пользователи", "url" => "#", "icon" => "table", "items" => [
                                            [ "label" => "Пользователи", "url" => ['/admin/user'] ],
                                            [
                                                "label" => "Контроль доступа", "url" => "#", "items" => [
                                                    ['label' => 'Маршруты',  'url' => ['/admin/rbac/route']],
                                                    ['label' => 'Разрешения',  'url' => ['/admin/rbac/permission']],
                                                    ['label' => 'Роли',  'url' => ['/admin/rbac/role']],
                                                    ['label' => 'Назначения',  'url' => ['/admin/rbac/assignment']],
                                                ],
                                            ],
                                        ],
                                    ],
                                    ['label' => 'gii', 'icon' => 'file-o', 'url' => ['/gii']],
                                    ['label' => 'Файл менеджер', 'icon' => 'file-o', 'url' => ['/admin/filemanager']],
                                    ['label' => 'Настройки', 'icon' => 'gear', 'url' => ['/admin/setting']],
                                ],
                            ]
                        )
                        ?>
                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <?= \Yii::$app->user->identity->username ?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li>
                                    <?= Html::a(
                                        'Профиль',
                                        ['/admin/user/default/view', 'id' => \Yii::$app->user->id]
                                    ) ?>
                                </li>
                                <li>
                                    <?= Html::a(
                                        ' Выход',
                                        ['/admin/default/logout'],
                                        ['data-method' => 'post', 'class' => 'fa fa-sign-out pull-right']
                                    ) ?>
                                </li>
                            </ul>
                        </li>

                        <li role="presentation">
                            <?= Html::a(
                                '<span class="badge bg-green">Перейти на сайт</span>',
                                ['/'],
                                ['target' => '_blank']
                            ) ?>
                        </li>

                    </ul>
                </nav>
            </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <?php if (isset($this->params['h1'])): ?>
                <div class="page-title">
                    <div class="title_left">
                        <h1><?= $this->params['h1'] ?></h1>
                    </div>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="clearfix"></div>

            <div class="content">
                <?= \yii\widgets\Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
            <?= $content ?>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com" rel="nofollow" target="_blank">Colorlib</a><br />
                Extension for Yii framework 2 by <a href="http://yiister.ru" rel="nofollow" target="_blank">Yiister</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>

</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>
<!-- /footer content -->
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
