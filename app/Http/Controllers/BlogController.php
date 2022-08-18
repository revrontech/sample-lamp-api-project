<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\Actions;
use App\Models\Common\Blog;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Auth;

class BlogController extends Controller
{
    use Actions;
    private $model;
    private $request;
    
    public function __construct(Blog $model)
    {
        $this->model = $model;
    }
    
    public function index(Request $request)
    {
        $allcount = Blog::count();

        $skip = $request->rowid ? : 0;
        $take = $request->rowperpage ? : 1;
    
        $results = array();
        $results = Blog::skip($skip)->take($take)->get();

        
        $results['allcount'] = array("allcount" => $allcount);

           return Helper::getResponse(['data' => $results]);
    }

     public function details(Request $request, $slug)
     {
        $result = Blog::where('title_slug', $slug)->get();

        return Helper::getResponse(['data' => $result]);
     }
     
}
