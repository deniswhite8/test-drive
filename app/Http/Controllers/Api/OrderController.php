<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Auto;
use App\Models\Order;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Http\JsonResponse;

/**
 * Order controller
 *
 * @package App\Http\Controllers\Api
 */
class OrderController extends Controller
{
    /**
     * Place action
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function place(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mark_id' => 'required',
            'model_id' => 'required',
            'salon_id' => 'required',
            'contacts' => 'required',
            'datetime' => 'required',
        ]);

        if ($validator->fails()) {
            return new JsonResponse($validator->errors()->all(), 422);
        }

        $order = Order::create([
            'mark_id' => $request->get('mark_id'),
            'model_id' => $request->get('model_id'),
            'generation_id' => $request->get('generation_id'),
            'salon_id' => $request->get('salon_id'),
            'contacts' => $request->get('contacts'),
            'datetime' => $request->get('datetime'),
            'comment' => $request->get('comment'),
        ]);

        return $order->toJson();
    }
}
