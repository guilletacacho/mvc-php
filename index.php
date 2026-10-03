<?php
session_start();
require_once("Configuration.php");

$configuration = new Configuration();
$router = $configuration->getRouter();

$router->dispatch(
    $_GET["controller"] ?? "evento",
    $_GET["method"] ?? "show"
);