<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UsersResources;
use App\Models\Traits\Api\ApiResponseTrait;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponseTrait;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:users-api', ['except' => ['checkPhone', 'login', 'register', 'login_phone', 'restPassword']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {

            return $this->errorResponse($validator->errors(), 422);
        }
        if (!$token = auth('users-api')->attempt($validator->validated())) {
            return $this->errorResponse('Unauthorized', 422);
        }
        if (isset($request->fcm_token)) {
            User::where('email', $request->email)->update([
                'fcm_token' => $request->fcm_token,
            ]);
        }
        return $this->createNewToken($token);
    }

    public function login_phone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {

            return $this->errorResponse($validator->errors(), 422);
        }
        if (!$token = auth('users-api')->attempt($validator->validated())) {
            return $this->errorResponse('Unauthorized', 422);
        }
        if (isset($request->fcm_token)) {
            User::where('phone', $request->phone)->update([
                'fcm_token' => $request->fcm_token,
            ]);
        }
        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => 'required|numeric|unique:users',
            'gender' => 'required|in:male,female',
            'country_id' => 'required|exists:countries,id',
            'password' => 'required|string|min:6',

        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return $this->successResponse(new UsersResources($user), 'data created Successfully', 200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('users-api')->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth('users-api')->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return $this->successResponse(new UsersResources(auth('users-api')->user()), 'data return successfully');
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('users-api')->factory()->getTTL() * 80000000,
            'user' => new UsersResources(auth('users-api')->user())
        ]);
    }


    public function editProfile(Request $request)
    {
        $user = User::where('id', auth('users-api')->id())->first();

        if ($user) {

            $user->update([
                'name' => $request->name ?? null,
                'email' => $request->email ?? null,
                'gender' => $request->gender ?? null,
            ]);

            if ($request->hasFile('avatar')) {
                $imageName = time() . '.' . $request->avatar->extension();
                // Public Folder
                $files = $request->avatar->move('users/' . $user->id, $imageName);
            }

            $UserProfile = UserProfile::where('user_id', auth('users-api')->id())->first();

            if ($UserProfile) {
                $UserProfile->update([
                    'bio' => $request->bio,
                    'address' => $request->address,
                    'user_id' => auth('users-api')->id(),
                    'avatar' => $files ?? null,
                ]);
            } else {
                UserProfile::create([
                    'bio' => $request->bio,
                    'address' => $request->address,
                    'user_id' => auth('users-api')->id(),
                    'avatar' => $files ?? null,
                ]);
            }


            return $this->successResponse('', 'data Updated successfully');

        } else {
            return $this->errorResponse('Error', 400);
        }
    }


    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6',

        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 400);
        }
        $user = User::where('id', auth('users-api')->id())->first();


        if ($user) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return $this->successResponse('', 'Change password success');

        }
        return $this->errorResponse('Error');
    }


    public function restPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|exists:users,phone',
            'password' => 'required',

        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 400);
        }

        $checkUser = User::where('phone', $request->phone)->first();
        if (!$checkUser) {
            return $this->errorResponse('The User Not Find');
        }

        $checkUser->update([
            'password' => Hash::make($request->password),
        ]);

        return $this->successResponse('', 'Successfully Rest Password');
    }


    public function checkPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|exists:users,phone',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 400);
        }

        $checkUser = User::where('phone', $request->phone)->first();

        if (!$checkUser) {
            return $this->errorResponse('The User Not Find');
        }

        return $this->successResponse(new UsersResources($checkUser), 'User Already Expecting');
    }

    public function editImages(Request $request)
    {
        $user = User::where('id', auth('users-api')->id())->first();
        $UserProfile = UserProfile::where('user_id', auth('users-api')->id())->first();
        if ($request->hasFile('avatar')) {
            $imageName = time() . '.' . $request->avatar->extension();
            // Public Folder
            $files = $request->avatar->move('users/' . $user->id, $imageName);
        }

        if ($UserProfile) {
            $UserProfile->update([
                'avatar' => $files ?? null,
            ]);

            return $this->successResponse('', 'Successfully Upload Images');
        }
        return $this->errorResponse('The User Not Find');

    }
}
