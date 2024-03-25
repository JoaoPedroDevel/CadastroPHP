<?php 

$host = "localhost";
$dbname = "form";
$user = "postgres";
$pass = "root";

$dbconn = pg_connect("host=$host dbname=$dbname user=$user password=$pass");

/*if ($dbconn) {
    echo "Conexão bem-sucedida!";
} else {
    echo "Falha na conexão!";
}
*/
?>
