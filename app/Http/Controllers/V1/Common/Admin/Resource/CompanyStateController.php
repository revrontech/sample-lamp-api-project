<?php

namespace App\Http\Controllers\V1\Common\Admin\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Traits\Actions;
use Illuminate\Support\Facades\Storage;
use App\Models\Common\CompanyCity;
use App\Models\Common\CompanyState;
use App\Models\Common\CompanyCityAdminService;
use App\Models\Common\State;
use App\Models\Common\City;

use Auth;
class CompanyStateController extends Controller
{
    use Actions;
    private $model;
    private $request;
    public function __construct(CompanyState $model)
    {
        $this->model = $model; 
    }
    
    public function index(Request $request)
    {
        $datum = CompanyState::with('country','state')->where('company_id', Auth::user()->company_id);
        
       
        if($request->has('search_text') && $request->search_text != null) {
            $datum->Search($request->search_text);
        }
        
        if($request->has('order_by')) {
            $datum->orderby($request->order_by, $request->order_direction);
        }
        
        if($request->has('page') && $request->page == 'all') {
            $datum = $datum->get();
        } else {
            $datum = $datum->paginate(10);
        }
         
         $resArr = [];
         $resArr['all'] = CompanyState::with('country','state')->where('company_id', Auth::user()->company_id)->count();
         $resArr['active'] = CompanyState::with('country','state')->where('company_id', Auth::user()->company_id)->where('status', '1')->count();
         $resArr['inactive'] = CompanyState::with('country','state')->where('company_id', Auth::user()->company_id)->where('status', '0')->count();
        
        return Helper::getResponse(['data' => $datum, 'extradata'=>$resArr]);
    }
    
    public function store(Request $request)
    {  
        $this->validate($request, [
             'country_id' => 'required',
             'state_id' => 'required',
             'status' => 'required',
             'other_state' => 'required_if:state_id,other'
        ], [
            'other_state.required_if' => 'State Name is required',
        ]);
       
        try{
            if($request->has('other_state') && $request->state_id=='other'){
                $State = new State;
                $State->country_id = $request->country_id;
                $State->state_name = $request->other_state;
                $State->status = $request->status;
                $State->save();
                
                $state_id = $State->id;
            }else{
                $state_id = $request->state_id;
            }
            
            $company_state_service = new CompanyState;
            $company_state_service->company_id = Auth::user()->company_id;  
            $company_state_service->country_id = $request->country_id; 
            $company_state_service->state_id = $state_id; 
            $company_state_service->status = $request->status;      
            $company_state_service->save(); 
            return Helper::getResponse(['status' => 200, 'message' => trans('admin.create')]);
        } 
        
        catch (\Throwable $e) {
            return Helper::getResponse(['status' => 404, 'message' => trans('admin.something_wrong'), 'error' => $e->getMessage()]);
        }
    }
    
    public function show($id)
    {

         try {
         $company_country = CompanyState::with('country','state')->where('company_id', Auth::user()->company_id)->findOrFail($id);

          $company_country['state_data']=State::where('country_id',$company_country['country_id'])->get();

         return Helper::getResponse(['data' => $company_country]);
         } catch (\Throwable $e) {
         return Helper::getResponse(['status' => 404,'message' => trans('admin.something_wrong'), 'error' => $e->getMessage()]);
         }
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
             'country_id' => 'required',
             'state_id' => 'required',
             'status' => 'required',
        ]);
    
        try {
            $company_state_service = CompanyState::findOrFail($id);
            $company_state_service->country_id = $request->country_id;
            $company_state_service->state_id = $request->state_id; 
            $company_state_service->status = $request->status;                    
            $company_state_service->update(); 
            return Helper::getResponse(['status' => 200, 'message' => trans('admin.update')]);
            } catch (\Throwable $e) {
                return Helper::getResponse(['status' => 404,'message' => trans('admin.something_wrong'), 'error' => $e->getMessage()]);
            }
    }

    // public function countrycities(Request $request,$id)
    // {
    //     $country_city = CompanyCity::where("country_id",$id)->with('city')->get();
    //     return Helper::getResponse(['data' => $country_city]);
    // }
    
    public function destroy($id)
    {
        return $this->removeModel($id);
    }

    

  
}
