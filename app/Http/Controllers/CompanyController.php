<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function getCompanies() {
        $companies = Company::all();
        return $companies;
    }

    public function get_company($id) {
        $company = Company::find($id);
        return response()->json($company);
    }
}
