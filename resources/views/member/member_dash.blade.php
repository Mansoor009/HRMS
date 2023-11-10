@extends('layouts.master_layout')
@section('title', 'Member Dashboard')
@section('section')
    <a href="{{ route('logut') }}" class="btn btn-danger">Log Out</a>
    <h1>Member Dashboard</h1>
@endsection
