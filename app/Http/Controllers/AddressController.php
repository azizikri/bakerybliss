<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AddressController extends Controller
{
    use AuthorizesRequests;

    public function create()
    {
        return view('user.addresses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address_name' => 'required|string|max:255',
            'person_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'notes' => 'required|string|max:255',
        ]);

        Auth::user()->addresses()->create($validated);
        return redirect()->route('profile.edit')->with('success', 'Address created.');
    }

    public function edit(Address $address)
    {
        return view('user.addresses.edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        $validated = $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'is_primary' => 'sometimes|boolean',
        ]);

        $address->update($validated);
        return redirect()->route('profile.edit')->with('success', 'Address updated.');
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return redirect()->route('profile.edit')->with('success', 'Address deleted.');
    }
}
