<?php

namespace App\Http\Controllers;

use App\Repositories\ExtraItemRepository;
use App\Repositories\ItemRepository;
use App\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * @var $itemRepo ItemRepository
     */
    private $itemRepo;

    /**
     * @var $extraItemRepo ExtraItemRepository
     */
    private $extraItemRepo;

    /**
     * @var $itemService ItemService
     */
    private $itemService;

    public function __construct(ItemRepository $itemRepo, ItemService $itemService, ExtraItemRepository $extraItemRepo)
    {
        $this->itemService = $itemService;
        $this->itemRepo = $itemRepo;
        $this->extraItemRepo = $extraItemRepo;
    }

    public function index(Request $request)
    {
        $query_params = $request->all();
        $query_params = array_merge($query_params, ['paginate' => true]);

        $items = $this->itemRepo->query($query_params);

        $extraItems = $this->extraItemRepo->query($query_params);

        return view('list', compact('items', 'extraItems'));
    }
}
