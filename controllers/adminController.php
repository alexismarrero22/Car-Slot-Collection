<?php
session_start();

if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
require_once '../models/User.php';
$action = $_GET['action'] ?? '';
$id = $_POST['id'] ?? null; 

if(!$id || !is_numeric($id)) {
    header('Location: ../views/adminPanel.php');
    exit();
}

switch ($action) {
    case 'change':
        changeUserStatus($id);
        break;
    case 'delete':
        deleteUser($id);
        break;
    default:
        header('Location: ../views/adminPanel.php');
        exit();
}

//Funcion para cambiar el estado de un usuario
function changeUserStatus($id)
{
    $usuario = new User();
    $usuario->setId($id);
    $usuario->toggleActivo();
    header('Location: ../views/adminPanel.php');
    exit();
}

//Funcion para eliminar un usuario
function deleteUser($id)
{
    $usuario = new User();
    $usuario->setId($id);
    $usuario->delete();
    header('Location: ../views/adminPanel.php');
    exit();
}
