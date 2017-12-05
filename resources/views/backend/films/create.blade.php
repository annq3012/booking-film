@extends('backend.layout.main')

@section('title', __('Films Create Page'))

@section('content')
<div class="content-wrapper">
  <div class="box box-primary">
            <div >
              <h3 class="h-title" >{{ __('Films Create') }}</h3>
              @include('flash::message')
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('films.store') }}" enctype="multipart/form-data">
              {{ csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="name">{{ __('Name') }}</label>
                  <input type="text" class="form-control {{ $errors->has('name') ? ' has-error' : '' }}" id="name" name="name" placeholder="{{ __('Enter your name') }}" value="{{ old('name') }}">
                  <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>
                 <div class="form-group pull-left">
                  <label for="language">{{ __('Language') }}</label>
                  <input type="text" class="form-control {{ $errors->has('language') ? ' has-error' : '' }}" id="language" name="language" placeholder="{{ __('Enter language') }}" value="{{ old('language') }}">
                  <small class="text-danger">{{ $errors->first('language') }}</small>
                </div>
                <div class="form-group pull-left ml-10">
                  <label for="actor">{{ __('Actor') }}</label>
                  <input type="text" class="form-control {{ $errors->has('actor') ? ' has-error' : '' }}" id="actor" name="actor" placeholder="{{ __('Enter actor') }}" value="{{ old('actor') }}">
                  <small class="text-danger">{{ $errors->first('actor') }}</small>
                </div>
                <div class="form-group pull-left ml-10">
                  <label for="director">{{ __('Director') }}</label>
                  <input type="text" class="form-control {{ $errors->has('director') ? ' has-error' : '' }}" id="director" name="director" placeholder="{{ __('Enter director') }}" value="{{ old('director') }}">
                  <small class="text-danger">{{ $errors->first('director') }}</small>
                </div>
                <div class="form-group pull-left ml-10">
                  <label for="duration">{{ __('Genre') }}</label>
                  <input type="text" class="form-control {{ $errors->has('genre') ? ' has-error' : '' }}" id="genre" name="genre" placeholder="{{ __('Enter genre') }}">
                  <small class="text-danger">{{ $errors->first('genre') }}</small>
                </div>
                <div class="form-group clr pull-left ml-10 ">
                  <label for="technologies">{{ __('Technologies') }}</label>
                  <select name="type" id="type" class="{{ $errors->has('type') ? ' has-error' : '' }}">
                    @foreach (App\Model\Film::$availableTechnologies as $technologies => $value)
                     <option value="{{$value}}">{{$technologies}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group pull-left ml-10">
                  <label for="rated">{{ __('Rated') }}</label>
                  <select name="rated" id="rated">
                    @foreach (App\Model\Film::$availableRated as $rated => $value)
                      <option value="{{$value}}">{{$rated}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group pull-left ml-10">
                  <label for="year">{{ __('Years') }}</label>
                    @php
                      $years = (int) date('Y');
                    @endphp
                  <select name="year" id="year">
                    @for ($i = $years; $i <= $years+2 ; $i++)
                      <option value="{{$i}}">{{ $i }}</option>
                    @endfor
                  </select>
                </div>
                <div class="form-group pull-left ml-10">
                  <label>{{ __('Release') }}:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control {{ $errors->has('release') ? ' has-error' : '' }}" name="release" value="{{ old('release') }}">
                  </div>
                   <small class="text-danger">{{ $errors->first('release') }}</small>
                  <!-- /.input group -->
                </div>
                <div class="form-group clr">
                  <label for="duration">{{ __('Duration') }}</label>
                  <input type="text" class="form-control {{ $errors->has('duration') ? ' has-error' : '' }}" id="duration" name="duration" placeholder="{{ __('Enter duration') }}" value="{{ old('duration') }}">
                  <small class="text-danger">{{ $errors->first('duration') }}</small>
                </div>
                <div class="form-group">
                  <label for="description">{{ __('Description') }}</label>
                  <textarea class="form-control ckeditor {{ $errors->has('description') ? ' has-error' : '' }}" id="description" name="description" placeholder="{{ __('Enter description') }}"></textarea>
                  <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
                <div class="form-group">
                  <label for="image">{{ __('File input')}}</label>
                  <input type="file" id="image" name="image">
                </div>
                 <div class="form-group">
                  <label for="link">{{ __('Link') }}</label>
                  <input type="text" class="form-control {{ $errors->has('link') ? ' has-error' : '' }}" id="link" name="link" placeholder="{{ __('Enter link') }}">
                  <small class="text-danger">{{ $errors->first('link') }}</small>
                </div>
                <div class="form-group">
                  <label>
                    <label for="admin">Actived</label>
                    <input type="radio" id="actived" class="flat-red" name="status" checked value="{{App\Model\Film::STATUS_ACTIVED}}">
                  </label>
                  <label>
                    <label for="user">Disable</label>
                    <input type="radio" id="disabled" class="flat-red" name="status" value="{{App\Model\Film::STATUS_DISABLED}}">
                  </label>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">{{ __('Submit') }}</button>
                <a href="{{ route('films.index') }}" class="btn btn-default pull-left">{{ __('Back') }}</a>
                <button type="reset" class="btn btn-warning pull-left btn-reset">{{ __('Reset') }}</button>
              </div>
            </form>
          </div>
          <div class="row"></div>
</div>
@endsection