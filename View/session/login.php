<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <center>
  <style>
    body {
      background-image: radial-gradient(circle at 50% -20.71%, #a6ffa7 0, #90ffab 12.5%, #76ffb0 25%, #54ffb5 37.5%,
      #08ffbb 50%, #00fbc2 62.5%, #00f8ca 75%, #00f4d3 87.5%, #00f1dc 100%);
      display: flex;
      justify-content: center;
      align-item: center;
      height: 100vh;
      flex-direction: column;
      
    }
    {
      font-family: 'Lato', sans-serif;
      font-family: 'Open Sans', sans-serif;
      font-family: 'PT Sans', sans-serif;
      box-sizing: border-box;

    }
    form{
      width: 600px;
      border: 2px solid black;
      padding: 6rem;
      background-color: black;
      border: none;
      border-radius: 20px;
      color: aliceblue;
    }
    h1{
      display: block;
      border: 2px solid black; 
      width: 95%;
      padding: 10px;
      margin: 10px;
      border-radius: 10px;
    }
    label{
      color: aliceblue;
      font-size: 18px;
      padding: 11px;
      font-weight: 350;
    }
    input{
      display: block;
      border: 2px solid black;
      width: 95%;
      padding: 10px;
      margin: 10px;
      border-radius: 10px;
    }
    button{
      float: right;
      background-color: #00f1dc;
      padding: 1rem;
      color: white;
      border: none;
      width: 50%;
      border-radius: 6%;
      margin-right: 10px;
      text-decoration: none;
    }
    button hover{
      background-color: white;
      color: black;
    }
   
  </style>
  <title>Inicio de Sesion</title>
</head>
<body>
  <form action= "IniciarSesion.php" method="POST">
    <h1>INICIAR SESION</h1>
    <hr>
  <i class= "fa-solid fa-user"></i>
    <label>Usuario</label>
    <input type="text" name="Usuario" placeholder="Nombre de Usuario">
    <i class= "fa-solid fa-unlock"></i>
    <label>Clave</label>
    <input type="text" name="Clave" placeholder="Clave">
    <hr>
    <button type="submit">Iniciar Sesion</button>
    <a href="CrearCuenta.php">Crear Cuenta</a>
  </form>
  </center>
</body>
</html>