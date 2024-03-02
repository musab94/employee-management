<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;
use App\Services\Traits\ResponseCodeTrait;

class EmployeeService
{
    use ResponseCodeTrait;

    protected $employee_repository;

    /**
     * EmployeeService constructor.
     * @param EmployeeRepository $employee_repository
     */
    public function __construct(EmployeeRepository $employee_repository)
    {
        $this->employee_repository = $employee_repository;
    }

    public function create($data)
    {
        // TODO: Implement create() method.
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
    }
}
