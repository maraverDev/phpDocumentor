<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Editar Usuario</h2>
            </div>
            <div class="card-body">
                <!-- Mensajes de error -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <!-- Formulario de edición -->
                <form action="<?= base_url('update/' . $user['ID_USER']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="<?= old('name', $user['NAME']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Apellidos</label>
                        <input type="text" id="name" name="surname" class="form-control"
                            value="<?= old('SURNAME', $user['SURNAME']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo</label>
                        <input type="email" id="email" name="email" class="form-control"
                            value="<?= old('email', $user['EMAIL']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Género</label>
                        <select name="gender" class="form-control">
                            <option value="<?= old('gender', $user['GENDER']) ?>"><?= old('gender', $user['GENDER']) ?></option>
                            <option value="Male">Masculino</option>
                            <option value="Female">Femenino</option>
                            <option value="Other">Otro</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Telefono de Contacto</label>
                        <input type="text" id="phone_number" name="phone_number" class="form-control"
                            value="<?= old('phone_number', $user['PHONE_NUMBER']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="born_date" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" id="born_date" name="born_date" class="form-control"
                            value="<?= old('BORN_DATE', $user['BORN_DATE']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nueva Contraseña (opcional)</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirm" class="form-label">Confirmar Nueva Contraseña</label>
                        <input type="password" id="password_confirm" name="password_confirm" class="form-control">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>