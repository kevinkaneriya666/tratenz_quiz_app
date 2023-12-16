@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row justify-content-center">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="row justify-content-center">
                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                            <p>{{ Session::get('error') }}</p>
                        </div>
                    @endif
                </div>
                <div class="row justify-content-center">
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
                </div>
                <div class="card">
                    <div class="card-header">
                        <span class="lead">{{ __('Create Quiz') }}</span>&nbsp;
                        <span><a href="{{ route('home') }}">Home</a></span>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('store') }}" method="post">
                            {{ csrf_field() }}
                            <select class="form-control" id="categories" name="category_id">
                                <option value="">Select Category...</option>
                                <option value="1">Math</option>
                                <option value="2">Science</option>
                                <option value="3">English</option>
                            </select>
                            <div class="mb-3 mt-3">
                                <label for="marks" class="form-label">Marks:</label>
                                <input type="number" step="1" class="form-control" id="marks" name="marks">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $('#categories').select2();
        });
    </script>    
@endpush