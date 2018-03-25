<?php
session_start();
if ($_SESSION["level"] == 1) {} else {header( 'Location: /hk/login/?' ) ;}
?>
