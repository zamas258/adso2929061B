@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Select a Pet to Adopt!</h3>
                </div>

                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('customer.makeadoption') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="pet_id" class="form-label">Choose a pet</label>
                            <select name="pet_id" id="pet_id" class="form-control" required>
                                <option value="">-- Select a pet --</option>
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->id }}">
                                        {{ $pet->name }} - {{ $pet->bread }} ({{ $pet->kind }}) - {{ $pet->age }} years
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <div class="alert alert-info">
                                <strong>Note:</strong>
                                <ul class="mb-0 mt-2">
                                    <li>You can adopt a maximum of 3 pets</li>
                                    <li>Your adoption request will be processed immediately</li>
                                    <li>Once adopted, the pet will be marked as adopted</li>
                                </ul>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Adoption Request</button>
                        <a href="{{ route('customer.listpets') }}" class="btn btn-secondary">View Available Pets</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection