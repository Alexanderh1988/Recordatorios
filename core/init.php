<?php
 
//local:
$db = mysqli_connect('127.0.0.1', 'root', '', 'chs44206_dbhstech');
 
// session_start();  //22

if (mysqli_connect_error()) {
    echo 'Database connection failed with following errors: ' . mysqli_connect_error();
    die();
}
 

if (isset($_SESSION['success_flash'])) {
    echo '<div class="bg-success"><p class="text-success text-center">' . $_SESSION['success_flash'] . '</p></div>';
    unset($_SESSION['success_flash']);  //para que no se muestra en otra pagina cada vez que cambias
}
//obs: una posible mejora seria aplicar un script de javascript para que el anuncio de sesion exitosa se elimine despues de un tiempo en vez de tener que cambiar de pagina
if (isset($_SESSION['error_flash'])) {
    echo '<div class="bg-danger"><p class="text-danger text-center">' . $_SESSION['error_flash'] . '</p></div>';
    unset($_SESSION['error_flash']);
}
//session_destroy();  //hay que editr esta variable varias veces antes de hacer el boton de log out

$cfg['DefaultCharset'] = 'utf-8';