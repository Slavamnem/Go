<?php
require __DIR__ . "/vendor/autoload.php";
use App\Kernel\App;

App::start();

//dump($_REQUEST);
?>

<div class="progress">
    <div id="dynamic" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="margin-top:450px; width: 100%; height:20px; background-color: #060a61;">
        <span id="current-progress"></span>
    </div>
</div>
<!--<script src="jquery-2.2.4.min.js"></script>-->
<script type="text/javascript">
        /*$(function() {
            var current_progress = 50;
            var top = 450;
            var interval = setInterval(function() {
                //alert("!");
                current_progress += 0.4;
                top -= 0.4;
                $("#dynamic")
                    .css("height", current_progress + "px")
                    .css("margin-top", top + "px")
                    .attr("aria-valuenow", current_progress)
                    //.text(current_progress + "%");
                if (top < 0)
                    clearInterval(interval);
            }, 20);

            var current_progress = 0;
            var interval = setInterval(function() {
                //alert("!");
                current_progress += 10;
                $("#dynamic")
                    .css("width", current_progress + "%")
                    .attr("aria-valuenow", current_progress)
                    .text(current_progress + "%");
                if (current_progress >= 100)
                    clearInterval(interval);
            }, 1000);
        });*/
</script>

<?php
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