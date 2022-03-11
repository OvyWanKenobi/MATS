@extends('layouts.instructorlayout')
@section('content')

<h3>Create Course</h3>

<form action="{{route('instructor.createcoursesubmit')}}" method="post" enctype="multipart/form-data">
    {{@csrf_field()}}
        <label for = "c_title">Course Title: </label> 
        <input type="text" name="c_title" value="{{old('c_title')}}" placeholder="Give your course a title">
        @error('c_title')
        <span>{{$message}}</span>
        @enderror
        <br>

        <label for = "c_description">Course description: </label> 
        <textarea name="c_description" placeholder="What is this course about?" rows="3" cols="30">{{old('c_description')}}</textarea>
        @error('c_description')
        <span>{{$message}}</span>
        @enderror
        <br>

        <label for = "c_price">Course Price: </label>
         <input type="text" name="c_price" value="{{old('c_price')}}" placeholder="Price">
        @error('c_price')
        <span>{{$message}}</span>
        @enderror
        <br>
        <label for = "c_thumbnail">Course thumbnail: </label>
         <input type="file" name="c_thumbnail">
        @error('c_thumbnail') 
        <span>{{$message}}</span>
        @enderror 
        <br>

        <input class="btn btn-secondary" type="submit" value="Create">
    </form>
@endsection