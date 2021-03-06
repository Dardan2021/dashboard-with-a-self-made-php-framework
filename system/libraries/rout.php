<?php
 class Rout {

     private $controller = defaultController;

     private $method = defaultMethod;

     private $param = defaultParam;

     public function __construct()
     {
         $url = $this->Url();

        if (!empty($url))
        {
            if(isset($url[3]))
            {
                if(file_exists("../application/controller/$url[1]/" .$url[2]. ".php"))
                {
                    $this->controller = ucwords($url[2]);
                    unset($url[2]);
                }
            }
            ELSE if(isset($url[2]))
            {
                if(file_exists("../application/controller/$url[0]/" .$url[1]. ".php"))
                {
                    $this->controller = ucwords($url[1]);
                    unset($url[1]);
                }
            }

            else if (file_exists("../application/controller/" . $url[0] . ".php"))
            {
               $this->controller = ucwords($url[0]);
               unset($url[0]);
            }
            else
            {
                echo "file does not exists";
            }
        }
         if(isset($url[3]))
         {
             require_once "../application/controller/$url[1]/".$this->controller.".php";

             $this->controller = new $this->controller;

             if(isset($url[3]) && !empty($url[3]))
             {
                 if(method_exists($this->controller,$url[3]))
                 {
                     $this->method = $url[3];

                     unset($url[3]);
                 }
                 else
                 {
                     echo "method is not found";
                 }
             }
         }
         else if(isset($url[2]))
         {
             require_once "../application/controller/$url[0]/".$this->controller.".php";

             $this->controller = new $this->controller;

             if(isset($url[2]) && !empty($url[2]))
             {
                 if(method_exists($this->controller,$url[2]))
                 {
                     $this->method = $url[2];

                     unset($url[2]);
                 }
                 else
                 {
                     echo "method is not found";
                 }
             }
         }
         else
         {
             require_once "../application/controller/".$this->controller.".php";

             $this->controller = new $this->controller;

             if (isset($url[1]) && !empty($url[1]))
             {
                if (method_exists($this->controller, $url[1]))
                {
                    $this->method = $url[1];

                    unset($url[1]);
                }
                else
                {
                    echo "method is not found";
                }
             }
         }

         if (isset($url))
         {
            $this->param = $url;
         }
        else
        {
            $this->param = [];
        }

        call_user_func_array([$this->controller,$this->method],$this->param);
     }

     public function Url()
     {
         if (isset($_GET['url']))
         {
             $url = $_GET['url'];
             $url = rtrim($url);
             $url = filter_var($url, FILTER_SANITIZE_URL);
             $url = explode("/",$url);

             return $url;
         }
     }
 }
?>