<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index(): View
    {
        // Gunakan langsung query builder untuk pagination
        $transactions = Transaction::paginate(5);

        return view('admin.transactions', [
            'transactions' => $transactions,
        ]);
    }
}
