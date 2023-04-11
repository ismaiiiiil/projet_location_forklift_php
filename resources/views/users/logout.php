<?php


unset($_SESSION['id_user']);
unset($_SESSION['nom_user']);
unset($_SESSION['email_user']);
unset($_SESSION['commander']);

header('Location: home');