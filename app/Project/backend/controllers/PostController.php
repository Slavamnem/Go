<?php
namespace App\Project\backend\controllers;

use App\Kernel\Classes\Controller;
use App\Kernel\Classes\Facades\File;
use App\Kernel\Classes\Facades\Db;
use App\Kernel\Classes\Facades\Realizators\Database;
use App\Kernel\Classes\FileService;

class PostController extends Controller{

    public function index3(){
        //Db::makeCopy();
        dump("site works");

        //Db::restore("2019-02-23-17-58-25");
        Db::restore(1);
    }

    public function index2()
    {
//        dump(Db::selectFromTable("_posts", [
//            "_users" => ["author", "id"]
//        ]));

        //dump(Db::selectFromTable("_posts"));
        Db::insertInTable("_posts", [
            ['title' => 7, 'text' => 7],
            ['title' => 777, 'text' => 777],
        ]);

        //dump(Db::getTableSize("_posts"));

        //$db = new Database();
        //dump($db->getTableSize("_posts"));

        //dump(Db::selectForPage("_posts", 5, 3));

        //dump(Db::getTableColumns("_posts"));

        //dump(DB::selectFromTable("_posts3"));
        //Db::truncate("_posts3", 3);
        dump(DB::selectFromTable("_posts3"));

        //dump(debug_backtrace());
    }



    public function index(){
        dump("index");

        File::save("all.txt", "some 12345");
        //echo FileService::get("all.txt");

        //Db::makeCopy();
        //Db::restore(date("Y-m-d"));
        Db::restore("2019-01-08-02-29-04");

        File::log("important information");
        //FileService::log(json_encode(['a', 11, 'слово', 'y' => 'бла бла']), "json_ru");
    }
    public function show($id = 1){
        echo "Post №".$id."<br>";

        $items = ['a', 'b', 'c', 'd'];
        $this->render("test", compact('items'), "layout");
        //$this->redirect("/ru/post/show2", ['cat' => 10, 'id' => 44]);

    }
    public function show2($cat = 1, $id = 1){
        dump(Db::select("SELECT * FROM _posts", [], false));
        dump(Db::getValue("SELECT COUNT(id) FROM _posts"));

        //Db::insert("INSERT INTO _posts (title, text, author) VALUES('tt', 'text', 1)");
        dump(Db::getTables());

        Db::insertInTable("_posts", [
            ['title' => 3, 'text' => 4],
            ['title' => 33, 'text' => 44],
            ['title' => 333, 'text' => 444],
        ]);

        Db::insertInTable("_posts",
            ['title' => 777777, 'text' => 77777]
        );
        /*dump("-");
        dump("-");
        $file = new FileService("first.txt", "r+");
        $file->show();
        $file->replace("!", "?");
        $file->add("!");
        dump($file->getName());

        $file->getFrequency();
//        dump(filesize($file->getPath()));
        //$file->clean();
        */

        File::log("important information");
        echo "Category: $cat, Post № $id <br>";
    }
    public function update($id = 1){
        echo "Update post № ".$id;
    }
    public function get($message = null){
        echo "yes it is get, message: $message";
    }

    //метод будет у главного контоллера, эти наследуют
    public function check($name) {
        return method_exists(__CLASS__, $name)? true : false;
    }
}