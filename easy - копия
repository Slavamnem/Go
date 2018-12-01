<?php

$request = $argv;

unset($argv[0]);
$request = implode(" ", $argv);

$bad = ["дурак", "дибил", "тупой"];
foreach($argv as $item){
    if(in_array($item, $bad)){
        echo "Плохие слова я не люблю(";
        return;
    }
}
switch($request){
    case 'привет': echo "Привет друг!"; break;
    case 'пока': echo "Прощай друг!"; break;
    case 'ты как?': echo "Хорошо, сам как?"; break;
    case 'Саша Дяк где живет?': echo "В США!!!!!"; break;
    case 'Ты ИИ?': echo "Ну а кто еще, тупой чтоли?"; break;
    default: echo "Не знаю(";
}
?>