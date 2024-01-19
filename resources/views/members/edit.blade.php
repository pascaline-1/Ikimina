@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Members List</h2>
            <!-- Display your members table here -->
            @if(count($members) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $index=>$mem)
                    <tr>
                        <td>{{ ($index+1) }}</td>
                        <td>{{ $mem->first_name }}</td>
                        <td>{{ $mem->last_name }}</td>
                        <td>{{ $mem->phone }}</td>
                        <td>{{ $mem->gender }}</td>
                        <td>{{ $mem->date_of_birth }}</td>
                        <td>
                            <a href="{{ route('members.edit', $mem->id) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No members found.</p>
            @endif
        </div>
        <div class="col-md-4">
            <h2>Edit Member</h2>
            <form action="{{ route('members.update', $member->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name:</label>
                    <input type="text" name="first_name" class="form-control" value="{{ $member->first_name }}" required>
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name:</label>
                    <input type="text" name="last_name" class="form-control" value="{{ $member->last_name }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="text" name="phone" class="form-control" value="{{ $member->phone }}" required>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender:</label>
                    <select name="gender" class="form-select" required>
                        <option value="Male" {{ $member->gender === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $member->gender === 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ $member->gender === 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth:</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ $member->date_of_birth }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Member</button>
            </form>
        </div>
    </div>
</div>
@endsection