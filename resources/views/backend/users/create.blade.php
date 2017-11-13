@extends('backend.layout.main')

@section('title', __('Users Create Page'))

@section('content')
<div class="content-wrapper">
  <div class="box box-primary">
            <div >
              <h3 >{{ __('Users Create') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
              {{ csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="fullname">{{ __('Fullname') }}</label>
                  <input type="text" class="form-control {{ $errors->has('fullname') ? ' has-error' : '' }}" id="fullname" name="fullname" placeholder="{{ __('Enter your name') }}">
                  <small class="text-danger">{{ $errors->first('fullname') }}</small>
                </div>
                 <div class="form-group">
                  <label for="email">{{ __('Email address') }}</label>
                  <input type="email" class="form-control {{ $errors->has('email') ? ' has-error' : '' }}" id="email" name="email" placeholder="{{ __('Enter email') }}">
                  <small class="text-danger">{{ $errors->first('email') }}</small>
                </div>
                <div class="form-group">
                  <label for="password">{{ __('Password') }}</label>
                  <input type="password" class="form-control {{ $errors->has('password') ? ' has-error' : '' }}" id="password" name="password" placeholder="{{ __('Enter password') }}">
                  <small class="text-danger">{{ $errors->first('password') }}</small>
                </div>
                <div class="form-group">
                  <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                  <input type="password" class="form-control {{ $errors->has('confirm-password') ? ' has-error' : '' }}" id="password_confirmation" name="password_confirmation" placeholder="{{ __('Retype password') }}">
                  <small class="text-danger">{{ $errors->first('confirm-password') }}</small>
                </div>
                <div class="form-group">
                  <label>{{ __('BirthDay') }}:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control {{ $errors->has('birthday') ? ' has-error' : '' }}" name="birthday">
                  </div>
                   <small class="text-danger">{{ $errors->first('birthday') }}</small>
                  <!-- /.input group -->
                </div>
                {{-- address --}}
                <div class="form-group">
                  <label>{{ __('Address') }}:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-map"></i>
                    </div>
                    <input type="text" class="form-control {{ $errors->has('address') ? ' has-error' : '' }}" name="address">
                  </div>
                   <small class="text-danger">{{ $errors->first('address') }}</small>
                  <!-- /.input group -->
                </div>
                <!-- phone mask -->
                <div class="form-group">
                  <label>{{ __('Phone') }}:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </div>
                    <input type="text" class="form-control {{ $errors->has('phone') ? ' has-error' : '' }}" name="phone">
                  </div>
                   <small class="text-danger">{{ $errors->first('phone') }}</small>
                  <!-- /.input group -->
                </div>
                <div class="form-group ">
                  <label for="image">{{ __('File input')}}</label>
                  <input type="file" id="image" name="image">
                </div>
                <div class="form-group">
                  <label>
                    <label for="admin">Admin</label>
                    <input type="radio" id="admin" class="flat-red" name="is_admin" checked value="{{App\Model\User::ROLE_ADMIN}}">
                  </label>
                  <label>
                    <label for="user">User</label>
                    <input type="radio" id="user" class="flat-red" name="is_admin" value="{{App\Model\User::ROLE_USER}}">
                  </label>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">{{ __('Submit') }}</button>
                <a href="{{ route('user.index') }}" class="btn btn-default pull-left">{{ __('Back') }}</a>
                <button type="reset" class="btn btn-warning pull-left btn-reset">{{ __('Reset') }}</button>
              </div>
            </form>
          </div>
          <div class="row"></div>
</div>
@endsection