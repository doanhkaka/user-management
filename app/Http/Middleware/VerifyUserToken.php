<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use \Tymon\JWTAuth\Exceptions\JWTException;
use Log; 

class VerifyUserToken
{
    //TODO: Move to lang folder, process for multiple languages
    const ERROR_TOKEN_IS_REQUIRED = 'Token access is required !';
    const ERROR_TOKEN_IS_INVALID  = 'Token access is invalid !';
    const ERROR_TOKEN_IS_EXPIRED  = 'Token access is expired !';
    const ERROR_TOKEN_GENERAL_ERROR = 'Something is wrong, please contact to Administrator !';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('token_access');
        try {
            $user = JWTAuth::toUser($token);
        } catch (JWTException $ex) {            
            if($ex instanceof TokenExpiredException) {                
                $exceptions['error'] = self::ERROR_TOKEN_IS_EXPIRED;
            } elseif ($ex instanceof TokenInvalidException) {                
                $exceptions['error'] = self::ERROR_TOKEN_IS_INVALID;
            } elseif(empty($token)) {                
                $exceptions['error'] = self::ERROR_TOKEN_IS_REQUIRED;
            } else {
                //TODO: Don't response all error to client.
                //$exceptions['error'] = self::ERROR_TOKEN_GENERAL_ERROR;
                $exceptions['error'] = $ex->getMessage();                
            }

            Log::error('VerifyUserToken:', ['error' => $ex->getMessage()]);

            return response()->json($exceptions, $ex->getStatusCode());
        }

        return $next($request);
    }
}
