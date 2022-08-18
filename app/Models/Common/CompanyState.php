<?php

namespace App\Models\Common;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyState extends BaseModel
{
    protected $connection = 'common';
    use SoftDeletes;
	
	protected $hidden = [
     	'created_type', 'created_by', 'modified_type', 'modified_by', 'deleted_type', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'
     ];

    public function country()
    {
        return $this->belongsTo('App\Models\Common\Country', 'country_id', 'id');
    }

      public function state()
    {
        return $this->belongsTo('App\Models\Common\State', 'state_id', 'id')->with('cities');
    }

     public function cities() {
        return $this->hasMany('App\Models\Common\City','state_id');
    }
    

     public function scopeSearch($query, $searchText='') {
        return $query
                        ->whereHas('country', function ($q) use ($searchText){
                            $q->where('country_name', 'like', "%" . $searchText . "%");
                        })
                        ->orwhereHas('state', function ($q) use ($searchText){
                            $q->where('state_name', 'like', "%" . $searchText . "%");
                        })
                        
                        ->orWhere('status', 'like', "%" . $searchText . "%");
    }

     
}