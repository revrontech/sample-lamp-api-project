<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\Actions;
use App\Models\Common\News;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Auth;

class NewsController extends Controller
{
    use Actions;
    private $model;
    private $request;
    
    public function __construct(News $model)
    {
        $this->model = $model;
    }
    
    public function index(Request $request)
    {
        $allcount = News::count();
        
        $skip = $request->rowid ? : 0;
        $take = $request->rowperpage ? : 1;
    
        $results = array();
        $results = News::skip($skip)->take($take)->get();
        
        
        $results['allcount'] = array("allcount" => $allcount);
           
           return Helper::getResponse(['data' => $results]);
    }

     public function details(Request $request, $slug)
     {
        $result = News::where('title_slug', $slug)->get();

        return Helper::getResponse(['data' => $result]);
     }
    
     
}
