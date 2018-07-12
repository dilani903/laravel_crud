<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\student_model;
use App\parents_model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class dashboard_controller extends Controller
{
    function index(){
		$data['Student_data'] = DB::table('student')->select('student.*','course.name AS course_name')->join('course', 'student.course_id', '=', 'course.id')->get();
		$data['filter_key'] = 0;
		return view('main_dashboard')->with('data',$data);
	}
	
	function filter_students(Request $request){
		$filter_by = $request->get('student_filter');
		if($filter_by == 0){
			$data['Student_data'] = DB::table('student')->select('student.*','course.name AS course_name')->join('course', 'student.course_id', '=', 'course.id')->get();
			$data['filter_key'] = 0;
		}
		elseif($filter_by == 1){
			$data = student_model::all();
			$id_set = array();
			foreach($data as $records){
				$dob = $records->dob;
				$dob = explode('-',$dob);
				$age = Carbon::createFromDate($dob[0],$dob[1],$dob[2])->age;
				if($age >= 18){
					array_push($id_set,$records->id);
				}
			}
			$data['Student_data'] = DB::table('student')->select('student.*','course.name AS course_name')->join('course', 'student.course_id', '=', 'course.id')->whereIn('student.id', $id_set)->get();
			$data['filter_key'] = 1;
		}
		elseif($filter_by == 2){
			$data['Student_data'] = DB::table('student')->select('student.*','course.name AS course_name')->join('course', 'student.course_id', '=', 'course.id')->where('course.name','Class 8')->where('course.year','2010')->get();
			$data['filter_key'] = 2;
		}
		elseif($filter_by == 3){
			$data = student_model::all();
			$std_set = array();
			foreach($data as $records){
				$dob = $records->dob;
				$dob = explode('-',$dob);
				$age = Carbon::createFromDate($dob[0],$dob[1],$dob[2])->age;
				if($age >= 16){
					array_push($std_set,$records->id);
				}
			}
			$data_parent = parents_model::all();
			$prnt_set = array();
			foreach($data_parent as $records){
				$dob = $records->dob;
				$dob = explode('-',$dob);
				$age = Carbon::createFromDate($dob[0],$dob[1],$dob[2])->age;
				if($age >= 50){
					array_push($prnt_set,$records->id);
				}
			}
			$data['Student_data'] = DB::table('student')->select('student.*','course.name AS course_name')->join('course', 'student.course_id', '=', 'course.id')->join('student_parent', 'student.id', '=', 'student_parent.student_id')->whereIn('student_parent.parent_id', $prnt_set)->get();
			$data['filter_key'] = 3;
		}
		
		return view('main_dashboard')->with('data',$data);
	}
	
	function filter_student_id(Request $request){
		$id = $request->get('student_id');
		$student_data = DB::table('student')->select('student.*','course.name AS course_name')->join('course', 'student.course_id', '=', 'course.id')->where('student.id',$id)->get();
		$parent_data = DB::table('parents')->select('parents.*')->join('student_parent', 'student_parent.parent_id', '=', 'parents.id')->where('student_parent.student_id',$id)->get();
		if(isset($student_data)){
			$data['student_data'] = $student_data;
		}
		if(isset($parent_data)){
			$data['parent_data'] = $parent_data;
		}
		return json_encode($data);
	}
	
}
