<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use JWTAuthException;
use Log;
use Validator;
use App\User;

class UserController extends Controller
{
    //TODO: Move to lang folder.
	const ERROR_LOGIN_INVALID_EMAIL_OR_PASSWORD  = 'Email or password is incorrect !';
	const ERROR_LOGIN_CREATE_TOKEN_ACCESS_FAILED = 'Login failed, please contact Admin !';

    const USER_LOGOUT_SUCCESSFULLY = 'Logout successfully.';
    const USER_UPDATE_SUCCESSFULLY = 'User info updated successfully.';

    protected $errors;

    public function __construct() {

    }

    /**
	* User login
	*/
    public function login() {
    	$userData = request(['email', 'password']);
    	
        try {
        	$token = JWTAuth::attempt($userData);

            if (empty($token)) {
            	$result = ['message' => self::ERROR_LOGIN_INVALID_EMAIL_OR_PASSWORD];
            	$this->log('UserLogin', $userData, $result);

                return response()->json($result, 422);
            }
        } catch (JWTAuthException $ex) {
        	$this->log('UserLoginException', $userData, $ex->getMessage());

            return response()->json(['message' => $ex->getMessage()], 500);
        }

        return response()->json(['token_access' => $token]);
    }

    /**
	* Update user information
	*/
    public function update(Request $request) {    	
    	$isValid = $this->validateUser($request);
    	//TODO: Unset token_access in $request before storage to log.
    	$this->log('UserUpdate', $request->all(), $isValid);

    	if ($isValid) {
    		$user = JWTAuth::toUser(request('token_access'));

    		$user->fill($request->all());
        	$user->save();

    		return response()->json(['user' => $user]);
    	}

    	$errors = $this->getErrors();
    	return response()->json(['message' => $errors], 500);
    }

	/**
	* Validate user information
	* TODO: Move to Request
	*/
    private function validateUser($request) {
    	$validator = Validator::make($request->all(), [
            'name' => 'string|required|max:128',
            'age' => 'int|required|between:1,100',
            'tel' => 'string|required|max:13',
            'address' => 'string|required|max:255',            
        ]);
    	
    	$errors = $validator->getMessageBag()->toArray();
    	
    	if (!empty($errors)) {
    		$this->setError($errors);
    		return false;
    	}

    	return true;
    }

    /**
	* Get user information
	*/
    public function info(Request $request) {
    	$token = $request->header('token_access');
    	$userInfo = JWTAuth::toUser($token);

    	$this->log('UserInfo', [], $userInfo);

    	return response()->json(['user' => $userInfo]);
    }

    /**
	* User logout
	*/
    public function logout(Request $request) {
    	$token = $request->header('token_access');

    	JWTAuth::invalidate($token);
    	$result = ['message' => self::USER_LOGOUT_SUCCESSFULLY];

    	$this->log('UserLogout', $result);

    	return response()->json($result);
    }

    private function setError($errors = []) {
    	$this->errors = $errors;
    }

    private function getErrors() {
    	return $this->errors;
    }
}
