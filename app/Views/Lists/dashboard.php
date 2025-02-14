<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Panel de Administración</h2>
        <!-- Mensajes de éxito o error -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <form method="GET" action="<?= base_url('users') ?>" class="mb-3">
            <div class="container d-flex">
                <div class="input-group w-auto">
                    <input type="text" name="name" class="form-control" placeholder="Nombre" value="<?= $name ?>">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>
        <!-- Tabla de usuarios -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Genero</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Rol</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Fecha de Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['ID_USER'] ?></td>
                            <td><?= $user['NAME'] ?></td>
                            <td><?= $user['SURNAME'] ?></td>
                            <td><?= $user['GENDER'] ?></td>
                            <td><?= $user['BORN_DATE'] ?></td>
                            <td><?= $user['ROLE'] ?></td>
                            <td><?= $user['EMAIL'] ?></td>
                            <td><?= $user['PHONE_NUMBER'] ?></td>
                            <td><?= $user['created_at'] ?></td>
                            <td>
                                <a href="<?= base_url('edit/' . $user['ID_USER']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="<?= base_url('delete/' . $user['ID_USER']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center">No hay usuarios registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="mt-4">
            <?= $pager->links('default', 'custom_pagination') ?>
        </div>

        <!-- Botón para añadir nuevo usuario -->
        <div class="text-center mb-3">
            <a href="<?= base_url('register') ?>" class="btn btn-primary">Añadir Usuario</a>
        </div>

        <!-- Botón de cerrar sesión -->
        <div class="text-center">
            <a href="<?= base_url('logout') ?>" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </div>
</body>

</html>