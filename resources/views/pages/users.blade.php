@extends('layouts/main')

@section('bdy')

<table class="traffic-table font-small">
  <tr>
    <th>USERNAME</th>
    <th>E-MAIL</th>
    <th>FROM</th>
    <th>LAST IP</th>
    <th>CREATION</th>
    <th>VERIFIED</th>
    <th>UPDATED</th>
    <th>LAST SEEN</th>
  </tr>
  @foreach ($users as $user)
    <tr>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->registered_from_ip}}</td>
      <td>{{$user->last_ip}}</td>
      <td>{{$user->created_at}}</td>
      <td>{{$user->email_verified_at}}</td>
      <td>{{$user->updated_at}}</td>
      <td>{{$user->last_login}}</td>
    </tr>
  @endforeach
</table>

@endsection