<?php

namespace App\Repositories;

use App\Models\Address;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Support\Facades\DB;

class AddressRepository implements RepositoryInterface
{
    protected $model;

    /**
     * AddressRepositoryRepository constructor.
     * @param Address $address
     */
    public function __construct(Address $address)
    {
        $this->model = $address;
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
        return $this->model->insert($params);
    }

    /**
     * @param $params
     * @param $where_clause
     * @return mixed
     */
    public function update($params, $where_clause)
    {
        DB::transaction(function() use($where_clause, $params) {
            $count = count($params);
            for ($i = 0; $i < $count; $i++) {
                $this->model->where(['employee_id' => $where_clause['employee_id']])
                    ->update($params[$i]);
            }
        });

        return true;
    }

    /**
     * @param $id
     */
    public function delete($id) {
        $this->model->where('employee_id', $id)->delete();
    }
}
