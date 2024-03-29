<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ItemsResource;
use App\Repositories\ItemRepository;
use Illuminate\Http\Request;

class ItemsController extends ApiBaseController
{
    /**
     * @var $itemRepo ItemRepository
     */
    private $itemRepo;

    public function __construct(ItemRepository $itemRepo)
    {
        $this->itemRepo = $itemRepo;
    }
    public function index(Request $request)
    {
        $items = $this->itemRepo->query();

        return $this->sendSuccessResponse(ItemsResource::collection($items), 'OK');
    }
}
