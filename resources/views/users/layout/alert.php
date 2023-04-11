<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="public/css/toast.css">
</head>

<body>

    <?php if(isset($_COOKIE['success'])){ ?>
        <li class="toast success">
            <div class="column">
                <i class="fa-solid fa-circle-check"></i>
                <span><?= $_COOKIE['success']  ?></span>
            </div>
            <i class="fa-solid fa-xmark" onclick="removeToast(this.parentElement)"></i>
        </li>
    <?php } ?>

    <?php if(isset($_COOKIE['error'])){ ?>
        <li class="toast error">
            <div class="column">
                <i class="fa-solid fa-circle-xmark"></i>
                <span><?= $_COOKIE['error']  ?></span>
            </div>
            <i class="fa-solid fa-xmark" onclick="removeToast(this.parentElement)"></i>
        </li>
    <?php } ?>

    <?php if(isset($_COOKIE['warning'])){ ?>
        <li class="toast warning">
            <div class="column">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span><?= $_COOKIE['warning']  ?></span>
            </div>
            <i class="fa-solid fa-xmark" onclick="removeToast(this.parentElement)"></i>
        </li>
    <?php } ?>

    <?php if(isset($_COOKIE['info'])){ ?>
        <li class="toast info">
            <div class="column">
                <i class="fa-solid fa-circle-info"></i>
                <span><?= $_COOKIE['info']  ?></span>
            </div>
            <i class="fa-solid fa-xmark" onclick="removeToast(this.parentElement)"></i>
        </li>
    <?php } ?>

    <script>
        const removeToast = (toast) => {
            toast.classList.add("hide");
            if (toast.timeoutId) clearTimeout(toast.timeoutId); // Clearing the timeout for the toast
            setTimeout(() => toast.remove(), 500); // Removing the toast after 500ms
        };
        const toast = document.querySelector(".toast"); // Creating a new 'li' element for the toast
        toast.timeoutId = setTimeout(() => removeToast(toast), 5000);
    </script>
</body>

</html>
