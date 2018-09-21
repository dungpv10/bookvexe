<?php

namespace App\Http\Controllers\Admin;

use App\Services\CustomerService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * @var CustomerService
     */
    protected $customerService;

    /**
     * CustomerController constructor.
     * @param CustomerService $customerService
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.customer.index');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getJSONData(Request $request)
    {
        $filters = $request->get('search')['value'];
        return $this->customerService->getJSONData($filters);
    }

    public function destroy(Request $request, $id)
    {
        $result = $this->customerService->destroy($id);
        if ($result) {
            if($request->ajax())
            {
                return response()->json(['code' => 200, 'message' => 'Xoá Thành công']);
            }
            return redirect('admin/customer')->with('message', 'Xoá thành công');
        }
        if($request->ajax())
        {
            return response()->json(['code' => 500, 'message' => 'Xoá Thất bại']);
        }

        return redirect('admin/customer')->with('message', 'Failed to delete');
    }
}
