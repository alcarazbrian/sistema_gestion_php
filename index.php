<?php
session_start(); // MUY IMPORTANTE
require_once 'database.php';
require_once 'controllers/product.controller.php';

$controller = new ProductoController();

// CREAR PRODUCTO
if (isset($_POST['create'])) {
    $controller->store($_POST);
    exit;
}

// ACTUALIZAR PRODUCTO
if (isset($_POST['update']) && isset($_POST['id'])) {
    $controller->update($_POST['id'], $_POST);
    exit;
}

// ELIMINAR PRODUCTO
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $controller->delete($_POST['id']);
    exit;
}

// MOSTRAR VIISTA PRINCIPAL
$controller->index();
