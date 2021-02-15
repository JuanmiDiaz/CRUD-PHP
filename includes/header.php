

<header>
    <div class="usuarioActivo">
        <h4>Bienvenido, <?php if(isset($_SESSION['id_usuario'])) echo $_SESSION['nombre'] ?> <?php if(isset($_SESSION['id_usuario'])) echo $_SESSION['apellidos'] ?>         </h4>

    </div>
</header>