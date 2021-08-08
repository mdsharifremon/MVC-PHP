
<?php 

// Core App Class
class Core{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = []; 

    public function __construct(){
       $url = $this->getUrl();

       /**
        *  look in controllers for the first value and 
        *  ucwords will make the first latter capital 
        */
       if (isset($url[1])) {
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            // Set a new controller
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
        }
       }

       /* Require new controller */
       require_once '../app/controllers/' . $this->currentController . '.php';
       $this->currentController = new $this->currentController;

       // Get the second value from url
       if(isset($url[1])){ 
           if(method_exists($this->currentController, $url[1] )){ 
                $this->currentMethod = $url[1];
                unset($url[1]); 
           }
       }

       // Get Parameters
       $this->params = $url ? array_values($url) :  [] ;

       // Call a callback with array of params
       call_user_func_array([$this->currentController,$this->currentMethod], $this->params);

    }

    public function getUrl(){
        if(isset($_GET['url'])){
            // Remove forward slash from url
            $url = rtrim($_GET['url'] . '/');

            /// Allow you to filter variables
            $url = filter_var($url,FILTER_SANITIZE_URL);

            // Breaking it into an array
            $url = explode('/', $url);
            return $url;
        }
    }

}