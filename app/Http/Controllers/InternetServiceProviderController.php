<?php

namespace App\Http\Controllers;

use App\Services\InternetServiceProvider\ISP;
use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use Illuminate\Http\Request;

class InternetServiceProviderController extends Controller
{
    public function getMptInvoiceAmount(Request $request)
    {
        return $this->calculateTotalAmount($request, new Mpt());
    }

    public function getOoredooInvoiceAmount(Request $request)
    {
        return $this->calculateTotalAmount($request, new Ooredoo);
    }

    private function calculateTotalAmount(Request $request, ISP $provider)
    {
        $provider->setMonth($request->get('month') ?: 1);
        $amount = $provider->calculateTotalAmount();

        return response()->json([
            'data' => $amount
        ]);
    }
}
