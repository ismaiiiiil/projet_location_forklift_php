use DateTime;
<div class="header">

            <div class="header-left">
                <a href="<?php echo BASE_URL ?>dashboard" class="logo">
                    <img src="public/images/website/<?= $web->logo ?>?v=<?php echo time(); ?>" alt="Logo">
                </a>
                <a href="<?php echo BASE_URL ?>dashboard" class="logo logo-small">
                    <img src="public/images/website/<?= $web->logo ?>?v=<?php echo time(); ?>" alt="Logo">
                </a>
            </div>

            <div class="menu-toggle">
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="fas fa-bars"></i>
                </a>
            </div>

            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control" placeholder="Search here">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>


            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>

            <!-- calendar -->
            <ul class="nav user-menu">

                <li class="nav-item dropdown noti-dropdown me-2">
                    <a href="#" class="dropdown-toggle nav-link header-nav-list position-relative" data-bs-toggle="dropdown">
                        <img src="resources/views/admin/assets/img/icons/calendar.svg" alt="">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        style="width: fit-content;">
                            <?= $nbrOrderNow->nbrOrdersNow ?>
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <!-- notification -->
                                <?php
                                foreach($notification as $n):
                                ?>
                                <li class="notification-message" onclick="showNotification(<?= $n->id_order ?>);">
                                    <a  href="javascript:void(0)" >
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm flex-shrink-0">
                                                <img class="avatar-img rounded-circle" alt="User Image"
                                                    src="public/images/users/<?= $n->user_photo ?>">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                            <?php
                                                $datetime1 = strtotime(date('Y-m-d'));
                                                $datetime2 = strtotime($n->date_order);

                                                $secs = $datetime1 - $datetime2; // == <seconds between the two times>
                                                $days = $secs / 86400;
                                            ?>
                                                <p class="noti-details"><span class="noti-title"><?= $n->nom_user ?></span> Commander la machine <span class="noti-title"><?= $n->nom_machine ?></span></p>
                                                <p class="noti-time"><span class="notification-time"><?= $days == 0 ? "Ajourd'huit" : $days . " Jrs" ?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </div>
                        <form action="<?php echo BASE_URL ?>show-notification" id="form_notification" method="POST">
                            <input type="hidden" name="id_show" id="id_notification">
                        </form>
                        <div class="topnav-dropdown-footer">
                            <a href="javascript:void(0)">View all Notifications</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown noti-dropdown me-2">
                    <a href="#" class="dropdown-toggle nav-link header-nav-list position-relative" data-bs-toggle="dropdown">
                        <img src="resources/views/admin/assets/img/icons/header-icon-05.svg" alt="">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        style="width: fit-content;">
                            <?= $nbrOrderNow->nbrOrdersNow ?>
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <!-- notification -->
                                <?php
                                foreach($notification as $n):
                                ?>
                                <li class="notification-message" onclick="showNotification(<?= $n->id_order ?>);">
                                    <a  href="javascript:void(0)" >
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm flex-shrink-0">
                                                <img class="avatar-img rounded-circle" alt="User Image"
                                                    src="public/images/users/<?= $n->user_photo ?>">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                            <?php
                                                $datetime1 = strtotime(date('Y-m-d'));
                                                $datetime2 = strtotime($n->date_order);

                                                $secs = $datetime1 - $datetime2; // == <seconds between the two times>
                                                $days = $secs / 86400;
                                                // --------------------

                                                    $tDeb = explode("-", date('Y-m-d'));
                                                    $tFin = explode("-", $n->date_order);

                                                    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
                                                            mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);


                                                    if(intval($tDeb[1]) >= 7)
                                                    {
                                                        $res =  abs(floor((($diff / 86400)+1)));
                                                    }
                                                    elseif(intval($tDeb[1]) < 7)
                                                    {
                                                        $res = abs(ceil((($diff / 86400)+1)));
                                                    }


                                            ?>
                                                <p class="noti-details"><span class="noti-title"><?= $n->nom_user ?></span> Commander la machine <span class="noti-title"><?= $n->nom_machine ?></span></p>
                                                <p class="noti-time"><span class="notification-time"><?= $res == 0 ? "Ajourd'huit" : $res . " Jrs" ?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </div>
                        <form action="<?php echo BASE_URL ?>show-notification" id="form_notification" method="POST">
                            <input type="hidden" name="id_show" id="id_notification">
                        </form>
                        <div class="topnav-dropdown-footer">
                            <a href="javascript:void(0)">View all Notifications</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item zoom-screen me-2">
                    <a href="#" class="nav-link header-nav-list">
                        <img src="resources/views/admin/assets/img/icons/header-icon-04.svg" alt="">
                    </a>
                </li>

                <li class="nav-item dropdown has-arrow new-user-menus">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="public/images/<?= isset($_SESSION["admin"]) && $_SESSION["admin"] === true ? 'admin' : 'manager' ?>/<?= $adminInfo->admin_profile ?>" width="31"
                                alt="<?= $_SESSION['nom_admin'] ?>">
                            <div class="user-text">
                                <h6><?= $_SESSION['nom_admin'] ?></h6>
                                <p class="text-muted mb-0">Administrator</p>
                            </div>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img src="public/images/<?= isset($_SESSION["admin"]) && $_SESSION["admin"] === true ? 'admin' : 'manager' ?>/<?= $adminInfo->admin_profile ?>" alt="User Image"
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="user-text">
                                <h6><?= $_SESSION['nom_admin'] ?></h6>
                                <p class="text-muted mb-0">Administrator</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="<?php echo BASE_URL ?>profile-administrateur">My Profile</a>
                        <a class="dropdown-item" href="<?php echo BASE_URL ?>logout-administrateur">Logout</a>
                    </div>
                </li>

            </ul>

        </div>
