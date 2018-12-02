<?php
namespace App\Project\backend\controllers;

class PostController{
    public function show($id = 1){
        echo "Post №".$id."<br>";
        //print_r($_GET);
    }
    public function show2($cat = 1, $id = 1){
        echo "Category: $cat, Post № $id <br>";
    }
    public function update($id = 1){
        echo "Update post №".$id;

        //echo "<br>".substr("test string", 0, -1);
        //echo "<br>".substr("test string", -1);
    }
}