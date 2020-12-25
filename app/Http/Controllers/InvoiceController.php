<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoices.index');
    }

    public function view(Invoice $invoice)
    {

        return view('invoices.view', ['invoice' => $invoice]);
    }
}
