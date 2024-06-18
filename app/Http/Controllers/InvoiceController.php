<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceCollection;
use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Filters\InvoiceFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\HTTP\Requests\BulkStoreInvoiceRequest;


class InvoiceController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $filter = new InvoiceFilter();
        $queryItems = $filter->transform($request);
        if(count($queryItems) == 0){
            return new InvoiceCollection(Invoice::paginate());
        }else{
            $invoices = Invoice::where($queryItems)->paginate();
            return new InvoiceCollection($invoices->appends($request->query()));
        }

      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        //

    }  
    public function bulkStore(BulkStoreInvoiceRequest $request) {
        //
       $bulk = collect($request->all())->map(function($arr,$key){
           return Arr::except($arr,['customerId','billedDate','paidDate']);
       });
       Invoice::insert($bulk->toArray());
    }
    /**
     * Display the specified resource.
     */
    public function show(Invoice $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $customer)
    {
        //
    }

}
