<?php

namespace App\Http\Controllers;

use App\Services\LoanService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct(
        protected LoanService $loanService
    ) {
    }
    public function index(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $loans = $this->loanService->all();
        return view('index', compact('loans'));
    }
}
