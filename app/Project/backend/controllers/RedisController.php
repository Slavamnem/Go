<?php
namespace App\Project\backend\controllers;

class RedisController
{

    public function __construct()
    {
        dump("REDIS");
    }

    public function lists()
    {
        //phpinfo();
        dump("__________");

        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);

        $redis->set("test-key", 58);
        //$redis->delete("test-key");
        dump($redis->get("test-key"));

        /*$redis->rPush("arr1", 4);
        $redis->rPush("arr1", 14);
        $redis->rPush("arr1", 24);*/
        //$redis->lPush('arr1', 88);

        $redis->lRem('arr1', 14);

        $redis->lSet('arr1', 2, 9999);
        dump($redis->lGet('arr1', 1));

        //dump($redis->lPop('arr1'));
        //$redis->lInsert('arr1', \Redis::BEFORE, 88, 777);
        dump($redis->lGetRange('arr1', 0, $redis->lLen('arr1')));


        //dump($redis->hGetAll('arr1'));

    }

    public function lists_example()
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);

        $userAge = rand(18, 60);
        $redis->rPush('users-ages', $userAge);
        //dump($redis->lGetRange("users-ages", 0, $redis->lLen('users-ages')));

        $avarageAge = array_sum(
            $redis->lGetRange("users-ages", 0, $redis->lLen('users-ages'))
        ) / $redis->lLen('users-ages');

        $avarage = $this->decorAge($avarageAge);
        dump($avarage);
    }

    public function decorAge($age)
    {
        $message = "Average age of users of this page is <<AGE>>";
        $message = str_replace("<<AGE>>", $age, $message);

        return $message;
    }

    /////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////

    public function sets()
    {
        $redis = new \Redis();
        $redis->connect("localhost", 6379);

        $redis->delete("names");
        $redis->delete("words");

        $redis->sAdd("names", "Dima");
        $redis->sAdd("names", "Vlad");
        $redis->sAdd("names", "Jon");

        $redis->sAdd("words", "apple");
        $redis->sAdd("words", "Vlad");
        $redis->sAdd("words", "table");



        $redis->sMove("names", "words", "Jon2");
        dump($redis->sRandMember("names"));
        //dump($redis->sPop("names"));
        //$redis->sRem("names", "Vlad");


        dump("Union: "); dump($redis->sUnion("names", "words"));
        dump("Names: "); dump($redis->sMembers("names"));
        dump("Words: "); dump($redis->sMembers("words"));


        dump($redis->sDiff("names", "words"));
        $redis->sUnionStore("names", "names", "words"); //reset 1-param array
        dump("Names: "); dump($redis->sMembers("names"));
        dump($redis->sInter("names", "words"));

        dump("is member? " . $redis->sIsMember("names", "Jon"));
    }

    public function sortSets()
    {
        dump("Sort Sets");
        $redis = new \Redis();
        $redis->connect("localhost", 6379);

        $redis->zAdd('cities', '3000000', 'Kiev', '1400000', 'Kharkov');
        $redis->zAdd('cities', '1000000', 'Odessa', '950000', 'Dnepr');
        $redis->zAdd('cities', '750000', 'Lviv', '500000', 'Mariupol');
        $redis->zAdd('cities', '250000', 'Vinica', '150000', 'Rivne');


        $redis->zIncrBy('cities', 10, 'Kiev');

        $redis->zRem('cities', 'Rivne');
        $redis->zRemRangeByScore('cities', 100000, 300000);

        dump($redis->zCard('cities'));
        dump($redis->zRange('cities', 'Odessa', 'Lviv'));
        dump($redis->zRange('cities', 'Lviv', 'Odessa'));
        dump($redis->zRangeByScore('cities', 100000, 1200000));
        dump($redis->zCount('cities', 2, 4));

        dump($redis->zScore('cities', 'Kiev'));
        dump($redis->zRangeByScore('cities', 100000, 4000000));
        dump($redis->zRevRangeByScore('cities', 10000000, 100000));
    }

    public function alists()
    {
        $redis = new \Redis();
        $redis->connect("localhost", 6379);

        $redis->hmset('post:1', [
           'title' => 'Football',
           'views' => 10
        ]);
        $redis->hmset('post:2', [
            'title' => 'Tennis',
            'views' => 17
        ]);
        $redis->hIncrBy('post:1', 'views', 1);

        $redis->hDel('post:2', 'views');

        $post = $redis->hGetAll('post:1');
        dump($redis->hGet('post:1', 'title'));
        dump($redis->hSet('post:1', 'views', 15));
        dump($redis->hKeys('post:1'));
        dump($redis->hVals('post:1'));
        dump($redis->hMGet('post:1', ['title', 'views']));

        dump($redis->hExists('post:1', 'title'));
        dump($redis->hLen('post:1'));
    }

    public function transactions()
    {
        $redis = new \Redis();
        $redis->connect("localhost", 6379);

        $redis->multi();

        $redis->set('test1', 1);
        $redis->set('test2', 2);
        $redis->set('test3', 3);

        if (false) {
            $redis->discard();
        } else {
            $redis->exec();
        }
    }

    public function admin()
    {
        $redis = new \Redis();
        $redis->connect("localhost", 6379);

        dump("__________");
        dump($redis->dbSize());
        dump(date("Y-m-d H:i:s", $redis->lastSave()));
        //dump($redis->config('get', 'role'));
        dump($redis->info());
    }

    public function extra()
    {
        $redis = new \Redis();
        $redis->connect("localhost", 6379);

        //$redis->set('val1', 1);
        $redis->incr('val1');
        $redis->incrBy('val1', 4);
        dump($redis->get('val1'));
        dump($redis->exists('val1'));

        $redis->hMSet('users:admins:1', [
           'name' => 'Slava',
           'age' => 22
        ]);
        //dump($redis->hGetAll('post'));
        //dump($redis->get('post'));
    }
}