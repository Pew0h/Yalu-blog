<?php


class Main
{
    public static function alert(string $type, string $message)
    {
        return '<p class="text-'.$type.'">'.$message.'</p>';
    }

}