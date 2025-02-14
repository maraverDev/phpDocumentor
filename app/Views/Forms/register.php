<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Registro de Usuario</h2>
        <form action="<?= base_url('register/process') ?>" method="post" class="mt-4">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control" value="<?= old('name') ?>">
                <small class="text-danger"><?= isset($validation) ? $validation->getError('name') : '' ?></small>
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label">Apellidos</label>
                <input type="text" name="surname" class="form-control" value="<?= old('surname') ?>">
                <small class="text-danger"><?= isset($validation) ? $validation->getError('surname') : '' ?></small>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" value="<?= old('email') ?>">
                <small class="text-danger"><?= isset($validation) ? $validation->getError('email') : '' ?></small>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Género</label>
                <select name="gender" class="form-control">
                    <option value="">Selecciona tu género</option>
                    <option value="Male">Masculino</option>
                    <option value="Female">Femenino</option>
                    <option value="Other">Otro</option>
                </select>
                <small class="text-danger"><?= isset($validation) ? $validation->getError('gender') : '' ?></small>

            </div>
            <div class="mb-3">
                <label for="born_date" class="form-label">Fecha de Nacimiento</label>
                <input type="date" name="born_date" class="form-control" value="<?= old('born_date') ?>">
                <small class="text-danger"><?= isset($validation) ? $validation->getError('born_date') : '' ?></small>

            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Teléfono</label>
                <input type="text" name="phone_number" class="form-control" placeholder="Escribe tu número de teléfono" value="<?= old('phone_number') ?>">
                <small class="text-danger"><?= isset($validation) ? $validation->getError('phone_number') : '' ?></small>

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control">
                <small class="text-danger"><?= isset($validation) ? $validation->getError('password') : '' ?></small>
            </div>
            <div class="mb-3">
                <label for="password_confirm" class="form-label">Confirmar Contraseña</label>
                <input type="password" name="password_confirm" class="form-control">
                <small class="text-danger"><?= isset($validation) ? $validation->getError('password_confirm') : '' ?></small>
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </form>
        <p class="text-center mt-3">¿Ya tienes una cuenta? <a href="<?= base_url('login') ?>">Inicia sesión</a></p>
    </div>
</body>
</html>
