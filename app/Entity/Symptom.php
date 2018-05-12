<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $table='symptom'; //绑定表名	
    protected $primarykey='id'; //绑定主键
}
