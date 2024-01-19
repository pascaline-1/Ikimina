@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Contributions List</h2>
    <!-- Bootstrap notification for success message -->
    @if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
    @endif

    <div class="row mt-3">
        <div class="col-md-8">
            <!-- Contribution List Table -->
            @if(count($contributions) > 0)
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Member</th>
                        <th>Amount</th>
                        <th>Contribution Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contributions as $index=>$contribution)
                    <tr>
                        <td>{{ ($index+1) }}</td>
                        <td>
                            @if($contribution->member)
                            {{ $contribution->member->first_name }} {{ $contribution->member->last_name }}
                            @else
                            Member not found
                            @endif
                        </td>
                        <td>{{ $contribution->amount }}</td>
                        <td>{{ $contribution->contribution_date }}</td>
                        <td>
                            <a href="{{ route('contributions.edit', $contribution->id) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('contributions.destroy', $contribution->id) }}" method="post" class="d-inline">
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
            <p>No contributions found.</p>
            @endif
        </div>

        <div class="col-md-4">
            <!-- Contribution Form -->
            <h3>Add Contribution</h3>
            <form action="{{ route('contributions.store') }}" method="post">
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
                    <label for="contribution_date" class="form-label">Contribution Date:</label>
                    <input type="date" name="contribution_date" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Add Contribution</button>
            </form>
        </div>
    </div>
</div>
@endsection