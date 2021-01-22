<?php
  //llamamos a encriptacion.php
  include 'encriptacion.php';

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
  $usuario = $_POST['username'];
  $contrasenia = $_POST['password'];

  //se encripta el usuario y la contraseña
  $usuarioCodificado = encriptacion::encriptar($usuario);
  $contraseniaCodificada = encriptacion::encriptar($contrasenia);

  //sentencia de sql
  $sql="INSERT INTO user(name, password) VALUES('$usuarioCodificado','$contraseniaCodificada')";

  //ejecutar la sentencia sql
  $ejecutar = mysqli_query($con,$sql);

  //verificar la ejecucion
  if(!$ejecutar){
    mysqli_close($con);
    echo "<script>
            alert('Error al registrarse');
                    window.location='registro.php'
                  </script>";
  }else{
    mysqli_close($con);
    header('Location: index.php');
  }
?>
