<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Inicio de Sesión</h2>
        <form action="<?= base_url('login/process') ?>" method="post" class="mt-4">
            <?= csrf_field() ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" value="<?= old('email') ?>">
                <small class="text-danger"><?= isset($validation) ? $validation->getError('email') : '' ?></small>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control">
                <small class="text-danger"><?= isset($validation) ? $validation->getError('password') : '' ?></small>
            </div>
            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
        </form>
        <p class="text-center mt-3">¿No tienes una cuenta? <a href="<?= base_url('register') ?>">Regístrate</a></p>
    </div>
</body>
</html>
