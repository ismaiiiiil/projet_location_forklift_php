<?php


unset($_SESSION['nom_admin']);
unset($_SESSION['email_admin']);
unset($_SESSION['login_admin']);
unset($_SESSION['admin']);

header('Location: login-administrateur');