<?php

namespace App\Http\Controllers\Subcontractors;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class SubcontractorViewController extends Controller
{
    public function index()
    {
        return Inertia::render('SubcontractorView/Index', [
        ]);
    }

    public function invoice()
    {
        return Inertia::render('SubcontractorView/Invoice');
    }
}
