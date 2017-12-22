@extends('backend.layout.main')

@section('title', __('Rooms Create Page'))

@section('content')
<div class="content-wrapper">
  <div class="box box-primary">
            <div>
              <h3 class="h-title" >{{ __('Rooms Create') }}</h3>
              @include('flash::message')
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('rooms.store') }}">
              {{ csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">{{ __('Room') }}</label>
                  <input type="text" class="form-control {{ $errors->has('name') ? ' has-error' : '' }}" id="name" name="name" placeholder="{{ __('Enter name of room') }}" value="{{ old('name') }}">
                  <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>
                <div class="form-group">
                  <label for="type">{{ __('Type of Room:') }}</label>
                  <select name="type" id="type" class="{{ $errors->has('type') ? ' has-error' : '' }}">
                  @foreach (config('image.technologies') as $technology => $value)
                   <option value="{{$value}}" {{$value == old('type')? 'selected' : ''}}>{{$technology}}</option>
                  @endforeach
                  </select>
                  <small class="text-danger">{{ $errors->first('type') }}</small>
                </div>
                <div class="form-group">
                  <label for="city">{{ __('Cities:') }}</label>
                  <select name="city" id="city" class="list-cities {{ $errors->has('city') ? ' has-error' : '' }}">
                    <option value="0">{{ __('Choose')}}</option>
                  @foreach ($cities as $city)
                   <option value="{{$city->id}} {{$city->id == old('city') ? 'selected' : ''}}">{{$city->city}}</option>
                  @endforeach
                  </select>
                  <small class="text-danger">{{ $errors->first('city') }}</small>
                </div>
                <div class="form-group">
                  <label for="cinema_id">{{ __('Cinemas:') }}</label>
                  <select name="cinema_id" id="cinema_id" class="form-group {{ $errors->has('cinema_id') ? ' has-error' : '' }}">
                    <option value="0">{{__('Choose')}}</option>
                  </select>
                  <small class="text-danger">{{ $errors->first('cinema_id') }}</small>
                </div>
                <div class="form-group">
                  <label>{{ __('Max Seats') }}:</label>
                  <div class="input-group">
                    <div class="col-md-8">
                      <input type="text" class="form-control pull-left {{ $errors->has('max_seats') ? ' has-error' : '' }}" name="max_seats" id="max_seats" value="{{ old('max_seats') }}">
                    </div>
                    <div class="col-md-1">
                      <button type="button" id="btn-add-seats" name="btn-add-seats" class="s-15 pull-right">
                        <span class="fa fa-plus-circle"></span>
                      </button>
                    </div>
                    <div class="message"><small style="color:red">Max Seats is not equal 10</small></div>
                  </div>
                   <small class="text-danger">{{ $errors->first('max_seats') }}</small>
                </div>
                <div class="form-group">
                  <label> {{ __('Max Seats Rows') }}</label>
                  <div id="list_seats">

                  </div>
                </div>
               <!-- /.box-body -->
             </div>
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