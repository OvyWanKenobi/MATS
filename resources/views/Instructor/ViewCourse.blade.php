@extends('layouts.instructorlayout')
@section('content')

<h3>View Course</h3>

<br><br>

@if (($course->c_thumbnail)==Null)
<img  src="{{asset('storage/noimage.png')}}"  style="width:100px; height:100px;"  alt="Image">
@else
<img  src="{{asset('storage/coursethumbnail/'.$course->c_thumbnail)}}"  style="width:100px; height:100px; "  alt="Image">
@endif
<h4> Title: {{$course->c_title}}</h4>
<h4> Description: {{$course->c_description}}</h4> 
<h4> Price: {{$course->c_price}}</h4> 
<h4> Rating: 
    @php
    $rat=0;
    $totrat=count($course->studentsincourse);
    @endphp
    @foreach($course->ratingsofcourse as $cr)
    @php
        $rat=$rat + ($cr->r_rating)  ;
    @endphp
    
    @endforeach
    @if($totrat == 0)
    Not Rated
    @else
    {{$rat/$totrat}} /5  ({{$totrat}})</h4>
    @endif
    
<h4> Status: {{$course->c_status}}</h4> 

<a class="btn btn-success" href="{{route('instructor.editcourse',['courseid'=>encrypt($course->id)])}}">Edit Course</a>

<a class="btn btn-danger" href="{{route('instructor.deletecourse',['courseid'=>encrypt($course->id)])}}">Delete Course</a>

<h3>Course Topics</h3>
<a class="btn btn-secondary" href="{{route('instructor.createtopic',['courseid'=>encrypt($course->id)])}}">Create Topic</a>
@if(count($course->topics)>0)

<table class="table  table-hover">
  

  @foreach($course->topics as $t)

      <tr class="clickable  " style="cursor:pointer; "  onclick="window.location='{{route('instructor.viewtopic',['id'=>encrypt($t->id)])}}'">


          <td> #{{$t->t_number}}</td>
          <td> {{$t->t_title}}</td>
 
  @endforeach
</table>

@else
<h5><span class="label label-warning" >No data found</span></h5>
@endif


@endsection