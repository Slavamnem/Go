<?php
namespace App\Project\backend\controllers;

class PostController{
    public function show($id = 1){
        echo "Post №".$id;
    }
    public function update($id = 1){
        echo "Update post №".$id;
    }
}