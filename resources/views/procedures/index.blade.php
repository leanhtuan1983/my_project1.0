@extends('layouts.app-dashboard')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/topbar.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/data-table.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

@endsection
@section('content')
<div class="table-content">
    <div class="table-title">
        <h3>PROCEDURES</h3>
    </div>
    <div class="btn-action">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProcedureModal">Add New Procedure</button>
    </div>
    <table id="example" class="data-table" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Procedure name</th>             
                <th>Description</th>
                <th>Created on</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($procedures as $procedure)
            <tr>
                <td>{{$procedure->id}}</td>
                <td>{{$procedure->name}}</td>
                <td>{{$procedure->description}}</td>
                <td>{{$procedure->created_at->format('d/m/Y') }}</td>
                <td style = "display:flex;">
                    <!-- Show details button -->
                    <a href="{{ route('procedures.show',$procedure->name) }}"  class="btn btn-lg btn-outline-primary"><i class="bi bi-eye"></i></a>

                    <!-- Edit button -->
                    <button type="button" class="btn btn-lg btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $procedure->id }}"><i class="bi bi-pen"></i></button>
                        <!-- Modal Edit Product -->
                        <div class="modal fade" id="editProductModal{{ $procedure->id }}" tabindex="-1" aria-labelledby="editProductModalLabel{{ $procedure->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editCategoryModalLabel{{ $procedure->id }}">Edit Product: {{ $procedure->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{ route('products.update', $procedure->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="name{{ $procedure->id }}" class="form-label">Product Name</label>
                                            <input type="text" class="form-control" id="name {{ $procedure->id }}" name="name" value="{{ $procedure->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="cate_id" class="form-label">Category</label>
                                            <select class="form-select" aria-label="Default select example" name="cate_id" id="cate_id">
                                              
                                            </select>
                                        </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Delete button -->
                    <form action="{{ route('products.destroy', $procedure->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-lg btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
</div>
<!-- Model add new Procedure -->
<div class="modal fade" id="addProcedureModal">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add new Procedure</h4>       
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <form action = {{ route('procedures.store') }} method="post">
            @csrf
          <div class="form-group">
            <label for="name" class="col-form-label">Procedure Name:</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control"></textarea>
          <div class="form-group">
          <div class="container mt-5">
            <div class="row">
            @foreach($processes as $dept => $processData)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $processData->first()->department->name }}</h5>
                        </div>
                        <div class="card-body">
                        @if($processData->isEmpty())
                            <p>Không có process nào trong danh mục này.</p>
                        @else
                            @foreach($processData as $item)
                                <div>
                                    <input type="checkbox" name="process_id[]" value="{{ $item->id }}"><label>{{ $item->name }}</label>
                                </div>
                            @endforeach
                        @endif
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        </div>
    <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Confirm</button>
        </div>
    </form>  
    </div>       
</div>
</div>
</div>

@endsection
@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Thêm jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Thêm DataTables JavaScript -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="{{ asset('assets/js/data-table.js') }}"></script>
><script>
      $(document).ready(function() {
            $('#addInput').click(function() {
                $('#dynamicInput').append('<div class="input-group"><input type="text" name="data[]" placeholder="Nhập dữ liệu" required><button type="button" class="removeInput">Xóa</button></div>');
            });

            $(document).on('click', '.removeInput', function() {
                $(this).parent().remove();
            });
        });
</script>
@endsection







