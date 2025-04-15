<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validación CAPTCHA
    if ($_POST['captcha'] != 7) {
        header("Location: contacto.html?enviado=false");
        exit;
    }

    // Validaciones
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $correo = filter_var(trim($_POST['correo']), FILTER_VALIDATE_EMAIL);
    $mensaje = htmlspecialchars(trim($_POST['mensaje']));

    if (!$correo) {
        header("Location: contacto.html?enviado=false");
        exit;
    }

    $destinatario = "ichavira@sumatepublicidad.com"; // Reemplaza con tu correo
    $asunto = "Nuevo mensaje desde el formulario web";

    $contenido = "Nombre: $nombre\n";
    $contenido .= "Correo: $correo\n";
    $contenido .= "Mensaje:\n$mensaje\n";

    $headers = "From: $correo\r\n";
    $headers .= "Reply-To: $correo\r\n";

    if (mail($destinatario, $asunto, $contenido, $headers)) {
        header("Location: contacto.html?enviado=true");
        exit;
    } else {
        header("Location: contacto.html?enviado=false");
        exit;
    }
} else {
    header("Location: contacto.html?enviado=false");
    exit;
}
