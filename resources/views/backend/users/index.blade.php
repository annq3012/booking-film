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
            <div class="box-header">
              <h3 class="box-title">{{ __('List Users') }}</h3>
            </div>
            <!-- /.box-header -->

            {{-- add button --}}
            <div>
              <button class="btn btn-primary btn-sm pull-right btn-add">{{ __('Add User') }}</button>
            </div>
            {{-- end add button --}}

            <div class="box-body">
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
                  <td> {{ $user->birthday }}</td>
                  <td>{{ $user->address }}</td>
                  <td class="text-center">
                      <form method="POST" action="{{-- {{ route('user.updateRole', $user->id) }} --}}">
                        {!! csrf_field() !!}
                        {{ method_field('PUT') }}
                        @if ($user->is_admin == App\Model\User::ROLE_ADMIN)
                          <button type="submit" class="btn btn-warning btn-sm">{{ __('Admin') }}</button>
                        @else
                          <button type="submit" class="btn btn-default btn-sm">{{ __('User') }}</button>
                        @endif
                      </form>
                  </td>
                  <td>
                    <a href="" class="btn-edit fa fa-pencil-square-o btn-custom-option pull-left"></a>
                    <form method="POST" class="inline">
                      {!! csrf_field() !!}
                      <button type="submit" class="btn-custom-option btn btn-delete-item fa fa-trash-o"></button>
                    </form>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
             {{-- add button --}}
              <div>
                <button class="btn btn-primary btn-sm pull-right btn-add">{{ __('Add User') }}</button>
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