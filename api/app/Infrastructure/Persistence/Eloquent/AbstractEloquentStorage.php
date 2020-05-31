<?php

declare(strict_types=1);


namespace App\Infrastructure\Persistence\Eloquent;


use App\Infrastructure\Persistence\BaseStorage;

abstract class AbstractEloquentStorage implements BaseStorage
{
    protected $model = null;

    public function __construct()
    {
        if ($this->model === null) {
            throw new \RuntimeException('No model defined in storage');
        }
    }

    public function getAll()
    {
        return $this->model::all();
    }

    public function getById(int $id)
    {
        return $this->model::findOrFail($id);
    }

    public function save($model)
    {
        $model->save();
        return $model;
    }

    public function update($model)
    {
        return $model->update();
    }

    public function delete($model)
    {
        return $model->delete();
    }
}
