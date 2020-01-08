<?php

namespace App\Models;

use App\Models\SystemConfigGroup;
use App\Models\VariableType;
use Illuminate\Database\Eloquent\Model;

class SystemConfig extends Model
{
    //
  	protected $table = 'system_config';
  
  	public function getContentAttribute($extra)
    {
        return array_values(json_decode($extra, true) ?: []);
    }

    public function setContentAttribute($extra)
    {
        $this->attributes['content'] = json_encode(array_values($extra));
    }
  
  	//public function system_config_group()
    //{
    //    return $this->belongsTo(SystemConfigGroup::class,'group');
    //}
  
  	//public function variable_type()
    //{
    //    return $this->belongsTo(VariableType::class,'type');
    //}
}
