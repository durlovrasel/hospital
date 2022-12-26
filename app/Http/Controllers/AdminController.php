<?php

namespace App\Http\Controllers;

use App\Models\Doctor;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SendEmailNotification;

use Notification;

class AdminController extends Controller
{
    public function addview()
    {
        if(Auth::id()){
            if(Auth::user()->usertype==1){
                return view('admin.add_doctor');
            }else{
                return redirect()->back();
            }
        }else{
            return redirect('login');
        }
        
    }

    public function uploaddoctor(Request $request)
    {
        $doctor = new doctor;
        $img = $request->image;
        $img_name = time() . '.' . $img->getClientOriginalExtension();
        $request->image->move('doctorimage', $img_name);
        $doctor->image = $img_name;

        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->room = $request->room;
        $doctor->speciality = $request->speciality;

        $doctor->save();

        return redirect()->back()->with('message', 'The doctor has been added successfully!');
    }

    public function showappointment()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                $appointments = appointment::all();
                return view('admin.showappointment', compact('appointments'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }

    public function approved($id)
    {
        $data = appointment::find($id);
        $data->status = 'Approved';
        $data->save();
        return redirect()->back();
    }

    public function discarded($id)
    {
        $data = appointment::find($id);
        $data->status = 'Discarded';
        $data->save();
        return redirect()->back();
    }

    public function showdoctor()
    {
        $data = doctor::all();
        return view('admin.showdoctor', compact('data'));
    }

    public function deletedoctor($id)
    {
        $data = doctor::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function updatedoctor($id)
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                $data = doctor::find($id);
                return view('admin.update_doctor', compact('data'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }


    public function editdoctor(Request $request, $id)
    {
        $doctor = doctor::find($id);
        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->speciality = $request->speciality;
        $doctor->room = $request->room;

        $image = $request->image;

        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('doctorimage', $imagename);
            $doctor->image = $imagename;
        }

        $doctor->save();
        return redirect()->back()->with('message', 'Doctor details has been updated successfully.');
    }

    public function emailview($id)
    {
        $data = appointment::find($id);
        return view('admin.email_view', compact('data'));
    }

    public function sendemail(Request $request, $id)
    {
        $data = appointment::find($id);
        $details = [
            'greeting' => $request->greeting,
            'body' => $request->body,
            'actiontext' => $request->actiontext,
            'actionurl' => $request->actionurl,
            'endpart' => $request->endpart
        ];

        Notification::send($data, new SendEmailNotification($details));

        return redirect()->back()->with('message', 'Email has been sent successfully.');
    }
}
