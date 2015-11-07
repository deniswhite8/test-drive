<?php

namespace App\Http\Controllers\Api\Auto;

use App\Http\Controllers\Controller;
use App\Models\Auto\Mark;
use Illuminate\Http\JsonResponse;

/**
 * Auto mark models controller
 *
 * @package App\Http\Controllers\Api\Auto
 */
class MarkModelsController extends Controller
{
    /**
     * Index action
     * @param int $markId
     *
     * @return mixed
     */
    public function index($markId)
    {
        if ($mark = Mark::find($markId)) {
            return $mark->models->toJson();
        }

        return new JsonResponse('Auto mark not found.', 404);
    }
}
