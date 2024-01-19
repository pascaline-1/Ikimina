<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::with('member')
            ->orderBy('id', 'desc')
            ->get();

        $members = Member::all();

        return view('loans.index', compact('loans', 'members'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loans = Loan::orderBy('id', 'desc')->get();
        $members = Member::all();
        return view('loans.index', compact('loans', 'members'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:0',
            'interest' => 'required|numeric|min:0',
            'loan_date' => 'required|date',
            'pay_date' => 'required|date'
        ]);

        Loan::create($request->all());

        return redirect()->route('loans.index')->with('success', 'Loan added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        $loans = Loan::with('member')
            ->orderBy('id', 'desc')
            ->get();

        $members = Member::all();
        return view('loans.edit', compact('loans', 'loan', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        // Step 1: Validation
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:0',
            'interest' => 'required|numeric|min:0',
            'loan_date' => 'required|date',
            'pay_date' => 'required|date'
        ]);

        // Step 2: Retrieve loan
        // The $loan variable is already resolved using model binding

        // Step 3: Update loan
        $loan->update([
            'member_id' => $request->input('member_id'),
            'amount' => $request->input('amount'),
            'interest' => $request->input('interest'),
            'loan_date' => $request->input('loan_date'),
            'pay_date' => $request->input('pay_date'),
        ]);

        // Step 4: Redirect
        return redirect()->route('loans.index')->with('success', 'Loan updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Loan deleted successfully!');
    }
}
