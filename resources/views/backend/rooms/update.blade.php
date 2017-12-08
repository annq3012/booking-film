@extends('backend.layout.main')

@section('title', __('Rooms Update Page'))

@section('content')
<div class="content-wrapper">
  <div class="box box-primary">
            <div>
              <h3 class="h-title" >{{ __('Rooms Update') }}</h3>
              @include('flash::message')
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('rooms.update', $room) }}">
              {{ csrf_field()}}
              {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">{{ __('Room') }}</label>
                  <input type="text" class="form-control {{ $errors->has('name') ? ' has-error' : '' }}" id="name" name="name" placeholder="{{ __('Enter name of room') }}" value="{{ old('name',$room->name) }}">
                  <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>
                <div class="form-group">
                  <label for="type">{{ __('Type of Room:') }}</label>
                  <select name="type" id="type" class="{{ $errors->has('type') ? ' has-error' : '' }}">
                  @foreach (config('image.technologies') as $type => $value)
                   <option value="{{ $value }}" {{$value == old('type', $room->type )? 'selected' : ''}}>{{$type}}</option>
                  @endforeach
                  </select>
                  <small class="text-danger">{{ $errors->first('type') }}</small>
                </div>
                <div class="form-group">
                  <label for="cinema_id">{{ __('Cinemas:') }}</label>
                  <select name="cinema_id" id="cinema_id" class="form-group {{ $errors->has('cinema_id') ? ' has-error' : '' }}">
                    @foreach ($cinemas as $cinema)
                    <option value="{{$room->cinema_id}}">{{ $cinema->name }}</option>
                    @endforeach
                  </select>
                  <small class="text-danger">{{ $errors->first('cinema_id') }}</small>
                </div>
                <div class="form-group">
                  <label>{{ __('Max Seats Rows') }}:</label>
                  <div class="input-group">
                    <div class="col-md-8">
                      <input type="text" class="form-control pull-left {{ $errors->has('max_seats_update') ? ' has-error' : '' }}" name="max_seats" id="max_seats_update" value="{{ old('max_seats', $room->max_seats) }}">
                    </div>
                    <div class="col-md-1">
                      <button type="button" id="btn-update-seats" name="btn-update-seats" class="s-15 pull-right">
                        <span class="fa fa-plus-circle"></span>
                      </button>
                    </div>
                    <div class="message" ><small> {{ __('Max Seats is not equal 10') }} </small></div>
                  </div>
                   <small class="text-danger">{{ $errors->first('max_seats') }}</small>
                </div>
                <div class="form-group">
                  <label> {{ __('Seats Rows') }}</label>
                  <div id="list_seats" class="list_seats">
                    @foreach ($seats as $seat)
                      <div>
                        <span>{{$seat->y_axist}}</span>
                        <select name="seats[]" class="fs seats">
                        @for ($i = $seatValue['min'] ; $i <= $seatValue['max'] ; $i++)
                          <option value="{{$i}}"  {{$i == $seat->count_seats ? 'selected' : ''}}>{{$i}}</option>
                        @endfor
                        </select>
                        <select class="fs type">
                          @foreach (config('image.type_seat') as $type => $value)
                           <option value="{{$type}}" {{$type == $seat->type ? 'selected' : ''}}>{{$value}}</option>
                          @endforeach
                        </select>
                      </div>
                    @endforeach
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