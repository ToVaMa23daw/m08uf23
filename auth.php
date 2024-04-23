<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;

session_start();
// ini_set('display_errors', 0);
if ($_POST['cts'] && $_POST['adm']){
    $opcions = [
        'host' => 'zend-tovama.fjeclot.net',
        'username' => "cn=admin,dc=fjeclot,dc=net",
        'password' => 'clotfje',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opcions);
    $dn='cn='.$_POST['adm'].',dc=fjeclot,dc=net';
    $ctsnya=$_POST['cts'];
    try{
        $ldap->bind($dn,$ctsnya);
        $_SESSION['novasessio'] = true;
        header("location: menu.php");
    } catch (Exception $e){
        echo "<b style='color:red;'>Contrasenya incorrecta</b><br><br>";
    }
}
?>
<html>
	<head>
		<title>
			AUTENTICACIÓ AMB LDAP 
		</title>
		<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        a {
            color: #008CBA;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        form {
            border: 1px solid #ccc;
            padding: 20px;
            width: 300px;
            margin: 0 auto;
        }
        input[type="text"], input[type="password"] {
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
        b.error-message {
            color: red;
            font-weight: bold;
        }
    </style>
	</head>
	<body>
		<a href="https://zends-tovama/m08uf23/login.php">Torna a la pàgina inicial</a>
	</body>
</html>