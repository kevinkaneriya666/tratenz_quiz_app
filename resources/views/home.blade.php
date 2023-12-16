@extends('layouts.app')

@push('style')
    <link href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" />
@endpush

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
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4 text-start">
                                    <a href="{{ route('make_quiz') }}" class="lead text-success">Make Quiz</a>
                                </div>
                                <div class="col-lg-4">
                                </div>
                                <div class="col-lg-4 text-end">
                                    <button type="button" class="btn btn-info"  data-bs-toggle="modal" data-bs-target="#myModal">Upload Questions</button>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-lg-12 mb-5">
                                    <select class="form-control" id="category_drop">
                                        <option value="">Select Category...</option>
                                        {{-- @forelse($categories as $key => $value)
                                            <option value="{{ $value }}">{{ $value }}</option>                                            
                                        @empty
                                            
                                        @endforelse                                         --}}
                                        <option value="Math">Math</option>
                                        <option value="Science">Science</option>
                                        <option value="English">English</option>
                                    </select>
                                </div>
                                <table class="table table-striped" id="questions">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Question</th>
                                            <th>Answer 1</th>
                                            <th>Answer 2</th>
                                            <th>Answer 3</th>
                                            <th>Answer 4</th>
                                            <th>Mark</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                            
                                <div class="modal-header">
                                    <h4 class="modal-title"> Upload CSV File</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                    
                                <div class="modal-body">
                                    <form action="{{ route('upload_csv') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="mb-3 mt-3">
                                            <label for="file" class="form-label">CSV:</label>
                                            <input type="file" class="form-control" id="file" name="file">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                    
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(function () {
            $('#category_drop').select2();

            var table;
            table = $('#questions').DataTable({
                processing: true,
                serverSide: true,
                bFilter: true,
                ajax: "{{ route('datatables') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false,searchable: false},
                    {data: 'category', name: 'category'},
                    {data: 'question', name: 'question'},
                    {data: 'answer_1', name: 'answer_1'},
                    {data: 'answer_2', name: 'answer_2'},
                    {data: 'answer_3', name: 'answer_3'},
                    {data: 'answer_4', name: 'answer_4'},
                    {data: 'marks', name: 'marks'},                    
                ]
            });

            $('#category_drop').change(function(e){
                e.preventDefault();                
                table.search($(this).val()).draw();
            });
            
        });
    </script>
@endpush