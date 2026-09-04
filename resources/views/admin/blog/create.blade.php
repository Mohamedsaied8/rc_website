@extends('admin.layout')

@section('title', 'New Post')
@section('page-title', 'Create Content')
@section('page-subtitle', 'Publish a blog post, a news item or a research paper')

@section('content')
    <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.blog._form', ['post' => null, 'submitLabel' => 'Create Post'])
    </form>
@endsection
