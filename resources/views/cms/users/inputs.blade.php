<div class="box box-primary">
    <div class="box-header with-border" >
        <h3 class="box-title" v-if="saveButton"> @lang('cms.create_new_user')</h3>
        <h3 class="box-title" v-if="updateButton"> @lang('cms.update_user')</h3>
        <div class="box-tools pull-right">
            <a class="btn bg-navy btn-sm" @click="closePanelInputs"><i class="fa fa-chevron-left"></i> @lang('cms.back')</a>
            <a class="btn btn-success btn-sm" v-show="saveButton" @click="setData"><i class="fa fa-floppy-o"></i> @lang('cms.save')</a>
            <a class="btn btn-success btn-sm" v-show="updateButton" @click="updateData"><i class="fa fa-floppy-o"></i> @lang('cms.update')</a>
        </div>
    </div>
</div>

{{-- Upload Progress Bar --}}
<vprogress :progress="uploadProgress"></vprogress>

{{-- Form Errros --}}
<formerrors :errorsbag="errores"></formerrors>

<!-- VueLoading icon -->
<div class="text-center"><i v-show="loadingSave" class="fa fa-spinner fa-spin fa-5x"></i></div>

<div class="row" v-show="!loadingSave">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">

                {{-- name --}}
                <div class="form-group">
                    <label for="name">@lang('cms.name')</label>
                    <input id="name" type="text" class="form-control" 
                    placeholder="{{trans('cms.name')}}" v-model="user.name" 
                    :class="formError(errores, 'name', 'inputError')">
                </div>

                {{-- email --}}
                <div class="form-group">
                    <label for="email">@lang('cms.email')</label>
                    <input id="email" type="email" class="form-control" 
                    placeholder="{{trans('cms.email')}}" v-model="user.email"
                    :class="formError(errores, 'email', 'inputError')">
                </div>

                {{-- type --}}
                <div class="form-group">
                    <label>@lang('cms.type')</label>
                    <select class="form-control" v-model="user.type" :class="formError(errores, 'type', 'inputError')">
                        <option v-for="ut in userTypes" :value="ut.value">@{{ut.text}}</option>
                    </select>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">

                <div class="text-center"><i v-show="loadingPassword" class="fa fa-spinner fa-spin fa-4x"></i></div>

                {{-- password --}}
                <div class="form-group" v-show="!loadingPassword">
                    <label for="password">@lang('cms.password')</label>
                    <input id="password" type="password" class="form-control" 
                    placeholder="{{trans('cms.password')}}" v-model="user.password"
                    :class="formError(errores, 'password', 'inputError')">
                </div>

                {{-- confirm_password --}}
                <div class="form-group" v-show="!loadingPassword">
                    <label for="confirm_password">@lang('cms.passowrd_confirmation')</label>
                    <input id="confirm_password" type="password" class="form-control" 
                    placeholder="{{trans('cms.passowrd_confirmation')}}" v-model="user.password_confirmation"
                    :class="formError(errores, 'password_confirmation', 'inputError')">
                </div>

                <div v-show="!loadingPassword">
                    <a class="btn btn-warning btn-sm" v-show="updateButton" 
                    @click="updatePassword"><i class="fa fa-refresh"></i> @lang('cms.reset_password')</a>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="box box-primary" v-show="!loadingSave">
    <div class="box-header with-border" >
        <h3 class="box-title"> Avatar</h3>
    </div>

    <div class="box-body">
        {{-- avatar --}}
        <imageupload v-model="user.avatar"></imageupload>
    </div>
</div>