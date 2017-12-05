@extends('backend.layout.main')

@section('title', __('Rooms Page'))

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('Rooms Page') }}
      </h1>
    </section>
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div>
              <h3 class="h-title">{{ __('List Rooms') }}</h3>
            </div>
            <!-- /.box-header -->

            {{-- add button --}}
            <div class="col-md-6">
                  <form class="container-search">
                    <input class="input-search form-control" placeholder="Search" name="search" type="text" value="{{ app('request')->input('search') }}">
                    <button type="submit" class="btn btn-primary btn-search"><i class="glyphicon glyphicon-search"></i></button>
                  </form>
            </div>
            <div class="contain-btn">
                  <span class="pull-left ml-10" >@include('flash::message')</span>
                  @include('backend.layout.partials.modal')
                  <a class="btn btn-primary pull-right btn-add" href="{{ route('rooms.create')}}" id="btn-add-room">
                  <span class="fa fa-plus-circle"></span>
                  {{ __('Add Room') }}
                  </a>
            </div>
            {{-- end add button --}}

            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr align="center">
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Cinema') }}</th>
                    <th>{{ __('Type')}}</th>
                    <th>{{ __('Max Seats') }}</th>
                    <th class="text-center">{{ __('Option') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($rooms as $room)
                <tr>
                  <td>{{ $room->id }}</td>
                  <td>{{ $room->name }}
                  </td>
                  <td>{{ $room->cinema->name }}</td>
                  <td class="text-center"><span class="format-{{$room->type_label}}">{{$room->type_label}}</span></td>
                  <td>{{ $room->max_seats }}</td>
                  <td align="center">
                    <div class="btn-option text-center">
                      <a href="{{ route('rooms.edit', $room) }}"  class="btn-edit fa fa-pencil-square-o btn-custom-option pull-left" >
                      </a>
                      <form method="POST" action="{{ route('rooms.destroy', $room) }}" class="inline">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <button type="submit" 
                          class="btn-custom-option btn btn-delete-item fa fa-trash-o"
                          data-title="{{ __('Confirm deletion!') }}"
                          data-confirm="{{ __('Are you sure you want to delete?') }}">
                        </button>
                      </form> 
                    </div>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
             {{-- add button --}}
              <div class="contain-btn">
                  <a class="btn btn-primary pull-right btn-add" href="{{ route('rooms.create')}}" id="btn-add-room">
                  <span class="fa fa-plus-circle"></span>
                  {{ __('Add Room') }}
                  </a>
              </div>
            {{-- end add button --}}
             {!! $rooms->render() !!}
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection