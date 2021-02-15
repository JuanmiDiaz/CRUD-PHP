
<!-- include para añadir el menu a todas nuestras paginas-->

<nav>
        <div class="logo" > <img  src="img/logo.png" ></div>
        <div class="nombre"><p>elPonyPisador</p></div>
        <div class="nav-item"><a href="logout.php">LogOut</a></div>
        <div class="nav-item"><a href="login.php">LogIn</a></div>
        <div class="nav-item"><a href="insertar.php">AÑADIR</a></div>
        <div class="nav-item"><a href="coleccion.php">COLECCION</a></div>
        <div class="nav-item"><a href="index.php">INICIO</a></div>

    <?php
    if($_SESSION['permiso']>2)
    echo '<div class="nav-item-secreto"><a href="controlUsuarios.php">Control de usuarios</a></div>';

    ?>

</nav>




