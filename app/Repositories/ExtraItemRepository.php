<?php

namespace App\Repositories;

use App\Constants\AppConstants;
use App\Models\ExtraItem;

class ExtraItemRepository extends BaseRepository
{
    /**
     * @param ExtraItem $model
     */
    public function __construct(ExtraItem $model)
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
