<?php
use yii\helpers\Html;
$notifikasi = Yii::$app->helpers->getNotifikasiUser();
$pesan      = Yii::$app->helpers->getPesanUser();

$jumlahRead = 0;
foreach ($pesan as $key => $value) {
 if ($value['is_read'] == 1) {
     $jumlahRead +=1;
 }
}

$jumlahPesan = count($pesan);
$unRead     = $jumlahPesan - $jumlahRead;

?>
<header id="header" class="ui-header ui-header--blue text-white">
    <div class="navbar-header">
        <!-- logo start -->
        <a href="/" class="navbar-brand">
            <span class="logo" style="font-size: 32px;">INVENTORY</span>
        </a>
    </div>

    <div class="navbar-collapse nav-responsive-disable">
        
        <!-- toggle button start -->
        <ul class="nav navbar-nav">
            <li>
                <a class="toggle-btn" data-toggle="ui-nav" href="#">
                    <i class="fa fa-bars"></i>
                </a>
            </li>
        </ul>
        <!-- toggle buttons end -->

        <!-- notification start -->
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell-o"></i>
                    <?php echo (count($notifikasi) > 0 ) ? "<span class=\'badge'>". count($notifikasi) . "</span>" : ''; ?>
                </a>
                <!-- dropdown -->
                <ul class="dropdown-menu dropdown-menu--responsive">
                    <div class="dropdown-header">Notifikasi (<?php echo count($notifikasi); ?>)</div>
                    <ul class="Notification-list Notification-list--small niceScroll list-group">
                        <?php foreach ($notifikasi as $key => $notif): ?>
                            <li class="Notification list-group-item">
                                <a href="<?php echo $notif['url'] ?>">
                                    <div class="Notification__avatar Notification__avatar--danger pull-left" href="#">
                                    <img src="<?php echo $notif['avatar'] ?>">
                                </div>
                                <div class="Notification__highlight">
                                    <p class="Notification__highlight-excerpt"><b><?php echo $notif['title'] ?></b><br> <?php echo strip_tags($notif['message']) ?></p>
                                    <p class="Notification__highlight-time">
                                        <?php echo Yii::$app->helperStatic->someTimeAgo($notif['created_at']) ?>
                                    </p>
                                </div>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                    <div class="dropdown-footer"><a href="#">View more</a></div>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <?php echo ($unRead > 0 ) ? "<span class='badge'>". $unRead ."</span>" : '' ?>
                </a>
                <!-- dropdown -->
                <ul class="dropdown-menu dropdown-menu--responsive">
                    <div class="dropdown-header">Messages (<?php echo count($pesan) ?>)</div>
                    <ul class="Message-list niceScroll list-group">
                    <?php foreach($pesan as $key => $inbox) : ?>
                        <li class="Message list-group-item">
                            <button class="Message__status Message__status--<?php echo ($inbox['is_read'] == 0 ) ? 'unread' : 'read' ?>" type="button" name="button"></button>
                            <a href="/pesan/view?id=<?php echo $inbox['id'] ?>">
                                <div class="Message__avatar Message__avatar--danger pull-left" href="#">
                                    <img src="<?php echo $inbox['avatar'] ?>" alt="...">
                                </div>
                                <div class="Message__highlight">
                                    <span class="Message__highlight-name"><?php echo $inbox['title'] ?></span>
                                    <p class="Message__highlight-excerpt"><?php echo substr(strip_tags($inbox['message']), 0, 60); ?> ...</p>
                                    <p class="Message__highlight-time"><?php echo Yii::$app->helperStatic->someTimeAgo($inbox['created_at']) ?></<p>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    <div class="dropdown-footer"><a href="/pesan">Lihat Semua</a></div>
                </ul>
                <!--/ dropdown -->
            </li>

            <li class="dropdown dropdown-usermenu">
                <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <div class="user-avatar"><img src="<?php echo Yii::$app->session['fotoPegawai'] ?>" alt="..."></div>
                    <span class="hidden-sm hidden-xs"><?php echo ucwords(Yii::$app->session['namaPegawai']) ?></span>
                    <!--<i class="fa fa-angle-down"></i>-->
                    <span class="caret hidden-sm hidden-xs"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                    <li><a href="/profile/data-profile/index"><i class="fa fa-user"></i> Profile</a></li>
                    <li><a href="/site/change-password"><i class="fa fa-unlock-alt"></i> Ubah Pasword</a></li>
                    <li class="divider"></li>
                    <li>
                        <?php 
                            echo Html::beginForm(['/site/logout'], 'post')
                                . Html::submitButton(
                                    '<i class="fa fa-sign-out"></i> Logout',
                                    ['class' => 'btn btn-link logout']
                                )
                                . Html::endForm()
                        ?>
                    </li>
                </ul>
            </li>
        </ul>


    </div>
</header>