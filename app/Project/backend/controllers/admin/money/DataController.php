<?php
namespace App\Project\backend\controllers\admin\money;

class DataController{
    const SUCCESS = 1;
    const ERROR = 2;
    public function index($message){
        echo "Data Controller welcome!!!<br>";
        echo $message;
    }
    public function check($name) {
        return method_exists(__CLASS__, $name)? true : false;
    }
    public function checkExecute(...$arguments){
        try{
            ob_start();
            print_r($arguments);
            call_user_func_array([__CLASS__, $arguments[0]], array_slice($arguments, 1));
            ob_get_clean();
            return self::SUCCESS;
        } catch(Error $e){
            echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
            return self::ERROR;
        }
    }
}