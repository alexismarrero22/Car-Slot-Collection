<!DOCTYPE html>
<html>
<head>
    <title>Panel de Administrador</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: auto; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #333; color: white; }
        tr:nth-child(even) { background-color: whitesmoke; }
        form { display: inline; }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Panel de Administración</h1>

    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php require_once'../controllers/userController.php';
            userController::showUsersByAdmin();
        ?>
    </table>
</body>