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
        <h3>PROCESSES</h3>
    </div>
    <div class="btn-action">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProcessModal">Add New Process</button>
    </div>
    <table id="example" class="data-table" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Process name</th>
                <th>Description</th>
                <th>Department</th>
                <th>Created on</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($processes as $proc)
            <tr>
                <td>{{$proc->id}}</td>
                <td>{{$proc->name}}</td>
                <td>{{$proc->description}}</td>
                <td>{{$proc->department->name}}</td>
                <td>{{$proc->created_at->format('d/m/Y') }}</td>
                <td style = "display:flex;">
                    <!-- Show details button -->
                    <button type="button" class="btn btn-lg btn-outline-primary" data-bs-toggle="modal" data-bs-target="#showProcessModal{{ $proc->id }}"><i class="bi bi-eye"></i></button>
                        <!-- Modal show details -->
                        <div class="modal fade" id="showProcessModal{{ $proc->id }}" tabindex="-1" aria-labelledby="showProcessModalLabel{{ $proc->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showProcessModalLabel{{ $proc->id }}">Details of: {{ $proc->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name{{ $proc->id }}" class="form-label">Product Name</label>
                                            <input type="text" class="form-control" id="name {{ $proc->id }}" name="name" value="{{ $proc->name }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="col-form-label">Description:</label>
                                            <textarea class="form-control" id="description" name="description" disabled>{{ $proc -> description }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="cate_id{{ $proc->id }}" class="form-label">Dept Name</label>
                                            <input type="text" class="form-control" id="cate_id {{ $proc->id }}" name="cate_id" value="{{ $proc->department->name }}" disabled>
                                        </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Edit button -->
                    <button type="button" class="btn btn-lg btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editProcessModal{{ $proc->id }}"><i class="bi bi-pen"></i></button>
                        <!-- Modal Edit Process -->
                        <div class="modal fade" id="editProcessModal{{ $proc->id }}" tabindex="-1" aria-labelledby="editProcessModalLabel{{ $proc->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProcessModalLabel{{ $proc->id }}">Edit Process: {{ $proc->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{ route('processes.update', $proc->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="name{{ $proc->id }}" class="form-label">Process Name</label>
                                            <input type="text" class="form-control" id="name {{ $proc->id }}" name="name" value="{{ $proc->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="col-form-label">Description:</label>
                                            <textarea class="form-control" id="description" name="description">{{ $proc->description }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="dept_id" class="form-label">Department</label>
                                            <select class="form-select" aria-label="Default select example" name="dept_id" id="dept_id">
                                                @foreach ($departments as $dep)
                                                    <option value="{{ $dep->id }}" {{ $proc->dept_id == $dep->id ? 'selected' : '' }}>{{ $dep->name }}</option>
                                                @endforeach
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
                    <form action="{{ route('processes.destroy', $proc->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this process?');">
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
<!-- Model add new Product -->
<div class="modal fade" id="addProcessModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add new Product</h4>       
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <form action = {{ route('processes.store') }} method="post">
            @csrf
          <div class="form-group">
            <label for="name" class="col-form-label">Process Name:</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group">
            <label for="description" class="col-form-label">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
          </div>
          <div class="form-group">
            <label for="dept_id" class="col-form-label">Department:</label>
            <select class="form-select" aria-label="Default select example" name="dept_id" id="dept_id">
                <option selected>---Select Department---</option>
                @foreach ($departments as $dept)
                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                @endforeach
            </select>
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
@endsection



