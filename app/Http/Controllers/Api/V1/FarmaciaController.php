<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Farmacia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

/**
* @OA\Info(title="API Farmacia", version="1.0", description="Esta API se encarga de manejar la información de la Gestión de las Farmacias especificando cada funcionalidad con la que cuenta como la especificación de la misma Entidad")
*
* @OA\Server(url="http://127.0.0.1:8000/")
*/

class FarmaciaController extends Controller
{

        /**
    * @OA\Get(
    *     path="/api/v1/farmacias",
    *     tags={"Farmacia"},
    *     summary="Mostrar Farmacias",
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar todos los usuarios."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */

    public function index()
    {
        $farmacia = Farmacia::all();
        return $farmacia;
    }

        /**
     * Crear Farmacia
     * @OA\Post (
     *     path="/api/v1/farmacias",
     *     tags={"Farmacia"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="nombre",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="dirección",
     *                          type="string"
     *                      ),
     *                     @OA\Property(
     *                          property="latitud",
     *                          type="number"
     *                     ),
     *                     @OA\Property(
     *                          property="longitud",
     *                          type="number"
     *                     )
     *                 ),
     *                 example={
     *                     "nombre":"",
     *                     "dirección":"",
     *                     "latitud":null,
     *                     "longitud":null
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="nombre", type="string", example="Botica MBF Pharma"),
     *              @OA\Property(property="dirección", type="string", example=" AV. CESAR CANEVARO MZ. Q - 2, LT. 4 A.H. TREBOL AZUL, Av. César Canevaro, San Juan de Miraflores"),
     *              @OA\Property(property="latitud", type="number", example=-12.1945699),
     *              @OA\Property(property="longitud", type="number", example=-76.966001),
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
    public function store(Request $request)
    {
        $farmacia = new Farmacia();
        $farmacia->nombre = $request->nombre;
        $farmacia->dirección = $request->dirección;
        $farmacia->latitud = $request->latitud;
        $farmacia->longitud = $request->longitud;

        $rules = [
            'nombre' => 'required',
            'dirección' => 'required',
            'latitud' => 'required',
            'longitud' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return [
                'created' => false,
                'errors'  => $validator->errors()->all()
            ];
        }

        $farmacia->save();
        return  ['data' => $farmacia];
        //return $farmacia;
    }
    /**
     * Obtener Farmacia
     * @OA\Get (
     *     path="/api/v1/farmacia/{id}",
     *     tags={"Farmacia"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="nombre", type="string", example="Botica MBF Pharma"),
     *              @OA\Property(property="dirección", type="string", example=" AV. CESAR CANEVARO MZ. Q - 2, LT. 4 A.H. TREBOL AZUL, Av. César Canevaro, San Juan de Miraflores"),
     *              @OA\Property(property="latitud", type="number", example=-12.1945699),
     *              @OA\Property(property="longitud", type="number", example=-76.966001),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *         )
     *     )
     * )
     */

    public function show(Request $request)
    {
        $farmacia = Farmacia::find($request->id);
        return $farmacia;
    }

    /**
     * Modificar Farmacia
     * @OA\Put (
     *     path="/api/v1/farmacias/{id}",
     *     tags={"Farmacia"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="nombre",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="dirección",
     *                          type="string"
     *                      ),
     *                     @OA\Property(
     *                          property="latitud",
     *                          type="number"
     *                     ),
     *                     @OA\Property(
     *                          property="longitud",
     *                          type="number"
     *                     )
     *                 ),
     *                 example={
     *                     "nombre":"",
     *                     "dirección":"",
     *                     "latitud":null,
     *                     "longitud":null
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="nombre", type="string", example="Botica MBF Pharma"),
     *              @OA\Property(property="dirección", type="string", example=" AV. CESAR CANEVARO MZ. Q - 2, LT. 4 A.H. TREBOL AZUL, Av. César Canevaro, San Juan de Miraflores"),
     *              @OA\Property(property="latitud", type="number", example=-12.1945699),
     *              @OA\Property(property="longitud", type="number", example=-76.966001),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *          )
     *      )
     * )
     */

    public function update(Request $request, $id)
    {
        $farmacia = Farmacia::findOrFail($request->id);
        $farmacia->nombre = $request->nombre;
        $farmacia->dirección = $request->dirección;
        $farmacia->latitud = $request->latitud;
        $farmacia->longitud = $request->longitud;

        $farmacia->save();
        return $farmacia;
    }

    /**
     * Borrar Farmacia
     * @OA\Delete (
     *     path="/api/v1/farmacias/{id}",
     *     tags={"Farmacia"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(property="msg", type="string", example="Farmacia borrada satisfactoriamente")
     *         )
     *     )
     * )
     */

    public function destroy($id)
    {
        $farmacia = Farmacia::destroy($id);
        return $farmacia;
    }



    /**
     * Listar Farmacias más cercanas
     * @OA\Get (
     *     path="/api/v1/farmacia?lat={lat}&lon={lon}",
     *     tags={"Farmacia"},
     *     security={
     *          {"bearer":{}}
     *     },
     *     @OA\Parameter(
     *         in="path",
     *         name="lat",
     *         required=true,
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         in="path",
     *         name="lon",
     *         required=true,
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="nombre", type="string", example="Botica MBF Pharma"),
     *              @OA\Property(property="dirección", type="string", example=" AV. CESAR CANEVARO MZ. Q - 2, LT. 4 A.H. TREBOL AZUL, Av. César Canevaro, San Juan de Miraflores"),
     *              @OA\Property(property="latitud", type="number", example=-12.1945699),
     *              @OA\Property(property="longitud", type="number", example=-76.966001),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *         )
     *     )
     * )
     */
    public function cercanos(Request $request) {

        $latitude = $request->lat;
        $longitude = $request->lon;

        $cercanos = Farmacia::select("nombre","dirección", DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                * cos(radians(latitud)) * cos(radians(longitud) - radians(" . $longitude . "))
                + sin(radians(" .$latitude. ")) * sin(radians(latitud))) AS distancia"))
                ->having('distancia', '<', 50)
                ->orderBy('distancia')
                ->get()->toArray();

        return $cercanos;

    }

}