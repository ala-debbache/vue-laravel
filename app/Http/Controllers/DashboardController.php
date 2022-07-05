<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;

use App\Models\Client;
use App\Models\Provider;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $clients_count = Client::all()->count();
        $providers_count = Provider::all()->count();
        $products_count = Product::all()->count();
        $transactions_count = Transaction::all()->count();
        $top_clients_transactions = Client::with('user')->withCount('transactions')->orderBy('transactions_count','desc')->take(5)->get();
        $top_clients_spending = Client::with('user')->withSum('transactions','total')->orderBy('transactions_sum_total','desc')->take(5)->get();
        $top_clients_spending2 = Client::addSelect(['total' => Transaction::selectRaw('sum(total) as total')
        ->whereColumn('client_id', 'clients.id')
        ->groupBy('client_id')
        ])->orderBy('total','desc')->take(5)->get();
        $top_products_sales = Product::withSum('transactions','product_transaction.quantity')->orderBy('transactions_sum_product_transactionquantity','desc')->take(5)->get();
        $top_traansactions_sales = Transaction::with('client.user')->orderBy('total','desc')->take(5)->get();
        return [
            'stats' => [
                'clients_count' => $clients_count,
                'providers_count' => $providers_count,
                'products_count' => $products_count,
                'transactions_count' => $transactions_count,
            ],
            'top_clients_transactions' => $top_clients_transactions,
            'top_clients_spending' => $top_clients_spending,
            // 'top_products_sales2' => $top_products_sales2,
            'top_products_sales' => $top_products_sales,
            'top_traansactions_sales' => $top_traansactions_sales,
        ];
    }
}
