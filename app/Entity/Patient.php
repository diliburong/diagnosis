<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table='patient'; //绑定表名	
    protected $primarykey='id'; //绑定主键
}
