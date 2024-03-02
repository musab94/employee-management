<?php

namespace App\Services;

use App\Repositories\AddressRepository;
use App\Repositories\ContactNumberRepository;
use App\Repositories\EmployeeRepository;
use App\Services\Traits\ResponseCodeTrait;

class EmployeeService
{
    use ResponseCodeTrait;

    protected $employee_repository;
    protected $contact_number_repository;
    protected $address_repository;

    /**
     * EmployeeService constructor.
     * @param EmployeeRepository $employee_repository
     */
    public function __construct(EmployeeRepository $employee_repository,
                                ContactNumberRepository $contact_number_repository,
                                AddressRepository $address_repository)
    {
        $this->employee_repository = $employee_repository;
        $this->contact_number_repository = $contact_number_repository;
        $this->address_repository = $address_repository;

    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllEmployees()
    {
        return $this->employee_repository->getAll();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function createEmployee($data) {
        $employee_data = $data['employee_details'];
        $employee = $this->employee_repository->create($employee_data);

        $contact_data = [];
        foreach ($data['contact_details'] as $emp) {
            $emp['employee_id'] = $employee->id;
            array_push($contact_data, $emp);
        }
        $contact_numbers = $this->contact_number_repository->create($contact_data);

        $address_data = [];
        foreach ($data['address_details'] as $address) {
            $address['employee_id'] = $employee->id;
            array_push($address_data, $address);
        }
        $addresses = $this->address_repository->create($address_data);

        $employee['contact_numbers'] = $employee->contactNumbers;
        $employee['addresses'] = $employee->addresses;

        return $employee;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEmployeeById($id) {
        return $this->employee_repository->getById($id, true);
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function updateEmployee($data, $id) {
        $employee_where_clause = ['id' => $id];
        $contact_where_clause = ['employee_id' => $id];
        $address_where_clause = ['employee_id' => $id];

        $employee = $this->employee_repository->update($data['employee_details'], $employee_where_clause);
        $this->contact_number_repository->update($data['contact_details'], $contact_where_clause);
        $this->address_repository->update($data['address_details'], $address_where_clause);

        $employee['contact_numbers'] = $employee->contactNumbers;
        $employee['addresses'] = $employee->addresses;

        return $employee;
    }

    /**
     * @param $id
     */
    public function deleteDepartment($id) {
//        $this->contact_number_repository->delete($id);
//        $this->address_repository->delete($id);
        $this->employee_repository->delete($id);
    }
}
