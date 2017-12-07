@extends('backend.layout.main')

@section('title', __('Users Page'))

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('Users Page') }}
      </h1>
    </section>
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div>
              <h3 class="h-title">{{ __('List Users') }}</h3>
            </div>
            <!-- /.box-header -->
            {{-- add button --}}
              <div class="col-md-6">
                  <form method="GET" action="{{ route('users.index') }}" class="container-search">
                    <input class="input-search form-control" placeholder="Search" name="search" type="text" value="{{ app('request')->input('search') }}">
                    <button type="submit" class="btn btn-primary btn-search"><i class="glyphicon glyphicon-search"></i></button>
                  </form>
              </div>
              <div class="contain-btn">
                  @include('backend.layout.partials.modal')
                  <a class="btn btn-primary pull-right btn-add" href="{{ route('users.create')}}" id="btn-add-user">
                  <span class="fa fa-plus-circle"></span>
                  {{ __('Add user') }}
                  </a>
            {{-- end add button --}}
            <div class="box-body">
            <div class="clr"><span class="pull-left ml-10" >@include('flash::message')</span></div>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr align="center">
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Full Name') }}</th>
                    <th>{{ __('Birthday')}}</th>
                    <th>{{ __('Address') }}</th>
                    <th>{{ __('Permission') }}</th>
                    <th class="text-center">{{ __('Option') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->email }}
                  </td>
                  <td>{{ $user->fullname }}</td>
                  <td> {{ date('d-m-Y', strtotime($user->birthday)) }}</td>
                  <td>{{ $user->address }}</td>
                  <td class="text-center">
                    <form method="POST" action=" {{ route('users.updateRole', $user) }} ">
                      {!! csrf_field() !!}
                      {{ method_field('PUT') }}
                      @if ($user->is_admin == App\Model\User::ROLE_ADMIN)
                      <button type="submit" class="btn btn-warning btn-sm">{{ __('Admin') }}</button>
                      @else
                        <button type="submit" class="btn btn-default btn-sm">{{ __('User') }}</button>
                      @endif
                    </form>
                  </td>
                  <td align="center">
                    <div class="btn-option text-center">
                      <a href="{{ route('users.edit', $user) }}"  class="btn-edit fa fa-pencil-square-o btn-custom-option pull-left" >
                      </a>
                      <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline">
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
                  <a class="btn btn-primary pull-right btn-add" href="{{ route('users.create')}}" id="btn-add-user">
                  <span class="fa fa-plus-circle"></span>
                  {{ __('Add user') }}
                  </a>
              </div>
            {{-- end add button --}}
             {!! $users->render() !!}
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