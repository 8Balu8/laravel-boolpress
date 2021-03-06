@extends('layouts.dashboard')

@section('content')
    <section>
        <h2>Modifica post</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('admin.posts.update', ['post' => $post->id])}}" method="post" enctype='multipart/form-data'>
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{old('title', $post->title)}}">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="">Nessuna</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select> 
            </div>
            <div class="mb-3">
                <h4>Tags</h4>

                @foreach ($tags as $tag)
                    <div class="form-check">
                        @if ($errors->any())
                            <input {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag-{{ $tag->id }}">
                        @else
                            <input {{ $post->tags->contains($tag) ? 'checked' : '' }} class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag-{{ $tag->id }}">
                        @endif
                        <label class="form-check-label" for="tag-{{ $tag->id }}">
                            {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            @if ($post->cover)
                <div class="w-25 mb-3">
                    Current Image:
                    <img src="{{asset('storage/'.$post->cover)}}" alt="{{$post->title}}">
                </div>
            @endif
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" id="image" name="image">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{old('content', $post->content)}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </section>
@endsection