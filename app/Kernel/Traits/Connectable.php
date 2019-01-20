<?php
namespace App\Kernel\Traits;

trait Connectable
{
    function getMessage($args)
    {
        dump(self::class);
        dump("works");

        if (method_exists($this, "messageReact")) {
            $this->messageReact($args);
        }
    }
}