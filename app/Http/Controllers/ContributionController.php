<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\Member;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contributions = Contribution::with('member')
            ->orderBy('id', 'desc')
            ->get();

        $members = Member::all();

        return view('contributions.index', compact('contributions', 'members'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contributions = Contribution::orderBy('id', 'desc')->get();
        $members = Member::all();
        return view('contributions.index', compact('contributions', 'members'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:0',
            'contribution_date' => 'required|date',
        ]);

        Contribution::create($request->all());

        return redirect()->route('contributions.index')->with('success', 'Contribution added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contribution $contribution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contribution $contribution)
    {
        $contributions = Contribution::with('member')
            ->orderBy('id', 'desc')
            ->get();

        $members = Member::all();
        return view('contributions.edit', compact('contributions', 'contribution', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contribution $contribution)
    {
        // Step 1: Validation
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:0',
            'contribution_date' => 'required|date',
        ]);

        // Step 2: Retrieve Contribution
        // The $contribution variable is already resolved using model binding

        // Step 3: Update Contribution
        $contribution->update([
            'member_id' => $request->input('member_id'),
            'amount' => $request->input('amount'),
            'contribution_date' => $request->input('contribution_date'),
        ]);

        // Step 4: Redirect
        return redirect()->route('contributions.index')->with('success', 'Contribution updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contribution $contribution)
    {
        $contribution->delete();
        return redirect()->route('contributions.index')->with('success', 'Contribution deleted successfully!');
    }
}
