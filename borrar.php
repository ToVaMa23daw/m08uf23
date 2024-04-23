<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

session_start();
if(!isset($_SESSION["novasessio"])){
    header("location: https://zends-tovama/m08uf23/login.php");
}

// ini_set('display_errors', 0);

if(isset($_POST['method']) && $_POST['method']=="DELETE"){
    $uid = $_POST['usr'];
    $unorg = $_POST['ou'];
    
    $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
    
    $opcions = [
        'host' => 'zend-tovama.fjeclot.net',
        'username' => 'cn=admin,dc=fjeclot,dc=net',
        'password' => 'clotfje',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    
    $ldap = new Ldap($opcions);
    $ldap->bind();
    try{
        $ldap->delete($dn);
        echo "<b>Entrada esborrada</b><br>";
    } catch (Exception $e){
        echo "<b>Aquesta entrada no existeix</b><br>";
    }
}
?>

<html>
<head>
<title>Borarr usuari</title>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h3 {
            color: #008CBA;
        }
        form {
            border: 1px solid #ccc;
            padding: 20px;
            width: 300px;
            margin: 0 auto;
        }
        input[type="text"] {
            width: calc(100% - 10px);
            padding: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"], input[type="reset"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 4px;
            border: none;
        }
        button {
            background-color: #008CBA;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            border: none;
        }
        button:hover {
            background-color: #005f78;
        }
    </style>
</head>
	<body>
		<h3>ESBORRAR UN USUARI DE LA BASE DE DADES LDAP</h3>
		<form action="https://zends-tovama/m08uf23/borrar.php" method="POST">
    		<input type="hidden" name="method" value="DELETE">
            Unitat organitzativa: <input type="text" name="ou"><br>
            Usuari: <input type="text" name="usr"><br>
            <input type="submit"/>
            <input type="reset"/>
    	</form>
    	<button onclick="location.href='https://zends-tovama/m08uf23/menu.php'">Tornar al menú</button>
	</body>
</html>