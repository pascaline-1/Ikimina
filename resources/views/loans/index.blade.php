@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Loans List</h2>
    <!-- Bootstrap notification for success message -->
    @if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
    @endif

    <div class="row mt-3">
        <div class="col-md-8">
            <!-- loan List Table -->
            @if(count($loans) > 0)
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Member</th>
                        <th>Amount</th>
                        <th>Interest</th>
                        <th>Loan Date</th>
                        <th>Pay Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loans as $index=>$loan)
                    <tr>
                        <td>{{ ($index+1) }}</td>
                        <td>
                            @if($loan->member)
                            {{ $loan->member->first_name }} {{ $loan->member->last_name }}
                            @else
                            Member not found
                            @endif
                        </td>
                        <td>{{ $loan->amount }}</td>
                        <td>{{ $loan->interest }}%</td>
                        <td>{{ $loan->loan_date }}</td>
                        <td>{{ $loan->pay_date }}</td>
                        <td>
                            <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('loans.destroy', $loan->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No loans found.</p>
            @endif
        </div>

        <div class="col-md-4">
            <!-- loan Form -->
            <h3>Add Loan</h3>
            <form action="{{ route('loans.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="member_id" class="form-label">Member:</label>
                    <select name="member_id" class="form-select" required>
                        @foreach($members as $member)
                        <option value="{{ $member->id }}">{{ $member->first_name }} {{ $member->last_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount:</label>
                    <input type="number" name="amount" class="form-control" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="interest" class="form-label">Interest(%):</label>
                    <input type="number" name="interest" class="form-control" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="loan_date" class="form-label">Loan Date:</label>
                    <input type="date" name="loan_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="pay_date" class="form-label">Pay Date:</label>
                    <input type="date" name="pay_date" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Add Loan</button>
            </form>
        </div>
    </div>
</div>
@endsection