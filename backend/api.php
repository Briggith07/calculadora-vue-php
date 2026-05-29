<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

header("Content-Type: application/json");

$operador1 = $_POST["operador1"] ?? null;
$operador2 = $_POST["operador2"] ?? null;
$operacion = $_POST["operacion"] ?? null;

if ($operador1 === null || $operador2 === null || $operacion === null) {
    echo json_encode([
        "ok" => false,
        "error" => "Datos incompletos"
    ]);
    exit;
}

if (!is_numeric($operador1) || !is_numeric($operador2)) {
    echo json_encode([
        "ok" => false,
        "error" => "Valores no numéricos"
    ]);
    exit;
}

switch ($operacion) {

    case "suma":
        $resultado = $operador1 + $operador2;
        break;

    case "resta":
        $resultado = $operador1 - $operador2;
        break;

    case "multiplicacion":
        $resultado = $operador1 * $operador2;
        break;

    case "division":

        if ($operador2 == 0) {
            echo json_encode([
                "ok" => false,
                "error" => "No es posible dividir entre cero"
            ]);
            exit;
        }

        $resultado = $operador1 / $operador2;
        break;

    default:
        echo json_encode([
            "ok" => false,
            "error" => "Operación no válida"
        ]);
        exit;
}

echo json_encode([
    "ok" => true,
    "resultado" => $resultado
]);