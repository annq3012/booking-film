@extends('backend.layout.main')

@section('title', __('Rooms Create Page'))

@section('content')
<div class="content-wrapper">
  <div class="box box-primary">
            <div >
              <h3 class="h-title" >{{ __('Rooms Create') }}</h3>
              @include('flash::message')
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('rooms.store') }}">
              {{ csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="fullname">{{ __('Room') }}</label>
                  <input type="text" class="form-control {{ $errors->has('fullname') ? ' has-error' : '' }}" id="fullname" name="fullname" placeholder="{{ __('Enter name of room') }}" value="{{ old('fullname') }}">
                  <small class="text-danger">{{ $errors->first('fullname') }}</small>
                </div>
                <div class="form-group">
                  <label for="type">{{ __('Type of Room:') }}</label>
                  <select name="type" id="type" class="{{ $errors->has('type') ? ' has-error' : '' }}">
                  @foreach (App\Model\Room::$availableStatuses as $key => $value)
                   <option value="{{$value}}">{{$key}}</option>
                  @endforeach
                  </select>
                  <small class="text-danger">{{ $errors->first('type') }}</small>
                </div>
                <div class="form-group">
                  <label for="city">{{ __('Cities:') }}</label>
                  <select name="city" id="city" class="{{ $errors->has('city') ? ' has-error' : '' }}">
                  @foreach ($cinemas as $cinema)
                   <option value="{{$cinema->city->id}}">{{$cinema->city->city}}</option>
                  @endforeach
                  </select>
                  <small class="text-danger">{{ $errors->first('city') }}</small>
                </div>
                <div class="form-group">
                  <label for="cinema">{{ __('Cinemas:') }}</label>
                  <select name="cinema" id="cinema" class="{{ $errors->has('cinema') ? ' has-error' : '' }}">
                  @foreach ($cinemas as $cinema)
                   <option value="{{$cinema->id}}">{{$cinema->name}}</option>
                  @endforeach
                  </select>
                  <small class="text-danger">{{ $errors->first('cinema') }}</small>
                </div>
                <div class="form-group">
                  <label>{{ __('BirthDay') }}:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control {{ $errors->has('birthday') ? ' has-error' : '' }}" name="birthday" value="{{ old('birthday') }}">
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
                    <input type="text" class="form-control {{ $errors->has('address') ? ' has-error' : '' }}" name="address" value="{{ old('address') }}">
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
                    <input type="text" class="form-control {{ $errors->has('phone') ? ' has-error' : '' }}" name="phone" value="{{ old('phone') }}">
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
                <a href="{{ route('rooms.index') }}" class="btn btn-default pull-left">{{ __('Back') }}</a>
                <button type="reset" class="btn btn-warning pull-left btn-reset">{{ __('Reset') }}</button>
              </div>
            </form>
          </div>
          <div class="row"></div>
</div>
@endsection