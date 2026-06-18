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
            'bank_name' => 'required|string|max:255',
            'account_holder' => 'required|string|max:255',
            'transfered_at' => 'required|date',
            'proof_image' => 'nullable|image|max:2048',
            'notes' => 'nullable|string|max:255',
        ]);

        $data = [
            'lender_id' => auth()->id(),
            'amount' => $validated['amount'],
            'bank_name' => $validated['bank_name'],
            'account_holder' => $validated['account_holder'],
            'transfered_at' => $validated['transfered_at'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ];

        if ($request->hasFile('proof_image')) {
            $data['proof_image'] = $request->file('proof_image')->store('topups/proof', 'public');
        }

        Topup::create($data);

        return redirect()->route('lender.wallet.index')
            ->with('success', 'Permintaan topup berhasil dikirim.');
    }
}
