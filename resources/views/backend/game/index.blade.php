@extends('backend.layouts.app')

@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.4/sweetalert2.min.css" type="text/css" />
    <link href="{{ asset('/admin/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet"
          type="text/css"/>
@endsection

@section('title')
    Manage Games
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
                        <a href="{{ route('game.index') }}">Games</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>All</span>
                    </li>
                </ul>
            </div>

            <h3 class="page-title"> Games</h3>

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
                                            <a class="btn sbold blue" href="{{ route('game.create') }}"> Add New
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                   id="data-games">
                                <thead>
                                <tr>
                                    <th> ID</th>
                                    <th> Information</th>
                                    <th class="data-middle"> Created At</th>
                                    <th class="data-middle"> Groups </th>
                                    <th class="data-middle"> Status</th>
                                    <th class="data-middle"> Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @include('backend.game._game', ['games' => $games, 'groups' => $groups])

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js" type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/global/plugins/datatables/datatables.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/scripts/posts.js') }}" type="text/javascript"></script>

    <script>
        $(function () {
            pageDatatable('#data-games');
            confirmBeforeDelete('#data-games');
        });

    </script>
@endsection