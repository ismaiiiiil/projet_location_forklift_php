<?php

use app\Controllers\FeedbackController;

$feedback = new FeedbackController($_POST);

$feedbackList = $feedback->getAllFeedback();

if(isset($_POST['id_edit_inactive'])) {
    $feedback->changeActive($_POST['id_edit_inactive']);
}elseif(isset($_POST['id_edit_active'])) {
    $feedback->changeInactive($_POST['id_edit_active']);
}elseif(isset($_POST['id_delete'])) {
    $feedback->deleteFeedback($_POST['id_delete']);
    // var_dump($_POST);
}



include 'layout/header.php';
?>

<body>

    <div class="main-wrapper">

        <?= include('layout/navbar.php');
        include 'layout/sidebar.php';
        ?>

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Rating</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Components</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Alert message -->
                <?php include("layout/alert.php"); ?>
                <div class="row">
                <?php foreach($feedbackList as $feedback) :  ?>
                    <div class="col-md-6 col-xl-4 col-sm-12 d-flex">
                        <div class="blog grid-blog flex-fill">
                            <div class="blog-content">
                                <ul class="entry-meta meta-item">
                                    <li>
                                        <div class="post-author">
                                            <a href="profile.html">
                                                <img src="public/images/users/<?= $feedback->user_photo ?>" alt="Post Author">
                                                <span>
                                                    <span class="post-title"><?= $feedback->nom ?></span>
                                                    <span class="post-date"><i class="far fa-clock"></i> <?php echo date('d F Y', strtotime($feedback->date_feedback)) ?></span>
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                <h3 class="blog-title"><a href="blog-details.html"><?= $feedback->nom ." " . $feedback->prenom ?> </a></h3>
                                <p><?= $feedback->description ?></p>
                                <?php for($i=0; $i < $feedback->rating; $i++ ): ?>
                                    <div class="rating rating-default fa-solid fa-star text-warning"></div>
                                <?php endfor; ?>
                            </div>
                            <div class="row">
                                <div class="edit-options">
                                    <?php if(isset($_SESSION["admin"])){ ?>
                                        <div class="edit-delete-btn">
                                            <a href="edit-blog.html" class="text-success" style="display: none;"><i class="feather-edit-3 me-1"></i> Edit</a>
                                            <a href="#" class="text-danger"
                                            onclick="deleteFeedback(<?= $feedback->feedback_id ?>)"
                                            data-bs-toggle="modal" data-bs-target="#model-delete"><i class="feather-trash-2 me-1"></i>
                                                Delete</a>
                                        </div>
                                    <?php }elseif(!!$roles->delete_feedback && isset($_SESSION["manager"])){ ?>
                                        <div class="edit-delete-btn">
                                            <a href="edit-blog.html" class="text-success" style="display: none;"><i class="feather-edit-3 me-1"></i> Edit</a>
                                            <a href="#" class="text-danger"
                                            onclick="deleteFeedback(<?= $feedback->feedback_id ?>)"
                                            data-bs-toggle="modal" data-bs-target="#model-delete"><i class="feather-trash-2 me-1"></i>
                                                Delete</a>
                                        </div>
                                    <?php } ?>

                                    <div class="text-end inactive-style">
                                        <?php if(isset($_SESSION["admin"])){ ?>
                                            <?php if($feedback->active){ ?>
                                                <a href="javascript:void(0);" class="text-success" onclick="changeInactive(<?= $feedback->feedback_id ?>)" ><i class="feather-eye me-1"></i>
                                                Active</a>
                                                <form method="post" id="form_edit_active">
                                                    <input type="hidden" id="id_edit_active" name="id_edit_active">
                                                </form>
                                            <?php }else{ ?>
                                                <a href="javascript:void(0);" class="text-danger" onclick="changeActive(<?= $feedback->feedback_id ?>)" ><i class="feather-eye-off me-1"></i>
                                                    Inactive</a>
                                                <form method="post" id="form_edit_inactive">
                                                    <input type="hidden" id="id_edit_inactive" name="id_edit_inactive">
                                                </form>
                                            <?php } ?>
                                        <?php }elseif(!!$roles->controle_feedback && isset($_SESSION["manager"])){ ?>
                                            <?php if($feedback->active){ ?>
                                                <a href="javascript:void(0);" class="text-success" onclick="changeInactive(<?= $feedback->feedback_id ?>)" ><i class="feather-eye me-1"></i>
                                                Active</a>
                                                <form method="post" id="form_edit_active">
                                                    <input type="hidden" id="id_edit_active" name="id_edit_active">
                                                </form>
                                            <?php }else{ ?>
                                                <a href="javascript:void(0);" class="text-danger" onclick="changeActive(<?= $feedback->feedback_id ?>)" ><i class="feather-eye-off me-1"></i>
                                                    Inactive</a>
                                                <form method="post" id="form_edit_inactive">
                                                    <input type="hidden" id="id_edit_inactive" name="id_edit_inactive">
                                                </form>
                                            <?php } ?>
                                        <?php } ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>

            <div id="model-delete" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-right">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <h4 class="mt-0">Voulez-vous vraiment supprimer ce feedback ?</h4>
                                <small class="font-weight-bold" style="color:#edb200;">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Cette action ne peut pas être annulée !
                                </small>
                                <hr/>
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                <!-- delete -->
                                <button type="submit" onclick="submitFormDetete()" class="btn btn-danger btn-sm" data-bs-dismiss="modal">
                                    Delete
                                </button>

                                <form id='form_delete' method="POST">
                                    <input type="hidden" name="id_delete" id="id_delete">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer>
                <p>Copyright © 2022 Dreamguys.</p>
            </footer>

        </div>

    </div>



    <script src="resources/views/admin/assets/js/jquery-3.6.0.min.js"></script>

    <script src="resources/views/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="resources/views/admin/assets/js/feather.min.js"></script>

    <script src="resources/views/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="resources/views/admin/assets/plugins/datatables/datatables.min.js"></script>

    <script src="resources/views/admin/assets/js/script.js"></script>


    <script>
        function changeActive(id) {
            var form = document.getElementById('form_edit_inactive');
            var input = document.getElementById('id_edit_inactive');
            input.value = id;
            form.submit();
        }


        // ----------------------------------
        function changeInactive(id) {
            var form = document.getElementById('form_edit_active');
            var input = document.getElementById('id_edit_active');
            input.value = id;
            form.submit();
        }

        function deleteFeedback(id) {
            var form = document.getElementById('form_delete');
            var input = document.getElementById('id_delete');
            input.value = id;
        }

        function submitFormDetete() {
            var form = document.getElementById('form_delete');
            form.submit();
        }
    </script>
</body>

</html>
