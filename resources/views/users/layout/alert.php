<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .alert {
            padding: 20px;
            color: white;
            margin: 10px 0;
        }

        .alert-danger {
            background-color: #f44336;
        }

        .alert-info {
            background-color:#2DCDDF;
        }

        .alert-success {
            background-color: #38E54D;
        }
        .alert-warning {
            background-color: #FF5B00;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>
</head>

<body>

    <?php if(isset($_COOKIE['success'])){ ?>
        <div class="alert alert-success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?= $_COOKIE['success']  ?>
        </div>
    <?php } ?>

    <?php if(isset($_COOKIE['error'])){ ?>
        <div class="alert alert-danger">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?= $_COOKIE['error']  ?>
        </div>
    <?php } ?>

    <?php if(isset($_COOKIE['warning'])){ ?>
        <div class="alert alert-warning">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?= $_COOKIE['warning']  ?>
        </div>
    <?php } ?>

    <?php if(isset($_COOKIE['info'])){ ?>
        <div class="alert alert-info">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?= $_COOKIE['info']  ?>
        </div>
    <?php } ?>

</body>

</html>