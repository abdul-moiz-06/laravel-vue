<?php

namespace App\Repositories;

use App\Constants\AppConstants;
use App\Models\Item;

class ItemRepository extends BaseRepository
{
    /**
     * @param Item $model
     */
    public function __construct(Item $model)
    {
        parent::__construct($model);
    }

    public function query($params = [])
    {
        $model = $this->model;

        if (isset($params['name'])) {
            $model = $model->where('name', 'like', '%'.$params['name'].'%');
        }

        if (isset($params['count'])) {
            return $model->count('id');
        }

        if (isset($params['paginate'])) {
            return $model->paginate(AppConstants::PAGINATE);
        }
        return $model->get();
    }
}
