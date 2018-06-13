@extends('backend.layouts.app')

@section('style')
    <link href="{{ asset('/admin/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet"
          type="text/css"/>
@endsection

@section('title')
    Manage Advertising
@endsection

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ route('admin.dashboard')  }}">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ route('advertising.index') }}">Advertising</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>All</span>
                    </li>
                </ul>
            </div>

            <h3 class="page-title"> Managed Advertising</h3>

            @include('backend.blocks.message')

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase"> Data</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <a class="btn sbold blue" href="{{ route('advertising.create') }}"> Add New
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                   id="data-advertising">
                                <thead>
                                <tr>
                                    <th> ID</th>
                                    <th> Name</th>
                                    <th> Show </th>
                                    <th> Location </th>
                                    <th> Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($ads as $i)
                                        <tr class="odd gradeX">
                                            <td> {{ $i->id }}</td>
                                            <td> {{ $i->name }}</td>
                                            <td> {{ $i->is_mobile == '0' ? 'PC' : 'Mobile' }}</td>
                                            <td> {{ $i->getLocation() }}</td>
                                            <td>
                                                <form action="{{ route('advertising.destroy', $i->id) }}"
                                                      method="POST">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <a href="{{ route('advertising.edit', ['advertising' => $i->id]) }}"
                                                       class="btn red btn-sm">Update</a>
                                                    <button type="button" class="btn red btn-sm btn-delete">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer')
    <script src="{{ asset('/admin/assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/global/plugins/datatables/datatables.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript"></script>

    <script>
        $(function () {
            pageDatatable('#data-advertising');
            confirmBeforeDelete('#data-advertising', 'If you delete, all child category has been deleted');
        });
    </script>
@endsection