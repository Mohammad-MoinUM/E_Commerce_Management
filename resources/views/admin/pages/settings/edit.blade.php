@extends('layouts.admin')

@section('content')
@component('admin.components.error',[])
@endcomponent
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Profile Settings</h4>
      <form method="POST" action="/admin/settings">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $admin->name) }}" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $admin->email) }}" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current">
          <small class="text-muted">Leave blank to keep your existing password.</small>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </form>
    </div>
  </div>
</div>
@endsection