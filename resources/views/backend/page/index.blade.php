@extends('backend.layouts.app')

@section('style')
    <link href="{{ asset('/admin/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet"
          type="text/css"/>
@endsection

@section('title')
    Manage Pages
@endsection

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ route('post.index') }}">Pages</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>All</span>
                    </li>
                </ul>
            </div>

            <h3 class="page-title"> Pages</h3>

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
                                        <a class="btn sbold blue" href="{{ route('page.create') }}"> Add Page
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                   id="data-page">
                                <thead>
                                <tr>
                                    <th> ID</th>
                                    <th> Information</th>
                                    <th> Created At</th>
                                    <th> Status</th>
                                    <th> Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(!empty($pages))
                                    @foreach($pages as $i)
                                        <tr class="odd gradeX">
                                            <td> {{ $i->id }}</td>
                                            <td>
                                                <p class="font-red-mint">{{ $i->name }}</p>
                                            </td>
                                            <td>{{ $i->created_at }}</td>
                                            <td>
                                                @if($i->status === 1)
                                                    <span class="badge badge-info badge-roundless"> Approved </span>
                                                @else
                                                    <span class="badge badge-warning badge-roundless"> No </span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('page.destroy', $i->id) }}" method="POST">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <a href="{{ route('page.edit', ['page' => $i->id]) }}"
                                                       class="btn red btn-sm">Update</a>
                                                    <button type="button" class="btn red btn-sm btn-delete">Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

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
            pageDatatable('#data-page');
            confirmBeforeDelete('#data-page', 'If you delete, all child category has been deleted');
        });

    </script>
@endsection