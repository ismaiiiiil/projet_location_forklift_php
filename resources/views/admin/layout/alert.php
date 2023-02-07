<?php if (isset($_COOKIE['success'])) { ?>
    <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
        <strong>Bravo!</strong><?= $_COOKIE['success']  ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

<?php if (isset($_COOKIE['danger'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
        <strong>Error!</strong><?= $_COOKIE['danger']  ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

<?php if (isset($_COOKIE['info'])) { ?>
    <div class="alert alert-info alert-dismissible fade show my-3" role="alert">
        <strong>Bravo!</strong><?= $_COOKIE['info']  ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

<?php if (isset($_COOKIE['primary'])) { ?>
    <div class="alert alert-primary alert-dismissible fade show my-3" role="alert">
        <strong>Bravo!</strong><?= $_COOKIE['primary']  ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

<?php if (isset($_COOKIE['warning'])) { ?>
    <div class="alert alert-warning alert-dismissible fade show my-3" role="alert">
        <strong>Bravo!</strong><?= $_COOKIE['warning']  ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>