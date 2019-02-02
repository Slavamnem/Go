<?php
require __DIR__ . "/vendor/autoload.php";
use App\Kernel\App;

App::start();


// TODO скл который я решилл оставить здесь ))
/*
INSERT INTO users VALUES ('34', 'ggg', '1234', 'sllala', '2018-12-12');

SELECT * FROM users;

CREATE TABLE likes (
  id int,
  maker_id int,
  receiver_id int,
  PRIMARY KEY (id),
  FOREIGN KEY (maker_id) REFERENCES users(id),
  FOREIGN KEY (receiver_id) REFERENCES users(id)
);

CREATE TABLE posts (
  id int,
  title varchar(255),
  text text,
  author int,
  PRIMARY KEY (id),
  FOREIGN KEY (author) REFERENCES users(id)
);


INSERT INTO posts VALUES (1, 'box', 'loma wins again!', 1),
                         (2, 'boxing', 'usuk win!', 1),
                         (3, 'footbal', 'dinamo plays again', 2),
                         (4, 'dance', 'ama dancer ama ma dancer!', 2),
                         (5, 'nature', 'birds fly!!', 3)


SELECT u.login, p.title FROM users as u
    INNER JOIN posts as p
    ON u.id = p.author;

SELECT p.title, u.login FROM posts as p
    INNER JOIN users as u
    ON u.id = p.author;

SELECT u.login, p.title, p.text FROM users as u
    LEFT JOIN posts as p
    ON u.id = p.author;

SELECT u.login, p.title FROM users as u
    RIGHT JOIN posts as p
    ON u.id = p.author;

SELECT u.login, p.title FROM users as u
    LEFT JOIN posts as p
    ON u.id = p.author
    WHERE p.author IS NOT NULL;


SELECT u.login, p.title, p.text FROM users as u
     CROSS JOIN posts as p;
 */