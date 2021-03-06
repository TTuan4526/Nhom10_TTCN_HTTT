<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CompanyRepository;
use App\Models\Company;
use App\Http\Requests\CompaniesRequest;

class CompanyController extends Controller
{
  /**
     * The ProductRepository instance.
     *
     * @var \App\Repositories\CompanyRepository
     */
    protected $repository;


   /**
    * Create a new PostController instance.
    *
    * @param  \App\Repositories\CompanyRepository $repository
    */
   public function __construct(CompanyRepository $repository)
   {
       $this->repository = $repository;
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $company = $this->repository->getAll();
        $companies = $this->repository->search($request);
        return view('layout_admin.companies.companies_list', compact('companies', 'company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layout_admin.companies.companies_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompaniesRequest $request)
    {
        $this->repository->create($request);
        return redirect(route('companies.index'));
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
        $companies = $this->repository->getcompanies($id);
        return view('layout_admin.companies.companies_edit', compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, 
                [
                //Ki???m tra ????ng file ??u??i .jpg,.jpeg,.png.gif v?? dung l?????ng kh??ng qu?? 2M
                'img' => 'mimes:jpg,jpeg,png,gif|max:10048|',
                'name' => 'required|max:255|regex:/(^[\pL0-9 ]+$)/u',
                'email' => 'required',
                'address' => 'required',
                'phone' => 'required|numeric|digits:10',
                ],          
                [
                //T??y ch???nh hi???n th??? th??ng b??o kh??ng th??a ??i???u ki???n
                'name.required' => 'B???n ch??a nh???p t??n',
                'name.regex' => 'T??n nh?? xu???t b???n kh??ng ???????c ph??p c?? k?? t??? ?????c bi???t',
                'name.max' => 'Kh??ng v?????t qu?? 255 k?? t???',
                'email.required' => 'B???n ch??a nh???p email',
                'address.required' => 'B???n ch??a nh???p ?????a ch???',
                'phone.required' => 'B???n ch??a nh???p s??? ??i???n tho???i',
                'phone.digits' => '??i???n tho???i ch??? c?? 10 s???',
                'phone.numeric' => '??i???n tho???i ch??? ???????c nh???p s???',
    
                'img.required' => 'Vui l??ng ch???n ???nh',
                'img.mimes' => 'Ch??? ch???p nh???n h??nh th??? v???i ??u??i .jpg .jpeg .png .gif',
                'img.max' => 'H??nh th??? gi???i h???n dung l?????ng kh??ng qu?? 10M',
                ]
            );
        $this->repository->update($request, $id);
        return redirect()->back()->with('thongbao','C???p nh???t th??nh c??ng');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->destroy($id);
        return redirect()->back();
    }

}
