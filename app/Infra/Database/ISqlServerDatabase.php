<?php

namespace App\Infra\Database;

interface ISqlServerDatabase
{
    public function query($sql);

    public function escapeString($string);

    public function prepare($sql);
    public function close();
}
