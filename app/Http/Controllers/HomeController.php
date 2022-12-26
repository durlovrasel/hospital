<?php

namespace App\Http\Controllers;

use id;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Extension\CommonMark\Parser\Inline\AutolinkParser;

class HomeController extends Controller
{
    public function redirect()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == '0') {
                $doctors = doctor::all();
                return view('user.home', compact('doctors'));
            } else {
                return view('admin.home');
            }
        } else {
            return redirect()->back();
        }
    }

    public function index()
    {
        if (Auth::id()) {
            return redirect('home');
        } else {
            $doctors = doctor::all();
            return view('user.home', compact('doctors'));
        }
    }

    public function appointment(Request $request)
    {
        $appointments = new appointment;
        $appointments->name = $request->name;
        $appointments->email = $request->email;
        $appointments->date = $request->date;
        $appointments->phone = $request->phone;
        $appointments->message = $request->message;
        $appointments->doctor = $request->doctor;
        $appointments->status = 'In Progress';
        if (Auth::id()) {
            $appointments->user_id = Auth::user()->id;
        }

        $appointments->save();

        return redirect()->back()->with('message', 'Your appointment request 
                                        is in progress. We will contact 
                                        you soon.');
    }

    public function myappointment()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 0) {
                $userid = Auth::user()->id;
                $appoints = appointment::where('user_id', $userid)->get();
                return view('user.my_appointment', compact('appoints'));
            } else {
                return redirect('login');
            }
        } else {
            return redirect()->back();
        }
    }

    public function cancel_appointment($id)
    {
        $data = appointment::find($id);
        $data->delete();
        return redirect()->back();
    }
}
