@extends('layouts.publiclayout')
@section('content')
    <h1>Instructor {{$instructor->id}} Details</h1>

    <br><br>
    <h3>Teacher's Details</h3>
         @if (($instructor->ins_dp)==Null)
        <img id="dpicon" src="{{asset('storage/nodpimage.png')}}"  style="width:150px; height:150px;"  alt="Image">
        @else
        <img id="dpicon" src="{{asset('storage/dp/instructors/'.$instructor->ins_dp)}}"  style="width:150px; height:150px; border-radius:50%; "  alt="Image">
        @endif
    <h4> Name: {{$instructor->ins_name}}</h4>
    <h4> Degree: {{$instructor->ins_degree}}</h4> 
    <h4> Bio: {{$instructor->ins_bio}}</h4> 
    <h4> Category: {{$instructor->instructorcategory->cat_name}}</h4> 
    <h4> Phone: {{$instructor->ins_phone}}</h4> 
    <h4> Email: {{$instructor->ins_email}}</h4> 
    <h4> Experience: {{$instructor->ins_exp}}</h4> 
     <h4>Courses by Instructor: </h4> 
      {{--  @if(count($instructor->coursesinteacher)>0)
            @php
            $carr=array();
             @endphp
            @foreach($teacher->coursesinteacher->sortBy('c_id') as $c)
                @php
                $cid=$c->course->c_id;
                @endphp      
                
                @if (in_array("$cid",$carr))
                    @continue
                @else
                    @php
                    $carr[]=$c->course->c_id;
                    @endphp 
                @endif
          <ul>
                <li> {{$c->course->c_name}} ({{$c->course->c_id}})</li>
            </ul>
                
    
    
            @endforeach
    
        @endif
        <h5><span class="label label-warning" >No course found</span></h5>
         --}}

@endsection