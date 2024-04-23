<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

// ini_set('display_errors', 0);

session_start();
if(!isset($_SESSION["novasessio"])){
    header("location: https://zends-tovama/m08uf23/auth.php");
}

if(isset($_POST['method']) && $_POST['method'] == "PUT"){
    $atribut=$_POST['ldap_attribute'];
    $nou_contingut=$_POST['nouContingut'];
    
    $uid = $_POST['uid'];
    $unorg = $_POST['unorg'];
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
    $entrada = $ldap->getEntry($dn);
    if ($entrada){
        Attribute::setAttribute($entrada,$atribut,$nou_contingut);
        $ldap->update($dn, $entrada);
        echo "Atribut modificat";
    } else echo "<b>Aquesta entrada no existeix</b><br><br>";
}

?>
<html>
<head>
<title>modificacio del usuari</title>
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
        input[type="text"], input[type="password"] {
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
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #45a049;
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
    <h2>Modificar dades de usuaris</h2>
    <form action="https://zends-tovama/m08uf23/modificar.php" method="POST">
    	<input type="hidden" name="method" value="PUT">
    	Unitat Organitzativa: <input type="text" name="unorg"><br>
    	Usuari: <input type="text" name="uid"><br>
        Escull el atribut a modificar: <br>
        <input type="radio" name="ldap_attribute" value="uidNumber">ID Usuari 
        <input type="radio" name="ldap_attribute" value="gidnumber">ID Grup 
        <input type="radio" name="ldap_attribute" value="homeDirectory">Directori personal<br>
        <input type="radio" name="ldap_attribute" value="loginShell">Shell 
        <input type="radio" name="ldap_attribute" value="cn">Nom Complert 
        <input type="radio" name="ldap_attribute" value="givenName">Nom <br>
        <input type="radio" name="ldap_attribute" value="sn">Cognom 
        <input type="radio" name="ldap_attribute" value="postalAddress">Direcció 
        <input type="radio" name="ldap_attribute" value="mobile">Mobil <br>
        <input type="radio" name="ldap_attribute" value="telephoneNumber">Telefon 
        <input type="radio" name="ldap_attribute" value="title">Titol 
        <input type="radio" name="ldap_attribute" value="description">Descripció <br><br>
        Nou contingut: <input type="text" name="nouContingut"><br><br>
        <input type="submit"/>
        <input type="reset"/>
    </form>
    <button onclick="location.href='https://zends-tovama/m08uf23/menu.php'">Tornar al menú</button>
</body>
</html>