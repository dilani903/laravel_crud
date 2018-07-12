<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\parents_model;
use App\course_model;
use Illuminate\Support\Facades\DB;

class student_controller extends Controller
{
    function add_new_student(){
		$data['parents_data'] = parents_model::all();
		$data['course_data'] = course_model::all();
		return view('add_student')->with('data',$data);
	}
	
	function save_student(Request $request){
		$student_name = $request->input('student_name');
		$course = $request->input('course');
		$dob = $request->input('dob');
		$parents = $request->input('parents');
		$city = $request->input('city');
		
		$data_1 = array(
			'name' => $student_name,
			'course_id' => $course,
			'dob' => $dob,
			'city' => $city
		);
		$last_id = DB::table('student')->insertGetId($data_1);
		$data_2 = array(
			'student_id' => $last_id,
			'parent_id' => $parents
		);
		DB::table('student_parent')->insert($data_2);
		return redirect('/dashboard/main_dashboard');
	}
	
	function edit_student($id){
		$data['parents_data'] = parents_model::all();
		$data['course_data'] = course_model::all();
		$data['Student_data'] = DB::table('student')->select('student.*','course.name AS course_name')->join('course', 'student.course_id', '=', 'course.id')->where('student.id',$id)->get();
		return view('edit_student')->with('data',$data);
		
	}
	
	function update_student(Request $request){
		$student_name = $request->input('student_name');
		$student_id = $request->input('student_id');
		$dob = $request->input('dob');
		$city = $request->input('city');
		$data_1 = array(
			'name' => $student_name,
			'dob' => $dob,
			'city' => $city
		);
		
		DB::table('student')->where('id',$student_id)->update($data_1);
		return redirect('/dashboard/main_dashboard');
	}
	
	function delete_students($id){
		DB::table('student')->where('id',$id)->delete();
		return redirect('/dashboard/main_dashboard');
	}
}
