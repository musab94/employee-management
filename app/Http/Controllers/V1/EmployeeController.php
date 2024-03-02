<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmpolyeeRequest;
use App\Services\DepartmentService;
use App\Services\EmployeeService;
use App\Services\Traits\ResponseCodeTrait;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use ResponseCodeTrait;

    protected $employee_service;

    public function __construct(EmployeeService $employee_service) {
        $this->employee_service = $employee_service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->employee_service->getAllEmployees();

        $response = self::getResponseCode(1);
        $response['data']['employees'] = $result;

        return $this->response($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmpolyeeRequest $request)
    {
        $result = $this->employee_service->createEmployee($request->all());

        $response = self::getResponseCode(1);
        $response['data']['employee'] = $result;

        return $this->response($response);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $result = $this->employee_service->getEmployeeById($id);

        $response = self::getResponseCode(1);
        $response['data']['employee'] = $result;

        return $this->response($response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEmpolyeeRequest $request, $id)
    {
        $request_data = $request->all();
        $result = $this->employee_service->updateEmployee($request_data, $id);

        $response = self::getResponseCode(1);
        $response['data']['employee'] = $result;

        return $this->response($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->employee_service->deleteDepartment($id);

        $response = self::getResponseCode(1);
        $response['data']['employee'] = [];

        return $this->response($response);
    }
}
