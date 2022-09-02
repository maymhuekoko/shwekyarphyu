<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Customer;
use App\Item;
use App\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\ItemResource;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LoginController extends ApiBaseController
{
    protected function loginProcess(Request $request){

    	$validator = Validator::make($request->all(), [
			'user_code' => 'required',
			'email' => 'required',
			'password' => 'required',
		]);

		if ($validator->fails()) {			

			return $this->sendFailResponse("Something Wrong! Validation Error.", "422");
		}

		$password = $request->password;

		$user = User::where('email', $request->email)->where('user_code', $request->user_code)->first();

		if (!isset($user)) {

			return $this->sendFailResponse("Something Wrong! User Not Found.", "422");
		}
		elseif (!\Hash::check($password, $user->password)) {
			
			return $this->sendFailResponse("Something Wrong! 123", "422"); 

		}elseif ($user->role != "Customer"){

			return $this->sendFailResponse("Something Wrong!", "422");

		}else{

			$tokenResult = $user->createToken('Laravel Personal Access Client')->accessToken;

            $customer = Customer::where('user_id', $user->id)->first();

			$category_lists = Category::whereNull("deleted_at")->select('id','category_code','category_name')->get();

			$item_lists = Item::where('category_id',1)->whereNull("deleted_at")->get();

            $final_item_lists = ItemResource::collection($item_lists);

			$photo = url("/") . '/photo/Customer/' . $user->photo_path;

            $collection = collect(['id','user_code', 'name','email','photo_path','phone','address']);

            $combined = $collection->combine([$user->id,$user->user_code,$user->name,$user->email,$photo,$customer->phone,$customer->address]);

			return response()->json([
				'message' => "Successful",
                'status' => 200,
                'access_token' => $tokenResult,               
                'user' => $combined,            
                'category_lists' => $category_lists,               
                'item_lists' => $final_item_lists,           
        	]);
		}
    }

    protected function logoutProcess(Request $request){

    	$request->user()->token()->revoke();

    	$message = "Successfully Logout!";

    	return $this->sendSuccessResponse("logout-message", $message);
    }

    protected function updatePassword(Request $request){

    	$validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$@#%]).*$/',
        ]);

        if ($validator->fails()) {

        	return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
        }

        $user = User::find($request->user()->id);
            
        $current_pw = $request->current_password;

        if(!\Hash::check($current_pw, $user->password)){

            return $this->sendFailResponse("Something Wrong! Password doesn't match.", "400");
        }

        $has_new_pw = \Hash::make($request->new_password);

        $user->password = $has_new_pw;

        $user->save();

        return $this->sendSuccessResponse("user", $user);
    }

    
}
