<?php
//close sessions
session_start();
session_destroy();
header("Location:../index.html");
?>