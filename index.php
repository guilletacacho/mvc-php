<?php
session_start();
require_once(__DIR__ . "/app/Configuration.php");

$configuration = new Configuration();
$router = $configuration->getRouter();

$router->dispatch(
    $_GET["controller"] ?? "evento",
    $_GET["method"] ?? "show"
);
