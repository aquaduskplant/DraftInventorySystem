<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    public function index()
    {
        $movements = StockMovement::with(['product', 'user'])
            ->latest()
            ->paginate(15);

        return view('stock.index', compact('movements'));
    }

    public function createIn(Product $product)
    {
        return view('stock.in', compact('product'));
    }

    public function storeIn(Request $request, Product $product)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
            'note'     => 'nullable|string|max:255',
        ]);

        $product->increment('quantity', $data['quantity']);

        StockMovement::create([
            'product_id'    => $product->id,
            'user_id'       => $request->user()->id,
            'movement_type' => 'in',
            'quantity'      => $data['quantity'],
            'note'          => $data['note'] ?? null,
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Stock added successfully.');
    }

    public function createOut(Product $product)
    {
        return view('stock.out', compact('product'));
    }

    public function storeOut(Request $request, Product $product)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
            'note'     => 'nullable|string|max:255',
        ]);

        if ($product->quantity < $data['quantity']) {
            return back()
                ->withErrors(['quantity' => 'Not enough stock.'])
                ->withInput();
        }

        $product->decrement('quantity', $data['quantity']);

        StockMovement::create([
            'product_id'    => $product->id,
            'user_id'       => $request->user()->id,
            'movement_type' => 'out',
            'quantity'      => $data['quantity'],
            'note'          => $data['note'] ?? null,
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Stock removed successfully.');
    }
}
