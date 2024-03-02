<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\LoanRepayment;
use App\Repositories\Interfaces\RepositoryInterface;

class EmployeeRepository implements RepositoryInterface
{
    protected $model;

    /**
     * EmployeeRepository constructor.
     * @param Employee $employee
     */
    public function __construct(Employee $employee)
    {
        $this->model = $employee;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll() {
        return $this->model->with('contactNumbers', 'addresses')->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id, $eagar = false) {
        if ($eagar) {
            $result = $this->model->with('contactNumbers', 'addresses')->where('id', $id)->first();
        } else {
            $result = $this->model->where('id', $id)->first();
        }

        return $result;
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
        $this->model->where('id', $id)->delete();
    }
}
