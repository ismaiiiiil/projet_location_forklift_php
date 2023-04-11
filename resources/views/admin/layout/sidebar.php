<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                <li class="submenu active">
                    <a href="<?php echo BASE_URL ?>dashboard"><i class="feather-grid"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="<?php echo BASE_URL ?>dashboard" class="active">Admin Dashboard</a></li>
                    </ul>
                </li>
                <?php if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) { ?>
                    <li class="submenu">
                        <a href="<?php echo BASE_URL ?>dashboard"><i class="fa-solid fa-trowel"></i> <span> Machine</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="<?php echo BASE_URL ?>machine">Machine List</a></li>
                            <li><a href="<?php echo BASE_URL ?>add-machine">Machine Add</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="<?php echo BASE_URL ?>dashboard"><i class="fa-solid fa-grip-vertical"></i><span>Categories</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="<?php echo BASE_URL ?>category">Category List</a></li>
                            <li><a href="<?php echo BASE_URL ?>add-category">Category Add</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="<?php echo BASE_URL ?>dashboard"><i class="fa-solid fa-users"></i> <span> Users</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="<?php echo BASE_URL ?>users">Users List</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="<?php echo BASE_URL ?>manager"><i class="fa-solid fa-user-gear"></i> <span> Manager</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="<?php echo BASE_URL ?>manager">Manager List</a></li>
                            <li><a href="<?php echo BASE_URL ?>add-manager">Manager Add</a></li>
                        </ul>
                    </li>
                    <li class="menu-title">
                        <span>Management</span>
                    </li>
                    <li class="submenu">
                        <a href="<?php echo BASE_URL ?>dashboard"><i class="fas fa-file-invoice-dollar"></i> <span> Orders</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="<?php echo BASE_URL ?>orders">Orders List</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="<?php echo BASE_URL ?>dashboard"><i class="fa-solid fa-comments"></i> <span> Feedback</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="<?php echo BASE_URL ?>testimonials">Feedback</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="<?php echo BASE_URL ?>dashboard"><i class="fa-solid fa-money-check-dollar"></i><span>Bénéfices</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="<?php echo BASE_URL ?>perte_materielles">pertes matérielles</a></li>
                            <li><a href="<?php echo BASE_URL ?>benefices">bénéfices</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL ?>settings"><i class="fas fa-cog"></i> <span>Settings</span></a>
                    </li>

                <?php } elseif (isset($_SESSION["manager"])) { ?>
                    <?php if(!!$roles->machines): ?>
                        <li class="submenu">
                            <a href="<?php echo BASE_URL ?>dashboard"><i class="fa-solid fa-trowel"></i> <span> Machine</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?php echo BASE_URL ?>machine">Machine List</a></li>
                                <?php if(!!$roles->add_machine): ?>
                                    <li><a href="<?php echo BASE_URL ?>add-machine">Machine Add</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if(!!$roles->categories): ?>
                    <li class="submenu">
                        <a href="<?php echo BASE_URL ?>dashboard"><i class="fa-solid fa-grip-vertical"></i><span>Categories</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="<?php echo BASE_URL ?>category">Category List</a></li>
                            <?php if(!!$roles->add_category): ?>
                                <li><a href="<?php echo BASE_URL ?>add-category">Category Add</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(!!$roles->users): ?>
                        <li class="submenu">
                            <a href="<?php echo BASE_URL ?>dashboard"><i class="fa-solid fa-users"></i> <span> Users</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?php echo BASE_URL ?>users">Users List</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <li class="menu-title">
                        <span>Management</span>
                    </li>
                    <?php if(!!$roles->orders): ?>
                        <li class="submenu">
                            <a href="<?php echo BASE_URL ?>dashboard"><i class="fas fa-file-invoice-dollar"></i> <span> Orders</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?php echo BASE_URL ?>orders">Orders List</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if(!!$roles->feedback): ?>
                        <li class="submenu">
                            <a href="<?php echo BASE_URL ?>dashboard"><i class="fa-solid fa-comments"></i> <span> Feedback</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?php echo BASE_URL ?>testimonials">Feedback</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if(!!$roles->benefices || !!$roles->perte_materilles): ?>
                        <li class="submenu">
                            <a href="<?php echo BASE_URL ?>dashboard"><i class="fa-solid fa-money-check-dollar"></i><span>Bénéfices</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <?php if(!!$roles->perte_materilles): ?>
                                    <li><a href="<?php echo BASE_URL ?>perte_materielles">pertes matérielles</a></li>
                                <?php endif; ?>
                                <?php if(!!$roles->benefices): ?>
                                    <li><a href="<?php echo BASE_URL ?>benefices">bénéfices</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if(false): ?>
                        <li>
                            <a href="<?php echo BASE_URL ?>settings"><i class="fas fa-cog"></i> <span>Settings</span></a>
                        </li>
                    <?php endif; ?>
                <?php } ?>


            </ul>
        </div>
    </div>
</div>
