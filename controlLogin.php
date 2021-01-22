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

  //recorrer los datos de la tabla user para ver si coinciden o no
  $bandera=False;
  $busqueda = mysqli_query($con, "SELECT * FROM user");
  while ($fila = mysqli_fetch_array($busqueda)){
    if ($fila !=NULL) {
      $usuarioDesencriptado = encriptacion::desencriptar($fila['name']);
      $passDesencriptado = encriptacion::desencriptar($fila['password']);
      if($usuarioDesencriptado == $usuario){
        if($passDesencriptado == $contrasenia){
          $bandera=True;
          $idusuario=$fila['id'];
        }
      }
  }
  }

  if($bandera==True){
    mysqli_close($con);
    header("Location: ../encriptacionSeguridades/inicio.php?id_user=$idusuario&nom_user=$usuario");
  }else{
    mysqli_close($con);
    echo "<script>
            alert('Debe registrarse para acceder a messageBox');
                    window.location='index.php'
                  </script>";
  }
?>
