@extends('layouts.admin')
@section('content')
<h2>Users</h2>
<table border="1" cellpadding="8">
<thead><tr><th>#</th><th>Name</th><th>Email</th><th>Role</th><th>Actions</th></tr></thead>
<tbody>
@foreach($users as $u)
<tr>
  <td>{{ $u->id }}</td>
  <td>{{ $u->name }}</td>
  <td>{{ $u->email }}</td>
  <td>{{ $u->role }}</td>
  <td>
    <form method="POST" action="{{ route('admin.users.suspend',$u) }}" style="display:inline">@csrf<button>Toggle Suspend</button></form>
    <form method="POST" action="{{ route('admin.users.destroy',$u) }}" style="display:inline">@csrf @method('DELETE') <button>Delete</button></form>
  </td>
</tr>
@endforeach
</tbody>
</table>

{{ $users->links() }}
@endsection
