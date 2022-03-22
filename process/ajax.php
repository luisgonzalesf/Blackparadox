<?php
if(!isset($_POST)){
    die('No autorizado');
};

function json_output($status = 200, $msg = 'OK', $data = []){
    echo json_encode(['status'=>$status, 'msg'=>$msg, 'data'=>$data]);
    die();
}

if(empty($_POST['nombre']) || (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) || empty($_POST['mensaje']) || strlen($_POST['mensaje'])<5 ){
    //header("Location: ../contacto.html?llena-todos-los-campos");
    //exit();
    json_output(400, 'Ingresa datos válidos');
}

$info['nombre'] = $_POST['nombre'];
$info['email'] = $_POST['email'];
if(empty($_POST['phone'])){
    $info['phone'] = "Teléfono vacío";
}else{
    $info['phone'] = $_POST['phone'];
};

$info['mensaje'] = $_POST['mensaje'];
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['fecha'] = date('d M Y H:i:s');

$mensaje = "
    <html>
    <body>
    <h3>Tu mensaje ha sido enviado</h3>
    <p><strong>Nombre:</strong> {$info['nombre']} </p>
    <p><strong>Email:</strong> {$info['email']} </p>
    <p><strong>Teléfono:</strong> {$info['phone']} </p>
    <p><strong>Mensaje:</strong> {$info['mensaje']} </p>
    <br>
    <p><strong>IP: </strong>{$info['ip']}</p>
    <p><strong>Fecha: </strong>{$info['fecha']}</p>
    </body>
    </html>
            
";

$para = "luis.gonzales@futurozero.com";
$de = $info['email'];
$asunto = "Primer correo desde PHP";
$headers = "From: $de\r\n";
$headers .= "MIME-Version: 1.0 \r\n";
$headers .= "Content-type: text/html; charset=utf-8 \r\n";

$enviar = mail($para, $asunto, $mensaje, $headers);
if(!$enviar){
    json_output(400, 'Hubo un error al enviar el mensaje');
}

json_output(200, 'Mensaje enviado con éxito, $mensaje');