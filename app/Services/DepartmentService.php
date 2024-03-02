<?php

namespace App\Services;

use App\Repositories\DepartmentRepository;
use Carbon\Carbon;

class DepartmentService
{
    protected $department_repository;

    /**
     * DepartmentService constructor.
     * @param DepartmentRepository $department_repository
     */
    public function __construct(DepartmentRepository $department_repository)
    {
        $this->department_repository = $department_repository;
    }

    /**
     * @return mixed
     */
    public function getAllDepartments() {
        return $this->department_repository->getAll();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function createDepartment($data) {
        return $this->department_repository->create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getDepartmentById($id) {
        return $this->department_repository->getById($id);
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function updateDepartment($data, $id) {
        $where_clause = ['id' => $id];

        return $this->department_repository->update($data, $where_clause);
    }

    /**
     * @param $id
     */
    public function deleteDepartment($id){
        $this->department_repository->delete($id);
    }
}
