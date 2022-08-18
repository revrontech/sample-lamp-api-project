<?php

namespace App\Http\Controllers\V1\Common\Admin\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\Actions;
use App\Models\Common\Reason;
use App\Helpers\Helper;
use Auth;

class ReasonController extends Controller
{
    

    use Actions;

    private $model;
    private $request; 

    public function __construct(Reason $model)
    {
        $this->model = $model;
    }

   

     public function index(Request $request)
    {
        $datum = Reason::where('company_id', Auth::user()->company_id);

        if($request->has('search_text') && $request->search_text != null) {
            $datum->Search($request->search_text);
        }

        if($request->has('order_by')) {
            $datum->orderby($request->order_by, $request->order_direction);
        }

        
        if($request->has('page') && $request->page == 'all') {
            $data = $datum->get();
        } else {
            $data = $datum->paginate(10);
        }

        $resArr['all'] = Reason::where('company_id', Auth::user()->company_id)->count();
        $resArr['active'] = Reason::where('company_id', Auth::user()->company_id)->where('status', 'Active')->count();
        $resArr['inactive'] = Reason::where('company_id', Auth::user()->company_id)->where('status', 'Inactive')->count();

        return Helper::getResponse(['data' => $data, 'extradata'=>$resArr]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'reason' => 'required', 
            'status' => 'required',   
            'service' => 'required',          
        ]);

        try{
            $request->request->add(['company_id' => \Auth::user()->company_id]);
            $reason = new reason;
            $reason->company_id = Auth::user()->company_id;  
            $reason->service = $request->service;
            $reason->type = $request->type;
            $reason->reason = $request->reason;
            $reason->status = $request->status;           
            $reason->save();
            //Reason::create($request->all());
            return Helper::getResponse(['status' => 200, 'message' => trans('admin.create')]);
        } 

        catch (\Throwable $e) {
            return Helper::getResponse(['status' => 404, 'message' => trans('admin.something_wrong'), 'error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
                $reason = Reason::findOrFail($id);
                    return Helper::getResponse(['data' => $reason]);
        } catch (\Throwable $e) {
            return Helper::getResponse(['status' => 404,'message' => trans('admin.something_wrong'), 'error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'type' => 'required',
            'reason' => 'required',
            'service' => 'required',         
        ]);

        try {
                    $reason = Reason::findOrFail($id);
                    $reason->service = $request->service;
                    $reason->type = $request->type;
                    $reason->reason = $request->reason;
                    $reason->status = $request->status;           
                    $reason->save();
                    return Helper::getResponse(['status' => 200, 'message' => trans('admin.update')]);
            } catch (\Throwable $e) {
                return Helper::getResponse(['status' => 404,'message' => trans('admin.something_wrong'), 'error' => $e->getMessage()]);
            }
    }

    public function destroy($id)
    {
        return $this->removeModel($id);
    }

}
