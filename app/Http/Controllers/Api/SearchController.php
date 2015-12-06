<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Auto;
use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Http\JsonResponse;

/**
 * Search controller
 *
 * @package App\Http\Controllers\Api
 */
class SearchController extends Controller
{
    /**
     * Index action
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'auto.mark' => 'required',
            'auto.model' => 'required'
        ]);

        if ($validator->fails()) {
            return new JsonResponse($validator->errors()->all(), 422);
        }

        $salons = Salon::whereHas('autos', function ($query) use ($request) {
            $query->where('mark_id', $request->input('auto.mark'))
                ->where('model_id', $request->input('auto.model'));

            if ($generation = $request->input('auto.generation')) {
                $query->where('generation_id', $generation);
            }
            if ($bodyType = $request->input('auto.body')) {
                $query->where('body_type_id', $bodyType);
            }
            if ($gearboxType = $request->input('auto.gearbox')) {
                $query->where('gearbox_type_id', $gearboxType);
            }
        })->with('city')->get();

        return $salons->toJson();
    }
}
