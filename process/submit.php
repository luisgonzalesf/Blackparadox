<?php

if(isset($_POST['submit'])){
    if(empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['mensaje'])){
        header("Location: ../contacto.html?llena-todos-los-campos");
        exit();
    }else{
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

        $para = "luisgonzalesfarronan@gmail.com";
        $de = $para;
        $asunto = "Primer correo desde PHP";
        $headers = "From: $de\r\n";
        $headers .= "MIME-Version: 1.0 \r\n";
        $headers .= "Content-type: text/html; charset=utf-8 \r\n";

        $enviar = mail($para, $asunto, $mensaje, $headers);
        if($enviar){
            header("Location: ../contacto.html?success");
            exit();
        }else{
            header("Location: ../contacto.html?error");
            exit();
        }
    };
    
}else{
    
    header("Location: ../contacto.html?error");
};




?>
<br>
<a href="../contacto.html">Volver</a>