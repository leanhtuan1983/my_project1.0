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
        <h3>LOTS</h3>
    </div>
    <div class="btn-action">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Import Single Lot</button>
        <button type="button" class="btn btn-primary">Import Multiple Lots</button>
    </div>
    <table id="example" class="data-table" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Lot name</th>
                <th>Product name</th>
                <th>Created on</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lots as $lot)
            <tr>
                <td>{{$lot->id}}</td>
                <td>{{$lot->name}}</td>
                <td>{{$lot->products->name}}</td>
                <td>{{$lot->created_at->format('d/m/Y') }}</td>
                <td style = "display:flex;">
                <button type="button" class="btn btn-lg btn-outline-primary" data-bs-toggle="modal" data-bs-target="#showLotModal{{ $lot->id }}">Edit</button>
                <button type="button" class="btn btn-lg btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editLotModal{{ $lot->id }}">Edit</button>
                 <!-- Modal Edit Lot -->
                <div class="modal fade" id="editLotModal{{ $lot->id }}" tabindex="-1" aria-labelledby="editLotModalLabel{{ $lot->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editLotModalLabel{{ $lot->id }}">Edit Lot: {{ $lot->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="{{ route('lots.update', $lot->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name{{ $lot->id }}" class="form-label">Lot Name</label>
                                    <input type="text" class="form-control" id="name {{ $lot->id }}" name="name" value="{{ $lot->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Product Name</label>
                                    <select class="form-select" aria-label="Default select example" name="product_id" id="product_id">
                                                @foreach ($products as $data)
                                                    <option value="{{ $data->id }}" {{ $lot->product_id == $data->id ? 'selected' : '' }}>{{ $data->name }}</option>
                                                @endforeach
                                    </select>
                                </div>
                                <!-- Add more fields as needed -->
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
                <form action="{{ route('lots.destroy', $lot->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this lot?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-lg btn-outline-danger">Delete</button>
                </form>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
</div>
<!-- Model add new Category -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add new Lot</h4>       
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <form action = {{ route('lots.store') }} method="post">
            @csrf
          <div class="form-group">
            <label for="name" class="col-form-label">Lot Name:</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group">
            <label for="product_id" class="col-form-label">Product:</label>
            <select class="form-select" aria-label="Default select example" name="product_id" id="product_id">
                <option selected>---Select Product---</option>
                @foreach ($products as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
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



