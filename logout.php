<?php
/**
 * teniendo la sesion iniciada le decimos que la cierre con destroy
 * luego nos vamos al index
 */
session_start();
session_destroy();
header("location:index.php");

