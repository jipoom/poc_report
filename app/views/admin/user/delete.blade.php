@extends('modal_layout')

{{-- Content --}}
@section('content')

    <!-- Tabs -->
      <!--  <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
      </ul> -->
    <!-- ./ tabs -->
    {{-- Delete Category Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($khetId)){{ URL::to('report/admin/user/' . $userId . '/delete') }}@endif" autocomplete="off">
        
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $userId }}" />
        <!-- <input type="hidden" name="_method" value="DELETE" /> -->
        <!-- ./ csrf token -->

        <!-- Form Actions -->
        <div class="form-group">
            <div class="controls">
               <p><label>Are you sure you want to delete "{{User::find($userId)->username}}"?</label></p>
                <button class="btn btn-cancel close_popup">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
            </div>
        </div>
        <!-- ./ form actions -->
    </form>
@stop