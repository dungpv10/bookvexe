<?php

namespace App\Services;

use DB;
use App\Models\Customer;
use Yajra\Datatables\Datatables;

class CustomerService
{
    protected $customerModel;

    public function __construct(Customer $customerModel)
    {
        $this->customerModel = $customerModel;
    }

    public function destroy($id)
    {
        try {
            $this->customerModel->find($id)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getJSONData($filters)
    {
        $result = $this->customerModel->with('bus');
        $genderValue = Customer::$gender;
        return DataTables::of($result)
            ->addColumn('genderValue', function (Customer $customer) use ($genderValue) {
                return $genderValue[$customer->gender];
            })->make(true);
    }
}
