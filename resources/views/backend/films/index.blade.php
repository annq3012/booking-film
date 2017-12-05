@extends('backend.layout.main')

@section('title', __('Films Page'))

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('Films Page') }}
      </h1>
    </section>
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div>
              <h3 class="h-title">{{ __('List Films') }}</h3>
            </div>
            <!-- /.box-header -->
            {{-- add button --}}
              <div class="col-md-6">
                  <form method="GET" action="{{ route('films.index') }}" class="container-search">
                    <input class="input-search form-control" placeholder="Search" name="search" type="text" value="{{ app('request')->input('search') }}">
                    <button type="submit" class="btn btn-primary btn-search"><i class="glyphicon glyphicon-search"></i></button>
                  </form>
              </div>
              <div class="contain-btn">
                  <span class="pull-left ml-10" >@include('flash::message')</span>
                  @include('backend.layout.partials.modal')
                  <a class="btn btn-primary pull-right btn-add" href="{{ route('films.create')}}" id="btn-add-user">
                  <span class="fa fa-plus-circle"></span>
                  {{ __('Add film') }}
                  </a>
            {{-- end add button --}}
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr align="center">
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Actor') }}</th>
                    <th>{{ __('Director')}}</th>
                    <th>{{ __('Language') }}</th>
                    <th>{{ __('Year') }}</th>
                    <th>{{ __('Genre') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th class="text-center">{{ __('Option') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($films as $film)
                <tr>
                  <td>{{ $film->id }}</td>
                  <td>{{ $film->name }}
                  </td>
                  <td>{{ $film->fullname }}</td>
                  <td> {{ $film->actor }}</td>
                  <td>{{ $film->director }}</td>
                  <td>{{ $film->language }}</td>
                  <td>{{ $film->year }}</td>
                  <td>{{ $film->genre }}</td>
                  <td class="text-center">
                    <form method="POST" action=" {{-- {{ route('films.updateRole', $film) }} --}} ">
                      {!! csrf_field() !!}
                      {{ method_field('PUT') }}
                      @if ($film->status == App\Model\Film::STATUS_ACTIVED)
                      <button type="submit" class="btn btn-warning btn-sm">{{ __('Active') }}</button>
                      @else
                        <button type="submit" class="btn btn-default btn-sm">{{ __('Disable') }}</button>
                      @endif
                    </form>
                  </td>
                  <td align="center">
                    <div class="btn-option text-center">
                      <a href="{{ route('films.edit', $film) }}"  class="btn-edit fa fa-pencil-square-o btn-custom-option pull-left" >
                      </a>
                      <form method="POST" action="{{ route('films.destroy', $film) }}" class="inline">
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
                  <a class="btn btn-primary pull-right btn-add" href="{{ route('films.create')}}" id="btn-add-film">
                  <span class="fa fa-plus-circle"></span>
                  {{ __('Add film') }}
                  </a>
              </div>
            {{-- end add button --}}
             {!! $films->render() !!}
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