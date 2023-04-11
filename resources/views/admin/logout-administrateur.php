<?php


unset($_SESSION['nom_admin']);
unset($_SESSION['email_admin']);
unset($_SESSION['login_admin']);
unset($_SESSION['admin']);
unset($_SESSION['manager']);

header('Location: login-administrateur');