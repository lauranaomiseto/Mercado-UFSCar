<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProd;

use Illuminate\Http\Request;

class SaleProdController extends Controller
{
	
	public function destroy(SaleProd $saleProd)
    {
        $saleProd->delete();
    }

}
