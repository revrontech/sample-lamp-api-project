<?php

namespace App\Models\Order;
use App\Models\BaseModel;


use Illuminate\Database\Eloquent\Model;

class StoreCuisines extends BaseModel
{
    protected $connection = 'order';

    protected $hidden = [
        'company_id','created_type', 'created_by', 'modified_type', 'modified_by', 'deleted_type', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'
    ]; 
    protected $appends = ['name'];

    public function cuisine()
    {
        return $this->hasOne('App\Models\Order\Cuisine', 'id', 'cuisines_id');
    }

    public function getNameAttribute()
    {
    	$cuisine = Cuisine::findOrFail($this->cuisines_id);
    	return $cuisine->name;
    }
}
