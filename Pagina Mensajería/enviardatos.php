<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

</head> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contacto exitoso</title>
    <link rel="stylesheet" href="css/estilosB.css?v=<?php echo time(); ?>" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/553027483b.js" crossorigin="anonymous"></script>
</head>
<!-- Header -->
<header>
    <div class="container-fluid row header bg-dark m0">
        <h1 class="col-10 lead"><strong>MotoDinamic</strong></h1>
        <div class="col-2 redes align-bottom">
            <a href="https://api.whatsapp.com/send/?phone=541131538093&text&app_absent=0"><i class="fab fa-whatsapp"></i></a>
            <a href="https://www.instagram.com/motodinamic/"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</header>

<body>
    <div class="container-fluid bg-dark h-100 stretch">
        <div class="container contenedorcontacto h-100">
            <h2 class="text-light">Datos recibidos:</h2>
            <br>
            <div class="text-center">
                <?php
                // Enviar la info por email

                //1) Definir los datos a enviar -> armar el array POST

                $nombre = $_POST['nombre'];
                $email = $_POST['email'];
                $telefono = $_POST['telefono'];

                echo "<h3>Nombre o empresa: <strong>" . $nombre . "</strong></h3><br><br>";
                echo "<h3>E-Mail: <strong>" . $email . "</strong></h3><br> <br> ";
                echo "<h3>Número telefónico: <strong>" . $telefono . "</strong></h3> <br><br>";

                //2) Cargar los datos del envio -> destino, asunto, mensaje 
                $destinatario = "pierca18@gmail.com;cliente@mail.com";
                $asunto = "Nuevo mensaje de mensajería MotoDinamic";
                $cuerpoMensaje = "Nombre: " . $nombre . "<br> Email: " . $email . "<br> telefono: " . $telefono;

                //echo $cuerpoMensaje

                //Bonustrack: headers +  formato HTML
                // Para enviar un correo HTML, debe establecerse la cabecera Content-type
                $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                // Cabeceras adicionales
                $cabeceras .= 'To:' . $destinatario;
                $cabeceras .= 'From: ' . $nombre . '<' . $email . '>' . "\r\n";



                // 3) envio de datos
                @$envio1 = mail($destinatario, $asunto, $cuerpoMensaje, $cabeceras);

                // 4) Evaluacion del envio
                if ($envio1 === false) {
                    //  echo "<span class='alert alert-success'>Gracias ".$nombre." por escribirnos. Nos comunicaremos a la brevedad</span>";
                } else {
                    echo "<span class='alert alert-danger'>Error en el envío.  Escribanos a " . $destinatario . "</span>";
                }


                //Enviar todo esto a MySQL
                // Agregado fecha de envio -> DATE (0000-00-00)
                $fechaContacto = date("Y-m-d");

                //1) Conexion -> mysqli_connect('servidorMySQL','UserMySQL','Password_User_MySQL','nombreBD')

                $conexion = mysqli_connect('sql305.epizy.com', 'epiz_29129051', 'znEqyYbtIvvUR', 'epiz_29129051_mensajeria') or exit("Error en la conexion."); //tambien podemos usar die()

                //  //2) mysqli_query(conexion, consultaMySQL)

                // Consulta 1 -> nuevo Contacto
                $consulta_alta = "INSERT INTO contactos VALUES(0,'$nombre','$email','$telefono','$fechaContacto')";
                $consulta = mysqli_query($conexion, $consulta_alta) or exit(":(");

                if ($consulta == 1) {
                    echo "<h1 class='titulocontacto'> Su informacion fue enviada con exito</h1> <br> <br>
                    <p class='pcontacto'> Nos comunicaremos en la brevedad</p>";
                }
                //3) mysqli_close()
                $cerrarConexion = mysqli_close($conexion);
                // } else{
                //     echo "<span class='alert alert-danger'>Error en el envío.  Escribanos a ".$destinatario."</span>";
                // }  

                ?>

            </div>
            <br> <br>
        </div>
    </div>
</body>
<footer class="container-fluid bg-dark">
    <div class="container-fluid row header">
        <h2 class="col-10">
            <p class="lead">© Mensajería <strong>MotoDinamic</strong> 2021</p>
            </h1>
            <div class="col-2 redes">
                <a href="https://api.whatsapp.com/send/?phone=541131538093&text&app_absent=0"><i class="fab fa-whatsapp"></i></a>
                <a href="https://www.instagram.com/motodinamic/"><i class="fab fa-instagram"></i></a>
            </div>
    </div>
</footer>
<link rel="stylesheet" href="css/estilosB.css" />

</html>