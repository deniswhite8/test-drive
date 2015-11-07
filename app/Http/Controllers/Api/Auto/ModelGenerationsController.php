<?php

namespace App\Http\Controllers\Api\Auto;

use App\Http\Controllers\Controller;
use App\Models\Auto\Model;
use Illuminate\Http\JsonResponse;

/**
 * Auto model generations controller
 *
 * @package App\Http\Controllers\Api\Auto
 */
class ModelGenerationsController extends Controller
{
    /**
     * Index action
     * @param int $modelId
     *
     * @return mixed
     */
    public function index($modelId)
    {
        if ($model = Model::find($modelId)) {
            return $model->generations->toJson();
        }

        return new JsonResponse('Auto model not found.', 404);
    }
}
