<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="signUp">
    <input type="text" name="fullname" placeholder="Tu nombre" maxlength="15" value="<?= $fullname ?>" required>
    <input type="email" name="email" placeholder="Tu Correo" value="<?= $email ?>" required>
    <input type="password" name="password" placeholder="Tu Contraseña" value="<?= $pass ?>" minlength="4" required>
    <input type="text" name="location" placeholder="Poblacion" maxlength="15" value="<?= $location ?>" value="null">
    <input type="tel" name="phone" placeholder="Tu Telefono" maxlength="15" value="<?= $phone ?>" value="null">
    <input type="file" name="imageUser" accept="image/*" required>
    <input type="submit" value="Registar">
</form>