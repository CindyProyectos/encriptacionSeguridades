<?php
  //llamamos a encriptacion.php
  include 'encriptacion.php';
  include 'Crypt/RSA.php';

  $rsa = new Crypt_RSA();
  extract ($rsa->createKey());


  session_start();

  //conectamos con el servidor
  $user="root";
  $pass="";
  $server="localhost";
  $db="chat1";
  $con=mysqli_connect($server,$user,$pass,$db);

  //validar conexion
  /*if(!$con){
    echo "<h3>No se ha podido conectar PHP - MySQL, verifique sus datos.</h3><hr><br>";
  }else
  {
    echo "<h3>Conexion Exitosa PHP - MySQL</h3><hr><br>";
  }*/

  //recuperar las variables
  $usuarioReceptor = $_POST['usuarios'];
  $mensaje = $_POST['mensaje'];
  $value = $_SESSION['idUsuario'];
  $nombreUsuario = $_SESSION['nombreUsuario'];
  $texto=$mensaje;
  $rsa->loadKey($privatekey);
  $textoencriptado = $rsa -> encrypt($texto);

  //desencriptacion
  $rsa->loadKey($publickey);
  $textodesencriptado=$rsa->decrypt($textoencriptado);


/*  $rsa->loadKey($privatekey);

  $mensajeEncriptado=$rsa->encrypt($mensaje);*/

  //encriptar mensajew


  //sentencia de sql
  $sql="INSERT INTO message(text_msg, fk_user, emisor, receptor, msg_desencriptada) VALUES('$textoencriptado','$value','$value', '$usuarioReceptor','$textodesencriptado')";

  //ejecutar la sentencia sql
  $ejecutar = mysqli_query($con,$sql);

  //verificar la ejecucion
  if(!$ejecutar){
    mysqli_close($con);
   echo "<script>
            alert('Error');
                    window.location='index.php'
                  </script>";
  }else{
    mysqli_close($con);
  header("Location: ../encriptacionSeguridades/inicio.php?id_user=$value&nom_user=$nombreUsuario");
  }
?>
