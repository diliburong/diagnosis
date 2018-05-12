<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Diagonse extends Model
{
    protected $table='diagonse_history'; //绑定表名	
    protected $primarykey='id'; //绑定主键

    public function symptomOne()
    {
        return $this->hasOne('App\Entity\Symptom', 'id', 'symptom_one');
    }

    public function symptomTwo()
    {
        return $this->hasOne('App\Entity\Symptom', 'id', 'symptom_two');
    }
}
