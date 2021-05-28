@extends('layouts.app')

@section('page-header')

<div class="page-header">
    <div class="page-leftheader">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('groups') }}">
                    <i class="fe fe-users mr-2 fs-14"></i> List
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="javascript:void(0)">New Group</a>
            </li>
        </ol>
        <h4 class="page-title mb-0">Groups</h4>
    </div>
    <div class="page-rightheader">
        <div class="btn btn-list">
            
        </div>
    </div>
</div>

@endsection

@section('content')

<form action="{{ route('groups.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">General Info</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 form-group">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 form-group">
                            <div class="custom-controls-stacked">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="active" value="1">
                                    <span class="custom-control-label">Active</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Permissions</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-6 form-group">
                                <div class="custom-controls-stacked">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="permission_ids[]" value="{{ $permission->id }}">
                                        <span class="custom-control-label">{{ $permission->name }}</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap" id="users-table">
                            <thead>
                                <tr>
                                    <th class="wd-5 border-bottom-0">
                                        <input type="checkbox" class="" name="" id="checkall">
                                    </th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Email</th>
                                    <th class="border-bottom-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="" name="user_ids[]" value="{{ $user->id }}">
                                        </td>
                                        <td>{{ $user->fullname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>@include('partials.status', ['status' => $user->status])</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">
                            <i class="fe fe-save mr-1"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('css')
    <!-- Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}"  rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('js')
    <!-- INTERNAL Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.js')}}"></script>

    <script>
        $('#users-table').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_',
            }
        })

        $('#checkall').click(function () {
            let checked = $(this).prop('checked')

            $('input[name="user_ids[]"]').each(function () {
                $(this).prop('checked', checked)
            })
        })
    </script>
@endsection