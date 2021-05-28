@extends('layouts.app')

@section('page-header')

<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">Groups</h4>
    </div>
    <div class="page-rightheader">
        <div class="btn btn-list">
            <a href="{{ route('groups.create') }}" class="btn btn-info">
                <i class="fe fe-plus-circle mr-1"></i> New Group
            </a>
        </div>
    </div>
</div>

@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-4 offset-md-8">
                            <div class="input-group">
                                <input class="form-control" name="search" id="search" placeholder="Search..." value="{{ Request::get('search') }}">
                                @if (Request::get('search'))
                                    <div class="input-group-append input-group-append-btn" onclick="resetSearchForm()">
                                        <div class="input-group-text bg-danger text-white">
                                            <i class="fe fe-x"></i>
                                        </div>
                                    </div>
                                @endif
                                <div class="input-group-append input-group-append-btn" onclick="submitSearchForm()">
                                    <div class="input-group-text">
                                        <i class="fe fe-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
                <div class="table-responsive">
                    <table class="table table-striped card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th># of Users</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($groups as $group)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $group->name }}</td>
                                    <td>{{ $group->users_count }}</td>
                                    <td>
                                        @if($group->active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="{{ route('groups.edit', $group) }}" class="btn btn-icon btn-primary">
                                                <i class="fe fe-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-icon btn-danger btn-delete"
                                                data-href="{{ route('groups.delete', $group) }}">
                                                <i class="fe fe-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <em>No record found...</em>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $groups->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
    </div>
</div>

<form action="" method="POST" id="form-delete">
    @csrf
    @method('delete')
</form>

@endsection

@section('css')
    <link href="{{URL::asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet" />
@endsection

@section('js')
    <script src="{{URL::asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>

    <script>
        function submitSearchForm()
        {
            $('form').submit()
        }

        function resetSearchForm()
        {
            $('input').each(function () {
                $(this).val('')
            })

            submitSearchForm()
        }

        $('.btn-delete').click(function () {
            let uri = $(this).data('href')
            
            swal({
                title: "Delete Group",
                text: "Are you sure to delete it? This action cannot be reverted.",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }, function (isConfirm) {
                if (isConfirm) {
                    let deleteForm = $('#form-delete')
                    deleteForm.attr('action', uri)
                    deleteForm.submit()
                }
            })
        })
    </script>
@endsection