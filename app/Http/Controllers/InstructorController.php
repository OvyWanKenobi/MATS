<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\Topic;
use App\Models\Quiz;
use phpDocumentor\Reflection\Types\Null_;

class InstructorController extends Controller
{

    public function Home(Request $req){
        $username=$req->session()->get('username');
        $instructor = Instructor::where('ins_username',$username)->first();
        return view('Instructor.InstructorHome')->with('instructor', $instructor);
    }
  
    public function CreateCourse(){
      return view('Instructor.CreateCourse');
    }

    public function CreateCourseSubmit(Request $req){
      $this->validate($req,
          [
              'c_title'=>'required',
              'c_description'=>'required',
              'c_price'=>'required',
              
          ],
          [
              'c_title.required'=>'Please enter username',
              
          ]
          );
         
          if($req->c_thumbnail){
          $imagename = $req->c_title.time().'.'.$req->c_thumbnail->extension();    
          $image = $req->c_thumbnail->storeAs('public/coursethumbnail', $imagename);
          }
          
          
          $username=$req->session()->get('username');
          $instructor = Instructor::where('ins_username',$username)->first();

          $c = new Course();
          $c->c_title = $req->c_title;
          $c->c_description = $req->c_description;
          $c->c_price = $req->c_price;
          if(isset($image)){
          $c->c_thumbnail =  $imagename;}
          $c->c_status = 'Inactive';
          $c->c_instructor_fk = $instructor->id;
          $c->c_category_fk = $instructor->ins_cat_fk;
          $c->save();

          return redirect()->route('instructor.home');
     }

     public function CreateTopic(Request $req){
      
      $topic = Topic::where('t_course_fk',decrypt($req->courseid))->get()->last();
      if($topic==Null){
        $lastnumber = 0;
      }else{
        $lastnumber = $topic->t_number;
      }
      
      return view('Instructor.CreateTopic')->with('lastnumber',$lastnumber);
    }

    public function CreateTopicSubmit(Request $req){
      $this->validate($req,
          [
            
              't_title'=>'required',
              
          ],
          [
              't_title.required'=>'Please enter title',
          ]
          );

          if($req->t_video){
            $videoname = $req->t_title.time().'.'.$req->t_video->extension();    
            $video = $req->t_video->storeAs('public/lecturevideo', $videoname);
            }


            $viewingcourse=$req->session()->get('viewingcourse');

            $t = new Topic();
            $t->t_number = $req->t_number;
            $t->t_title = $req->t_title;
            if(isset($video)){
            $t->t_video =  $videoname;}
            $t->t_material = $req->t_material;
            $t->t_course_fk = $viewingcourse;
            $t->save();
            
            $course = Course::where('id',$viewingcourse)->first();
            return view('Instructor.ViewCourse')->with('course',$course);

       }

       public function Addquiz(Request $req){
      
        $quiz = Quiz::where('q_topic_fk',decrypt($req->topicid))->get()->last();
        if($quiz==Null){
          $lastnumber = 0;
        }else{
          $lastnumber = $quiz->q_quesnumber;
        }
        return view('Instructor.AddQuiz')->with('lastnumber',$lastnumber);
      }


      public function Addquizsubmit(Request $req){
        $this->validate($req,
            [
              
                'q_ques'=>'required',
                
            ],
            [
                'q_ques.required'=>'Please enter question',
            ]
            );
  
           
  
  
              $viewingtopic=$req->session()->get('viewingtopic');
  
              $q = new Quiz();
              $q->q_quesnumber = $req->q_quesnumber;
              $q->q_ques = $req->q_ques;
              $q->q_option1 = $req->q_option1;
              $q->q_option2 = $req->q_option2;
              $q->q_option3 = $req->q_option3;
              $q->q_option4 = $req->q_option4;

              if(($req->q_ans)=="option1"){$q->q_ans = $req->q_option1;}
              if(($req->q_ans)=="option2"){$q->q_ans = $req->q_option2;}
              if(($req->q_ans)=="option3"){$q->q_ans = $req->q_option3;}
              if(($req->q_ans)=="option4"){$q->q_ans = $req->q_option4;}

              $q->q_topic_fk = $viewingtopic;
              $q->save();
              
              $topic = Topic::where('id',$viewingtopic)->first();
              return view('Instructor.ViewTopic')->with('topic',$topic);
  
         }

    
       public function EditCourse(Request $req){
          session(['viewingcourse'=>decrypt($req->courseid)]);
          $course = Course::where('id',decrypt($req->courseid))->first();
          return view('Instructor.EditCourse')->with('course',$course);
      }

      public function EditCourseSubmit(Request $req){

        

        $this->validate($req,
            [
                'c_title'=>'required',
                'c_description'=>'required',
                'c_price'=>'required',
                
            ],
            [
                'c_title.required'=>'Please enter username',
                
            ]
            );
           

            $username=$req->session()->get('username');
            $viewingcourse=$req->session()->get('viewingcourse');
            $instructor = Instructor::where('ins_username',$username)->first();

            $cu = Course::where('id',$viewingcourse)->first();
            
            $cu->c_title = $req->c_title;
            $cu->c_description = $req->c_description;
            $cu->c_price = $req->c_price;
           
            if(isset($req->c_thumbnail)){
              $imagename = $req->c_title.time().'.'.$req->c_thumbnail->extension();    
              $req->c_thumbnail->storeAs('public/coursethumbnail', $imagename);
              $cu->c_thumbnail =  $imagename;
              }

            
            $cu->c_status = 'Inactive';
            $cu->c_instructor_fk = $instructor->id;
            $cu->c_category_fk = $instructor->ins_cat_fk;
            $cu->save();
  
            return view('Instructor.ViewCourse')->with('course',$cu);
       }

       public function DeleteCourse(Request $req){
        session(['viewingcourse'=>decrypt($req->courseid)]);
        $course = Course::where('id',decrypt($req->courseid))->first();
        return view('Instructor.DeleteCourse')->with('course',$course);
    }

    public function DeleteCourseSubmit(Request $req){
      $cd = Course::where('id',decrypt($req->id))->first();
      $cd->delete();
      return redirect()->route('instructor.home');
  }

    public function ViewCourse(Request $req){
        $course = Course::where('id',decrypt($req->id))->first();
        session(['viewingcourse'=>$course->id]);
        return view('Instructor.ViewCourse')->with('course',$course);
      }

      public function ViewTopic(Request $req){
        $topic = Topic::where('id',decrypt($req->id))->first();
        session(['viewingtopic'=>$topic->id]);
        //$quiz= Quiz::where('q_topic_fk',decrypt($req->id))->get();
        return view('Instructor.ViewTopic')->with('topic',$topic);
      }

}

