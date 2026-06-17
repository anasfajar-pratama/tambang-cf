<?php

namespace App\Http\Controllers\Lender;

use App\Http\Controllers\Controller;
use App\Models\Topup;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WalletController extends Controller
{
    public function index(): View
    {
        $wallet = auth()->user()->lenderWallet;
        $topups = auth()->user()->topups()->latest()->get();

        return view('lender.wallet', compact('wallet', 'topups'));
    }

    public function requestTopup(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:10000',
            'notes' => 'nullable|string|max:255',
        ]);

        Topup::create([
            'lender_id' => auth()->id(),
            'amount' => $validated['amount'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('lender.wallet.index')
            ->with('success', 'Permintaan topup berhasil dikirim.');
    }
}
