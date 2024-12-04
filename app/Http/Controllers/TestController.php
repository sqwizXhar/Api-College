<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Lesson;
use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use function Pest\Laravel\get;

class TestController extends Controller
{
    public function index()
    {
//        $group = Group::with('users')->get();
//
//        foreach ($group as $groups) {
//            echo $groups->name . '<br>';
//            foreach ($groups->users as $users) {
//                echo $users->first_name . '<br>';
//            }
//            echo '<hr>';
//        }

//        $role = Role::getStudentRole()->id;
//        $user = User::with('groups')->where('role_id', $role)->first();
//
//        if($user){
//            $group = $user->groups->first();
//            if($group){
//                echo $group->name;
//            }
//            else {
//                echo 'no group';
//            }
//        } else {
//            echo "no user";
//        }

//        $user = User::with('groups')->find(37);
//        $role = $user->role()->first();
//        echo $role->name. '<br>';
//
//        if($user && $user->groups->isNotEmpty()){
//            $group = $user->groups()->first();
//            $group->pivot->group_id;
//            echo $group->name . '<br>';
//        } else {
//            echo 'user not group';
//        }

//
//        $lesson = Lesson::with('subject')->get();
//        $lesson->subject()->where('subject_user_id', 1);
//        dd($lesson);
//

//        $subject = Lesson::with('subject')->get();
//
//        echo $subject->toJson();




//        $users = User::with('groups')->get();
//
//        foreach ($users as $user) {
//            echo $user->groups->name . '<br>';
//            foreach ($user->first_name as $group) {
//                echo $group . '<br>';
//            }
//        }
    }
}
