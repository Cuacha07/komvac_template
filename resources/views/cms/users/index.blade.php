@extends('cms.master')

@section('content')
    <section class="content-header">
        <h1><i class="fa fa-users"></i> @lang('cms.users') </h1>
    </section>
    <section class="content" id="app" v-cloak>

        <div class="box box-primary" v-show="panelIndex">

            <div class="box-header">
                <h3 class="box-title"></h3>
                <div class="box-tools pull-right">
                    <a href="#" class="btn bg-navy" @click="openPanelInputs">
                        <i class="fa fa-plus-circle"></i> @lang('cms.create_new_user')
                    </a>
                </div>

                <filtersearch :selected="tipo" :options="tipos" @updatefilters="updateFilters"></filtersearch>

            </div>


            <div class="box-body">

                <!-- VueLoading icon -->
                <div class="text-center"><i v-show="loading" class="fa fa-spinner fa-spin fa-5x"></i></div>

                <div class="table-responsive" v-show="!loading">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>@lang('cms.name')</th>
                            <th>@lang('cms.email')</th>
                            <th>@lang('cms.type')</th>
                            <th>@lang('cms.blocked')</th>
                            <th>@lang('cms.user_since')</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users">
                            <td><img :src="public_url+user.avatar" class="img-rounded" style="width:32px; height:32px;"></td>
                            <td>@{{ user.name }}</td>
                            <td>@{{ user.email }}</td>
                            <td>
                                <span v-if="user.type == 'suadmin'" class="label label-success">@{{ user.type }}</span>
                                <span v-if="user.type == 'admin'" class="label label-primary">@{{ user.type }}</span>
                                <span v-if="user.type == 'editor'" class="label label-info">@{{ user.type }}</span>
                            </td>
                            <td>
                                <button v-if="user.blocked_at == null" @click="blockUser(user.id, true)" type="button" class="btn btn-sm btn-danger"> @lang('cms.block_user') </button>
                                <button v-else @click="blockUser(user.id, false)" type="button" class="btn btn-sm btn-success"> @lang('cms.unblock_user') </button>
                            </td>
                            <td>@{{ dateString2(user.created_at) }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" @click="openUpdateInputPanel(user.id)">
                                <i class="fa fa-refresh"></i> @lang('cms.edit_user')</button>
                                <button type="button" class="btn btn-sm btn-danger" @click="deleteUser(user.id)">
                                <i class="fa fa-trash"> @lang('cms.delete_user')</i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>

            <div class="box-footer clearfix">
                <pagination @setpage="getData" :param="pagination"></pagination>
            </div>
            
        </div>

        <div v-show="panelInputs">
            @include('cms.users.inputs')
        </div>

    </section>
@endsection

@push('scripts')
    @include('cms.users.script')
@endpush