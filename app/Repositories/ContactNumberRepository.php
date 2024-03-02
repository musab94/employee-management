<?php

namespace App\Repositories;

use App\Models\ContactNumber;
use App\Models\User;
use App\Repositories\Interfaces\RepositoryInterface;

class ContactNumberRepository implements RepositoryInterface
{
    protected $model;

    /**
     * ContactNumberRepository constructor.
     * @param ContactNumber $contact_number
     */
    public function __construct(ContactNumber $contact_number)
    {
        $this->model = $contact_number;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll() {
        return $this->model->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id) {
        return$this->model->where('id', $id)->first();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function create($params)
    {
        return $this->model->create($params);
    }

    /**
     * @param $params
     * @param $where_clause
     * @return mixed
     */
    public function update($params, $where_clause)
    {
        $entity = $this->model->where($where_clause)->first();
        if (!empty($entity)) {
            $entity->update($params);
        }

        return $entity;
    }

    /**
     * @param $id
     */
    public function delete($id) {
        $this->model->delete($id);
    }
}