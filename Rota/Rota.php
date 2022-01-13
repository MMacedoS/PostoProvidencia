<?php


class Rota {


    public function __construct(){
        $this->run();
    }

    public function run()
    {
        // echo $_GET['pagina'];
        // die;
        if(!isset($_GET['pagina']))
        {
            $controller="HomeController";
            $metodo="index";            
            $parametros=[];
        }else
        {
            $url=$_GET['pagina'];

            $url= explode('/',$url);
            $controller = $url[0]."Controller";

            array_shift($url);

            if(isset($url[0]) && !empty($url))
            {
                $metodo=$url[0];
                $parametros=[];
                array_shift($url);

                if(count($url)>0)
                {
                    $parametros=$url;
                }
            }else
            {
                $metodo="index";
                $parametros=[];
            }

        
        }

        $caminho="providencia/Controller/".$controller.".php";

        if(!file_exists($caminho) && !method_exists($controller,$metodo))
        {
            $controller="Error404Controller";
            $metodo="index";
            $parametros=[];
        }

        $control=new $controller;

       call_user_func_array(array($control,$metodo),$parametros);

    }
}


?>