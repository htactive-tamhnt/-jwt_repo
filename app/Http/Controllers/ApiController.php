<?php

namespace App\Http\Controllers;
 
use App\Http\Requests\RegisterAuthRequest;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
 
class ApiController extends Controller{

    public function register(RegisterAuthRequest $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'message' => 'Chúc mừng bạn đã đăng kí thành công!',
            // 'success' => true,
            'data' => $user,
        ], 200);
    }
    
    public function login(Request $request){
        $input = $request->only('email', 'password');
        $jwt_token = null;
        $jwt_token = JWTAuth::attempt($input);
        if (!$jwt_token) {
            return response()->json([
                'success' => false,
                'message' => 'Tài khoản hoặc mật khẩu không đúng',
            ], 401);
        }else{
            // $user = User::find(Auth::user()->id);
            // $user['remember_token'] = base64_encode($jwt_token);
            // $user->save();
            return response()->json([
                'message' => 'Chúc mừng bạn đã đăng nhập thành công!',
                'success' => true,
                'token' => $jwt_token,
            ]);
        }
    }
 
    public function logout(Request $request){
        $this->validate($request, [
            'token' => 'required'
        ]);
        try {
            JWTAuth::invalidate($request->token);
            return response()->json([
                'success' => true,
                'message' => 'Bạn đã đăng xuất thành công!'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Có j đó sai sai!'
            ], 500);
        }
    }
 
    public function getAuthUser(Request $request){
        $this->validate($request, [
            'token' => 'required'
        ]);
        $user = JWTAuth::authenticate($request->token);
        return response()->json(['user' => $user]);
    }
}