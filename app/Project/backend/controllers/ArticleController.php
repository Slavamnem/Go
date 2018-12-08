<?php
namespace App\Project\backend\controllers;

use App\Kernel\Classes\Controller;

class ArticleController extends Controller {
    public function index($message = "default"){
        echo "Article Controller welcome!!!<br>";
        echo $message;
    }
}