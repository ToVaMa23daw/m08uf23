<?php
session_start();
if(isset($_SESSION["novasessio"])){
    echo "<b style='color:green;'>Has iniciat sessió correctament</b><br><br>";
}else{
    header("location: https://zends-tovama/m08uf23/auth.php");
}
?>

<html>
	<head>
		<title>
			PÀGINA WEB DEL MENÚ PRINCIPAL DE L'APLICACIÓ D'ACCÉS A BASES DE DADES LDAP
		</title>
		<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }
        h2 {
            color: #008CBA;
        }
        h3 {
            color: #4CAF50;
            margin-bottom: 10px;
        }
        a {
            color: #008CBA;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
	</head>
	<body>
		<h2> MENÚ PRINCIPAL DE L'APLICACIÓ D'ACCÉS A BASES DE DADES LDAP</h2>
		<h3><a href="/m08uf23/visualitzar.php">Visualitzar un usuari</a></h3>
		<h3><a href="/m08uf23/afegir.php">Afegir un usuari</a></h3>
		<h3><a href="/m08uf23/borrar.php">Esborrar un usuari</a></h3>
		<h3><a href="/m08uf23/modificar.php">Modificar un usuari</a></h3>
		<a href="/m08uf23/index.php">Tanca la sessió</a>
	</body>
</html>