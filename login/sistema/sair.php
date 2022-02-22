<?php
    session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    //session_regenerate_id(true);
    // Redirecionar a pessoa de volta à tela de login:
    header("Location: ../index.php?msg=3");

?>