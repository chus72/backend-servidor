<?php
include('funciones/funciones.php');
include "AuxDB.php";
include "clUsuario.php";
?>

<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
    <title>Formulario de registro personal en iBarco</title>
</head>
<body>
<div>
    <form method="POST" action="validarUsuario.php">
        <fieldset>
            <legend>Ingresar datos de Usuario</legend>   
        	   <div>
        		<label for="usuario">Usuario:</label>
        		<input type='text' name='Usuario'/>
        	   </div>
            </br>
        	   <div>
        		  <label for="Password">Password:</label>
        		  <input type='password' name='Password'/>
                  <label for="Password2">Repite el Password:</label>
                  <input type="password" name="Password2" />
        	   </div>
            </br>
                <div>
                    <label for="email">Email: </label>
                    <input type="text" name="email"/>
                    <label for="email2">Repite el E-Mail: </label>
                    <input type="text" name="email2"/>
                </div>
            </br>
                <div>
                    <label for="condiciones">Acepta las condiciones </label>
                    <input type="checkbox" name="condiciones"/>
                <div>
            </br>
        	   <input type="submit" class="btn" value="Entrar" name="enviar"/>
        </fieldset>
    </form>
</div>
</body>
</html>