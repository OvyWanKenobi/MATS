@extends('layouts.instructorlayout')
@section('content')

<h3>Add quiz</h3>

<form action="{{route('instructor.addquizsubmit')}}" method="post">
    {{@csrf_field()}}


        <label for = "q_quesnumber">Question No.  </label> 
        <input type="text" name="q_quesnumber" value="{{$lastnumber+1}}" readonly >
        <br>
        
        <textarea name="q_ques" placeholder="Enter your question" rows="2" cols="30">{{old('q_ques')}}</textarea>
        @error('q_ques')
        <span>{{$message}}</span>
        @enderror
        <br>

        <input class="form-check-input" type="checkbox" name="q_ans" value="option1">
        A. <input type="text" name="q_option1" value="{{old('q_option1')}}" placeholder="Enter Option 1">
        @error('q_option1')
        <span>{{$message}}</span>
        @enderror
        <br>

        <input class="form-check-input" type="checkbox" name="q_ans" value="option2">
        B. <input type="text" name="q_option2" value="{{old('q_option2')}}" placeholder="Enter Option 2">
        @error('q_option2')
        <span>{{$message}}</span>
        @enderror
        <br>

        <input class="form-check-input" type="checkbox" name="q_ans" value="option3">
        C. <input type="text" name="q_option3" value="{{old('q_option3')}}" placeholder="Enter Option 3">
        @error('q_option3')
        <span>{{$message}}</span>
        @enderror
        <br>

        <input class="form-check-input" type="checkbox" name="q_ans" value="option4">
        D. <input type="text" name="q_option4" value="{{old('q_option4')}}" placeholder="Enter Option 4">
        @error('q_option4')
        <span>{{$message}}</span>
        @enderror
        <br>


        <input class="btn btn-primary" type="submit" value="Add">
    </form>
@endsection