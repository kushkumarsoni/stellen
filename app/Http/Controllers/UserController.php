<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        $datalist = User::with('country','state','city')->get();
      return view('index',compact('countries','datalist'));
    }

    public function fetchAll(Request $request){
        if($request->ajax()){
            $datalist = User::with('country','state','city')->get();
            return view('users_table',compact('datalist'))->render();
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            $validator = Validator::make($request->all(),[
                'name'=>'required|string|min:3|max:191',
                'email'=>'required|email|unique:users,email|max:191',
                'mobile'=>'required|numeric|digits:10|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users,mobile',
                'country_id'=>'required',
                'state_id'=>'required',
                'city_id'=>'required',
                'avatar'=>'required|image|mimes:jpg,jpeg,png,svg,gif'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status'=>400,
                    'errors'=>$validator->messages()
                ]);
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->country_id = $request->country_id;
            $user->state_id = $request->state_id;
            $user->city_id = $request->city_id;
            $user->address = $request->address;
    
            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/images', $fileName);
                $user->photo = $fileName;
            }
            $user->save();

            return response()->json([
                'status' => 200,
                'message'=>'User Added Successfully!'
            ]);
            
        }
    }

    // handle edit an employee ajax request
	public function edit(Request $request) {
		$id = $request->id;
		$users = User::find($id);
        $countries = Country::get();
		return response()->json(compact('users','countries'));
	}

	// handle update an employee ajax request
	public function update(Request $request) {
	
	    if($request->ajax()){
            $validator = Validator::make($request->all(),[
                'name'=>'required|string|min:3|max:191',
                'email'=>'required|email',
                'mobile'=>'required|numeric|digits:10|regex:/^([0-9\s\-\+\(\)]*)$/',
                'country_id'=>'required',
                'state_id'=>'required',
                'city_id'=>'required',
                'avatar'=>'nullable|image|mimes:jpg,jpeg,png,svg,gif'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status'=>400,
                    'errors'=>$validator->messages()
                ]);
            }
            $user = User::find($request->emp_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->country_id = $request->country_id;
            $user->state_id = $request->state_id;
            $user->city_id = $request->city_id;
            $user->address = $request->address;
    
            $fileName = '';
		
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/images', $fileName);
                if ($user->avatar) {
                    Storage::delete('public/images/' . $user->avatar);
                }
            } else {
                $fileName = $request->emp_avatar;
            }
            $user->photo = $fileName;
            $user->save();

            return response()->json([
                'status' => 200,
                'message'=>'User Updated Successfully!'
            ]);
            
        }
	}
    
    public function delete(Request $request)
    {
        $id = $request->id;
		$emp = User::find($id);
		if (Storage::delete('public/images/' . $emp->photo)) {
			User::destroy($id);
		}
        return response()->json([
            'status'=>200,
            'message'=>'Data Deleted Successfully'
        ]);
    }

    public function fetchCountry(Request $request){
        $countries = Country::get();
        return response()->json([
            'status'=>200,
            'countries'=>$countries
        ]);
    }

    public function fetchState(Request $request){
        $states = State::where('country_id',$request->country_id)->get();
        return response()->json([
            'status'=>200,
            'states'=>$states
        ]);
    }

    public function fetchCity(Request $request){
        $cities = City::where('state_id',$request->state_id)->get();
        return response()->json([
            'status'=>200,
            'cities'=>$cities
        ]);
    }
}
