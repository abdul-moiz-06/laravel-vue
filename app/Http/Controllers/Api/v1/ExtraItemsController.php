<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ExtraItemsResource;
use App\Repositories\ExtraItemRepository;
use Illuminate\Http\Request;

class ExtraItemsController extends ApiBaseController
{
    /**
     * @var $extraItemRepo ExtraItemRepository
     */
    private $extraItemRepo;

    public function __construct(ExtraItemRepository $extraItemRepo)
    {
        $this->extraItemRepo = $extraItemRepo;
    }
    public function index(Request $request)
    {
        $items = $this->extraItemRepo->query();

        return $this->sendSuccessResponse(ExtraItemsResource::collection($items), 'OK');
    }
}
