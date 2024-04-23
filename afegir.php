<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

session_start();
if(!isset($_SESSION["novasessio"])){
    header("location: https://zends-tovama/m08uf23/login.php");
}

// ini_set('display_errors', 0);

if(isset($_POST['afegir'])){
    $uid=$_POST['uid'];
    $unorg=$_POST['unorg'];
    $num_id=$_POST['num_id'];
    $grup=$_POST['grup'];
    $dir_pers=$_POST['dir_pers'];
    $sh=$_POST['sh'];
    $cn=$_POST['cn'];
    $sn=$_POST['sn'];
    $nom=$_POST['nom'];
    $mobil=$_POST['mobil'];
    $adressa=$_POST['adressa'];
    $telefon=$_POST['telefon'];
    $titol=$_POST['titol'];
    $descripcio=$_POST['descripcio'];
    $objcl=array('inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top');
    
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
    $nova_entrada = [];
    Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
    Attribute::setAttribute($nova_entrada, 'uid', $uid);
    Attribute::setAttribute($nova_entrada, 'uidNumber', $num_id);
    Attribute::setAttribute($nova_entrada, 'gidNumber', $grup);
    Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir_pers);
    Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
    Attribute::setAttribute($nova_entrada, 'cn', $cn);
    Attribute::setAttribute($nova_entrada, 'sn', $sn);
    Attribute::setAttribute($nova_entrada, 'givenName', $nom);
    Attribute::setAttribute($nova_entrada, 'mobile', $mobil);
    Attribute::setAttribute($nova_entrada, 'postalAddress', $adressa);
    Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telefon);
    Attribute::setAttribute($nova_entrada, 'title', $titol);
    Attribute::setAttribute($nova_entrada, 'description', $descripcio);
    $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
    if($ldap->add($dn, $nova_entrada)) echo "Usuari creat";
}

?>
<html>
<head>
    <title>AFEGEIX UN NOU USUARI A LA BASE DE DADES LDAP</title>
 <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            border: 1px solid #ccc;
            padding: 20px;
            width: 400px;
        }
        input[type="text"], input[type="number"] {
            width: calc(100% - 10px);
            padding: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            border: none;
        }
        input[type="reset"] {
            background-color: #FF0000;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
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
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            border: none;
        }
    </style>
</head>
<body>
    <h2>Formulari de selecció d'usuari</h2>
    <form action="/m08uf23/afegir.php" method="POST">
   		<input type="hidden" name="afegir" value="true">
    	Usuari: <input type="text" name="uid"><br>
        Unitat Organitzativa: <input type="text" name="unorg"><br>
        ID Usuari: <input type="number" name="num_id"><br>
        ID Grup: <input type="number" name="grup"><br>
        Directori personal: <input type="text" name="dir_pers"><br>
        Shell: <input type="text" name="sh"><br>
        Nom Complert: <input type="text" name="cn"><br>
        Nom: <input type="text" name="nom"><br>
        Cognom: <input type="text" name="sn"><br>
        Direcció: <input type="text" name="adressa"><br>
        Mobil: <input type="text" name="mobil"><br>
        Telefon: <input type="text" name="telefon"><br>
        Titol: <input type="text" name="titol"><br>
        Descripció: <input type="text" name="descripcio"><br>
        <input type="submit"/>
        <input type="reset"/>
    </form>
    <button onclick="location.href='https://zends-tovama/m08uf23/menu.php'">Tornar al menú</button>
    </body>
</html>