<?php

namespace Admin\Model;

use Think\Model;

class InfoModel extends Model
{
    protected $tableName = 'info';

    public function test(){
        return 'test admin';
    }
}


?>