<?php

namespace App\Livewire\Affiliate;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.affiliate')]
class Financials extends Component
{
    public function render()
    {
        $transactions = Transaction::whereUserId(Auth::user()->id)->latest()->paginate(10);
        return view('livewire.affiliate.financials', compact('transactions'));
    }
}
