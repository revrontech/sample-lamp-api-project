<?php

namespace App\Http\Controllers\V1\Common\Admin\Resource;

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
        $datum = Blog::select('*');

        if($request->has('search_text') && $request->search_text != null) {
        $datum->Search($request->search_text);
        }

        if($request->has('order_by')) {
        $datum->orderby($request->order_by, $request->order_direction);
        }

        if($request->has('page') && $request->page == 'all') {
        $results = $datum->get();
        } else {
        $results = $datum->paginate(10);
        }

        return Helper::getResponse(['data' => $results]);
    }
    
    public function store(Request $request)
    {  
        $this->validate($request, [
             'title' => 'required|max:255',
             'content' => 'required',
             'img' => 'required|image|mimes:jpeg,jpg,bmp,png,gif'
        ]);
        
        try{
            $requestData = $request->all(); 
            
            if($request->hasFile('img')) {   
            $requestData['img'] = Helper::upload_file($request->file('img'), 'menus'); 
            } 
            
            $requestData['title'] = $request->title;
            $requestData['title_slug'] = Str::slug($request->title);
            $requestData['content'] = $request->content;
            $requestData['year'] = date('Y');

            $result = Blog::create($requestData);

            return Helper::getResponse(['status' => 200, 'message' => trans('admin.create')]);
        } 
        
        catch (\Throwable $e) {
            return Helper::getResponse(['status' => 404, 'message' => trans('admin.something_wrong'), 'error' => $e->getMessage()]);
        }
    }
    
    public function show($id)
    {
        try {
            $result = Blog::findOrFail($id);
            return Helper::getResponse(['data' => $result]);
        } catch (\Throwable $e) {
            return Helper::getResponse(['status' => 404,'message' => trans('admin.something_wrong'), 'error' => $e->getMessage()]);
        }
    }
    
    public function update(Request $request, $id)
    {
       
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required' 
        ]);
    
        try {
             $requestData = $request->all();

             $article = Blog::findOrFail($id);

             if($request->hasFile('img')) {
              $requestData['img'] = Helper::upload_file($request->file('img'), 'menus');
             } 

             $requestData['title_slug'] = Str::slug($request->title);
             $requestData['year'] = date('Y');
 
             $article->update($requestData);
            
            return Helper::getResponse(['status' => 200, 'message' => trans('admin.update')]);
            } catch (\Throwable $e) {
                return Helper::getResponse(['status' => 404,'message' => trans('admin.something_wrong'), 'error' => $e->getMessage()]);
            }
    }
    
    public function destroy($id)
    {
        return $this->removeModel($id);
    }
    
    public function updateStatus(Request $request, $id)
    {
        
        try {
            
            $datum = Blog::findOrFail($id);
            
            if($request->has('status')){
                if($request->status == 1){
                    $datum->status = 0;
                }else{
                    $datum->status = 1;
                }
            }
            $datum->save();
           
            return Helper::getResponse(['status' => 200, 'message' => trans('admin.activation_status')]);
        
        } 
        
        catch (\Throwable $e) {
            return Helper::getResponse(['status' => 404, 'message' => trans('admin.something_wrong'), 'error' => $e->getMessage()]);
        }
    }
   
}
