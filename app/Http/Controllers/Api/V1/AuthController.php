<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
            /**
     * Iniciar Sesión
     * @OA\Post (
     *     path="/api/v1/login",
     *     tags={"Usuario"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="password",
     *                          type="string"
     *                      ),
     *                 ),
     *                 example={
     *                     "email":"",
     *                     "password":"",
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="email", type="string", example="lmendoza@gmail.com"),
     *              @OA\Property(property="password", type="string", example="***********"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="invalid",
     *          @OA\JsonContent(
     *              @OA\Property(property="msg", type="string", example="fail"),
     *          )
     *      )
     * )
     */

    /*public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }*/
    public function login(Request $request)
    {
    $credentials = $request->only('email', 'password');
    
        if ($token = JWTAuth::attempt($credentials)) {
            return $this->respondWithToken($token);
        }
    
        return response()->json(['error' => 'Unauthorized'], 401);
    }

        /**
     * Mi Información
     * @OA\Post (
     *     path="/api/v1/me",
     *     tags={"Usuario"},
     *          security={
     *          {"bearer":{}}
     *     },
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="Luis Angel Mendoza Chate"),
     *              @OA\Property(property="email", type="string", example="lmendoza27@autonoma.edu.pe"),
     *              @OA\Property(property="password", type="string", example="$2y$10$rc7vXIE6VyFkzwHrDhiDteC/ciUsnMOuOYAfH2IVBXf/NUqO77f6K"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="invalid",
     *          @OA\JsonContent(
     *              @OA\Property(property="msg", type="string", example="fail"),
     *          )
     *      )
     * )
     */
    public function me()
    {
        return response()->json(auth()->user());
    }
        /**
     * Cerrar Sesión
     * @OA\Post (
     *     path="/api/v1/logout",
     *     tags={"Usuario"},
     *          security={
     *          {"bearer":{}}
     *     },
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Successfully logged out"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="invalid",
     *          @OA\JsonContent(
     *              @OA\Property(property="msg", type="string", example="fail"),
     *          )
     *      )
     * )
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
        /**
     * Actualizar Token
     * @OA\Post (
     *     path="/api/v1/refresh",
     *     tags={"Usuario"},
     *          security={
     *          {"bearer":{}}
     *     },
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvcmVmcmVzaCIsImlhdCI6MTY1NTU4MjY5NiwiZXhwIjoxNjU1NTg2MzIzLCJuYmYiOjE2NTU1ODI3MjMsImp0aSI6Ikh1anRKNTBONDBUQ21HQUgiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.jPvZDPwWHsF70d405rDVGi9p0uRc7M6X1q2pj7jh_SM"),
     *              @OA\Property(property="token_type", type="string", example="bearer"), 
     *              @OA\Property(property="expires_in", type="integer", example=3600),              
     *             )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="invalid",
     *          @OA\JsonContent(
     *              @OA\Property(property="msg", type="string", example="fail"),
     *          )
     *      )
     * )
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}