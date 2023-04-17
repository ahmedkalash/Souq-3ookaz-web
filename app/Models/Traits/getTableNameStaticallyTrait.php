<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait getTableNameStaticallyTrait
{
    public static function getTableName(){
        return (new static())->getTable();
    }
}
