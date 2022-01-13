<?php

require_once "Functions/autoload.php";
define('ROTA_GERAL',"http://$_SERVER[HTTP_HOST]".'/providencia');
define('ROTA_CSS',"http://$_SERVER[HTTP_HOST]".'/providencia/View/css');
define('ROTA_JS',"http://$_SERVER[HTTP_HOST]".'/providencia/View/js');
define('ROTA_TABLE',"http://$_SERVER[HTTP_HOST]".'/providencia/View/DataTables');
define('PATH_TOPO',__DIR__."/View/pages/topo/");

$rota=new Rota();

?>