@extends('layouts.instructorlayout')
@section('content')

<h3>Create Course</h3>

<form action="{{route('instructor.createtopicsubmit')}}" method="post" enctype="multipart/form-data">
    {{@csrf_field()}}

        <label for = "t_number">Topic Number: </label> 
        <input type="text" name="t_number" value="{{$lastnumber+1}}" readonly>
        <br>

        <label for = "t_title">Topic Title: </label>
         <input type="text" name="t_title" value="{{old('t_title')}}" placeholder="Enter a title">
        @error('t_title')
        <span>{{$message}}</span>
        @enderror
        <br>

        
        <label for = "t_video">Lecture video: </label>
         <input type="file" name="t_video">
        @error('t_video') 
        <span>{{$message}}</span>
        @enderror 
        <br>

        <label for = "t_material"> Lecture material: </label> 
        <textarea name="t_material" placeholder="Provide Study Material" rows="10" cols="50">{{old('t_material')}}</textarea>
        @error('t_material')
        <span>{{$message}}</span>
        @enderror
        <br>

    

        <input class="btn btn-secondary" type="submit" value="Create">
    </form>
@endsection