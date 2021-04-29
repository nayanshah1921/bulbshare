<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerCreateRequest;
use Illuminate\Http\Request;
use App\Customer;
use App\State;
use App\City;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $data['user'] = $user;
        $data['page_title'] = 'Customer';
        $data['breadcrumb_level_1'] = 'Customer';
        $data['page_name'] = 'customer_master';
        $data['customer'] = Customer::select('customers.id', 'customers.company', 'customers.last_name', 'customers.first_name', 'customers.email_address', 'customers.job_title', 'customers.business_phone', 'customers.home_phone', 'customers.mobile_phone', 'customers.fax_number', 'customers.address', 'customers.city', 'customers.state_province', 'customers.zip_postal_code', 'customers.country_region', 'customers.web_page')->get();
        return view('customer.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $data['user'] = $user;
        $data['id'] = 0;
        $data['page_title'] = 'Customer';
        $data['breadcrumb_level_1'] = 'Customer';
        $data['page_name'] = 'customer_master';
        $data['state'] = State::where('country_id',101)->orderBy('state','asc')->get();
        return view('customer.create')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerCreateRequest $request)
    {
        $userId = auth()->id();
        $request['active'] = 1;
        $request['added_by'] = $userId;
        $request['updated_by'] = $userId;
        Customer::create($request->all());
        return redirect()->back()->with('success_message', 'Customer Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        $data['user'] = $user;
        $data['id'] = $id;
        $data['page_title'] = 'Customer';
        $data['breadcrumb_level_1'] = 'Customer';
        $data['page_name'] = 'customer_master';
        $data['customer'] = Customer::where('id','=',$id)->get()->first();
        $data['state'] = State::where('country_id',101)->orderBy('state','asc')->get();
        $data['city'] = array();
        if(isset($data['customer']->state_id) && intval($data['customer']->state_id) > 0 )
            $data['city'] = City::where('state_id',$data['customer']->state_id)->orderBy('city','asc')->get();
        return view('customer.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerCreateRequest $request, Customer $customer)
    {
        $userId = auth()->id();
        $update_data = [
            'customer_name' => $request->customer_name,
            'company_name' => $request->company_name,
            'email_id' => $request->email_id,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'pincode' => $request->pincode,
            'notes' => $request->notes,
            'updated_by' => $userId
        ];
        $customer->update($update_data);
        return redirect(route('customer.index'))->with('success_message','Customer Updated Successfully !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::where('id','=',$id)->delete();
        return redirect(route('customer.index'))->with('success_message','Customer Deleted Successfully !!!');
    }
    public function approve($id)
    {
        Customer::where('id','=',$id)->update(['active' => 1]);
        return redirect(route('customer.index'))->with('success_message','Customer Approved Successfully !!!');
    }
    public function getcities()
    {
        $ajaxRes = array();
        $result = City::where('state_id','=',$_POST['id'])->orderBy('city','asc')->get();
        $html = '<option value="">Select City</option>';
        foreach($result as $c){
                $html.='<option value="'.$c->id.'">'.$c->city.'</option>';
        }
        $ajaxRes['status'] = 1;
        $ajaxRes['html'] = $html;
        header('Content-type: application/json');
        echo json_encode($ajaxRes);
        exit;
    }
    public function save(Request $request)
    {
        $rules = array(
            'company' => 'required|max:50',
            'last_name' => 'required|max:50',
            'first_name' => 'required|max:50',
            'email_address' => 'max:50|email',
            'job_title' => 'max:50',
            'business_phone' => 'max:25',
            'home_phone' => 'max:25',
            'mobile_phone' => 'max:25',
            'fax_number' => 'max:25',
            'address' => 'max:500',
            'city' => 'max:50',
            'state_province' => 'max:50',
            'country_region' => 'max:50',
            'zip_postal_code' => 'max:25',
            'web_page' => 'max:50',
        );
        $validator = Validator::make($request->all(), $rules);

        // Validate the input and return correct response
        if ($validator->fails())
        {
            $ajaxRes = array('status' => 0, 'response_code' => 201, 'errors' => $validator->getMessageBag()->toArray());
        }
        else{
            if(intval($request->customer_id) > 0){
                $update_data = [
                    'company' => $request->company,
                    'last_name' => $request->last_name,
                    'first_name' => $request->first_name,
                    'email_address' => $request->email_address,
                    'job_title' => $request->job_title,
                    'business_phone' => $request->business_phone,
                    'home_phone' => $request->home_phone,
                    'mobile_phone' => $request->mobile_phone,
                    'fax_number' => $request->fax_number,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state_province' => $request->state_province,
                    'zip_postal_code' => $request->zip_postal_code,
                    'country_region' => $request->country_region,
                    'web_page' => $request->web_page,
                ];
                $customer = new Customer();
                $customer->where('id',$request->customer_id)->update($update_data);
            }
            else{
                Customer::create($request->all());
            }
            $ajaxRes = array('status' => 1);
        }
        header('Content-type: application/json');
        echo json_encode($ajaxRes);
        exit;
    }
    public function details(Request $request)
    {
        $customer = Customer::where('id','=',$request->id)->get()->first();
        header('Content-type: application/json');
        $ajaxRes = array('status' => 1,'data' =>$customer);
        echo json_encode($ajaxRes);
        exit;
    }
}
