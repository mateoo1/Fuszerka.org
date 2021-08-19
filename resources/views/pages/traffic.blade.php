@extends('layouts/main')

@section('bdy')

<table class="traffic-table font-small">
  <tr>
    <th>IP</th>
    <th>VISITS</th>
    <th>FIRST VISIT</th>
    <th>LAST VISIT</th>
    <th>USER AGENT</th>
    <th>USER</th>
  </tr>
  @foreach ($visits as $visit)
    <tr>
      <td>{{$visit->ip}}</td>
      <td>{{$visit->counter}}</td>
      <td>{{$visit->created_at}}</td>
      <td>{{$visit->updated_at}}</td>
      <td>{{$visit->browser}}</td>
      <td>{{$visit->user_name}}</td>
    </tr>
  @endforeach
</table>

@endsection