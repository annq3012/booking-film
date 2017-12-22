@extends('backend.layout.main')

@section('title', __('Users Update Page'))

@section('content')
<div class="content-wrapper">
  <div class="box box-primary">
            <div >
              <h3 class="h-title">{{ __('Users Update') }}</h3>
              @include('flash::message')
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('users.update', $user->id ) }}" enctype="multipart/form-data">
              {{ csrf_field()}}
              {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group">
                  <label for="fullname">{{ __('Fullname') }}</label>
                  <input type="text" class="form-control {{ $errors->has('fullname') ? ' has-error' : '' }}" id="fullname" name="fullname" value="{{ old('fullname', $user->fullname) }}">
                  <small class="text-danger">{{ $errors->first('fullname') }}</small>
                </div>
                 <div class="form-group">
                  <label for="email">{{ __('Email address') }}</label>
                  <input type="email" class="form-control {{ $errors->has('email') ? ' has-error' : '' }}" id="email" name="email" value="{{ $user->email }}" readonly>
                  <small class="text-danger">{{ $errors->first('email') }}</small>
                </div>
                <div class="form-group">
                  <label for="password">{{ __('Password') }}</label>
                  <input type="password" class="form-control {{ $errors->has('password') ? ' has-error' : '' }}" id="password" name="password" placeholder="{{ __('Enter your password you want to change') }}">
                  <small class="text-danger">{{ $errors->first('password') }}</small>
                </div>
                <div class="form-group">
                  <label>{{ __('BirthDay') }}:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control {{ $errors->has('birthday') ? ' has-error' : '' }}" name="birthday" value="{{ old('birthday', $user->birthday) }}">
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
                    <input type="text" class="form-control {{ $errors->has('address') ? ' has-error' : '' }}" name="address" value="{{ old('address', $user->address) }}">
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
                    <input type="text" class="form-control {{ $errors->has('phone') ? ' has-error' : '' }}" name="phone" value="{{ old('phone', $user->phone) }}">
                  </div>
                   <small class="text-danger">{{ $errors->first('phone') }}</small>
                  <!-- /.input group -->
                </div>
                <div class="form-group ">
                  <label for="image">{{ __('File input')}}</label>
                  <input type="file" id="image" name="image" value="{{$user->image}}">
                </div>
                <div class="form-group">
                  @if ($user->is_admin == $role['admin'])
                  <span class="btn btn-warning">Admin</span>
                  @else
                    <span class="btn btn-default">User</span>
                  @endif
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">{{ __('Submit') }}</button>
                <a href="{{ route('users.index') }}" class="btn btn-default pull-left">{{ __('Back') }}</a>
                <button type="reset" class="btn btn-warning pull-left btn-reset">{{ __('Reset') }}</button>
              </div>
            </form>
          </div>
          <div class="row"></div>
</div>
@endsection