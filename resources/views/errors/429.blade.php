@extends('errors.layout', ['code' => '429'])
@section('message', 'Too many requests')
@section('detail', 'You have made too many requests in a short time. Please wait a moment and try again.')
