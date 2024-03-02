<?php

namespace App\Repositories;

use App\Models\ContactNumber;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Support\Facades\DB;

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
