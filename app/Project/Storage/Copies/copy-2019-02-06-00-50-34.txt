<?php

namespace App\Project\Storage\Copies;

class DatabaseCopy
{
    public $createTablesSqls = array (
  0 => 'CREATE TABLE _likes (
id int(11) auto_increment,
maker_id int(11),
receiver_id int(11),
PRIMARY KEY (id),
FOREIGN KEY (maker_id) REFERENCES _users(id),
FOREIGN KEY (receiver_id) REFERENCES _users(id)
)',
  1 => 'CREATE TABLE _posts (
id int(11) auto_increment,
title varchar(255),
text text,
author int(11),
PRIMARY KEY (id),
FOREIGN KEY (author) REFERENCES _users(id)
)',
  2 => 'CREATE TABLE _posts3 (
id int(11) auto_increment,
title varchar(255),
text text,
author int(11),
PRIMARY KEY (id),
FOREIGN KEY (author) REFERENCES _users(id)
)',
  3 => 'CREATE TABLE _users (
id int(11) auto_increment,
login varchar(255),
password varchar(255),
full_name varchar(255),
date_add date,
PRIMARY KEY (id)
)',
  4 => 'CREATE TABLE requests (
id int(11) auto_increment,
request text,
created_at datetime,
PRIMARY KEY (id)
)',
);
    public $insertDataSqls;

    public function restore()
    {
        $allQueries = $this->createTablesSqls + $this->insertDataSqls;
        foreach ($allQueries as $query) {
            dump($query);
            //$stmp = PdoHelper::getPdo()->prepare($query);
            //$stmp->execute();
        }
    }

}