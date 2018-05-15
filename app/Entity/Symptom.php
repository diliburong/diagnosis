<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $table='symptom'; //绑定表名	
    protected $primarykey='id'; //绑定主键
    
    public function symptomChild()
    {
        return $this->hasMany('App\Entity\Symptom', 'parent_id', 'id');
    }

}
