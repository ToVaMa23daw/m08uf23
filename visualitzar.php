<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;

session_start();
if(!isset($_SESSION["novasessio"])){
    header("location: https://zends-tovama/m08uf23/login.php");
}
// Sini_set('display_errors',0);
if ($_GET['usr'] && $_GET['ou']){
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-tovama.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'clotfje',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $entrada='uid='.$_GET['usr'].',ou='.$_GET['ou'].',dc=fjeclot,dc=net';
    $usuari=$ldap->getEntry($entrada);
    echo "<b><u>".$usuari["dn"]."</b></u><br>";
    foreach ($usuari as $atribut => $dada) {
        if ($atribut != "dn") echo $atribut.": ".$dada[0].'<br>';
    }
}
?>
<html>
<head>
    <title>MOSTRANT DADES D'USUARIS DE LA BASE DE DADES LDAP</title>
    <style>

body {
    font-family: Arial, sans-serif;
    margin: 20px;
    text-align: center;
}

h2 {
    color: #008CBA;
}

form {
    border: 1px solid #ccc;
    padding: 20px;
    width: 400px;
    margin: 0 auto;
}

input[type="text"], input[type="submit"], input[type="reset"] {
    width: calc(100% - 10px);
    padding: 5px;
    margin-bottom: 10px;
}

input[type="submit"], input[type="reset"], button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    border-radius: 4px;
    border: none;
    margin-top: 10px;
}

input[type="submit"]:hover, input[type="reset"]:hover, button:hover {
    background-color: #45a049;
}

button {
    background-color: #008CBA;
}
</style>
</head>
<body>
    <h2>Formulari de selecció d'usuari</h2>
    <form action="https://zends-tovama/m08uf23/visualitzar.php" method="GET">
        Unitat organitzativa: <input type="text" name="ou"><br>
        Usuari: <input type="text" name="usr"><br>
        <input type="submit"/>
        <input type="reset"/>
    </form>
    <button onclick="location.href='https://zends-tovama/m08uf23/menu.php'">Tornar al menú</button>
</body>
</html>