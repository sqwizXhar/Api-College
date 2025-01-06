<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class BaseService
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        $model = $this->model;

        $model->fill($attributes);
        $model->save();

        return $model;
    }

    public function update(Model $model, array $attributes)
    {
        $model->update($attributes);

        return $model;
    }

    public function delete($id)
    {
        $this->model->destroy($id);
    }
}
