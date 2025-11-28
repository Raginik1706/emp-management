<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\Address;
use App\Models\Qualification;
use App\Models\Experience;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class authentication extends Controller
{
   // register view
   public function registerView()
   {
      $states = json_decode(file_get_contents(public_path('json/state.json')), true);
      return view('welcome', compact('states'));
   }


   // register user
   public function register(Request $request)
   {
      $request->validate([
         'name' => 'required|max:255',
         'email' => 'required|email|unique:users,email',
         'password' => 'required|min:8|confirmed',
         'profile' => 'nullable|image|mimes:jpeg,png,jpg',
         'dob' => 'required|date|before:today',

         'p_line1' => 'required|max:255',
         'p_city' => 'required|max:100',
         'p_state' => 'required|max:100',

         'c_line1' => 'required|max:255',
         'c_city' => 'required|max:100',
         'c_state' => 'required|max:100',

         'qualification_name' => 'required|array',
         'qualification_name.*' => 'required|string',

         'experience_name' => 'required|array',
         'experience_name.*' => 'required|string',
      ], [
         'password.required' => 'incorrect password',
         'password_confirmation' => 'password does not match',

         'p_line1.required' => 'Permanent address is required',
         'c_line1.required' => 'Current address is required',

         'p_city.required' => 'City is Required',
         'p_state.required' => 'State is Required',
         'c_city.required' => 'City is Required',
         'c_state.required' => 'State is Required',

         'qualification_name.required' => 'Please add at least one qualification.',
         'experience_name.required' => 'Please add at least one experience.',
         'qualification_name.*.required' => 'Qualification field cannot be empty.',
         'experience_name.*.required' => 'Experience field cannot be empty.',
      ]);


      try {

         DB::beginTransaction();

         $profileName = null;

         if ($request->hasFile('profile')) {
            $imgFile = $request->file('profile');
            $profileName = $imgFile->getClientOriginalName();
            $imgFile->move(public_path('profileImages'), $profileName);
         }
   

         $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile' => $profileName,
            'dob' => $request->dob,
            'age' => Carbon::parse($request->dob)->age,
         ]);

         if ($request->filled('qualification_name')) {
            foreach ($request->qualification_name as $qual) {
               Qualification::create([
                  'userid' => $user->id,
                  'qualification_name' => $qual,
               ]);
            }
         }

         if ($request->filled('experience_name')) {
            foreach ($request->experience_name as $exp) {
               Experience::create([
                  'userid' => $user->id,
                  'experience_name' => $exp,
               ]);
            }
         }
         $permanent_address = $request->p_line1 . '||' . $request->p_line2;
         $current_address = $request->c_line1 . '||' . $request->c_line2;

         Address::create([
            'userid' => $user->id,
            'per_address' => $permanent_address,
            'per_city' => $request->p_city,
            'per_state' => $request->p_state,
            'curr_address' => $current_address,
            'curr_city' => $request->c_city,
            'curr_state' => $request->c_state
         ]);


         DB::commit();
         return response()->json([
            'status' => true,
            'message' => 'Registration successful!',
         ], 200);

      } catch (Exception $e) {
         DB::rollBack();
         return response()->json([
            'error' => $e->getMessage(),
         ], 500);
      }
   }


   // login
   public function login(Request $request)
   {
      $request->validate([
         'email' => 'required|email',
         'password' => 'required|min:8'
      ]);

      $user = User::where('email', $request->email)->first();
      
      
      if (!$user) {
         return response()->json([
            'status' => false,
            'field' => 'email',
            'message' => 'Invalid email'
        ], 422);
    }

      if (!Hash::check($request->password, $user->password)) {
        return response()->json([
            'status' => false,
            'field' => 'password',
            'message' => 'Invalid password'
        ], 422);
     }

      session([
         'userid' => $user->id,
         'name' => $user->name
      ]);
      $redirect = ($user->userType == 0) ? route('admin_dashboard') : route('profile');


      return response()->json([
        'status' => true,
        'message' => 'Login successful',
        'redirect' => $redirect
      ], 200);
   }


   // employee profile
   public function empProfile()
   {
      if (!session()->has('userid')) {
         return redirect()->route('login');
      }

      $user = User::with(['address', 'qualification', 'experience'])
               ->find(session('userid'));

      return view('emp-profile', compact('user'));
   }


   // show admin dashboard
   public function displayAdminDashboard()
   {
      if (!session()->has('userid')) {
         return redirect()->route('login');
      }

      return view('admin_dashboard');
   }

   public function logout()
   {
      try {
         session()->flush();

         return response()->json([
               'status' => true,
               'message' => 'Logged out successfully',
               'redirect' => '/login'
         ], 200);

      } catch (\Exception $e) {

         return response()->json([
               'status' => false,
               'message' => 'Server error occurred.',
               'error' => $e->getMessage()
         ], 500);
      }
   }




public function adminDashboard()
{
   $employees = User::with('qualification')->get();

    return view('admin_dashboard', compact('employees'));
}

public function viewEmployee($id)
{
    $employee = User::with(['qualification', 'address', 'experience'])->find($id);

    if (!$employee) {
        abort(404, "Employee not found");
    }

    return view('emp-profile', ['user' => $employee]);


}


public function updateProfile(Request $request)
{

   

    $request->validate([
        'name' => 'required|max:255',
        'dob' => 'required|date|before:today',
        'profile' => 'nullable|image|mimes:jpeg,png,jpg',

        'p_line1' => 'required',
        'p_city' => 'required',
        'p_state' => 'required',

        'c_line1' => 'required',
        'c_city' => 'required',
        'c_state' => 'required',

        'qualification' => 'required|array',
        'qualification.*' => 'required|string',

        'qualification_id' => 'array',
        'qualification_id.*' => 'nullable|integer',

        'experience' => 'required|array',
        'experience.*' => 'required|string',

        'experience_id' => 'array',
        'experience_id.*' => 'nullable|integer',
    ],
   [
       
         'qualification.*.required' => 'Qualification field cannot be empty.',
         'experience.*.required' => 'Experience field cannot be empty.',
   ]);

   Log::info("Validation Successed");
    

    try {
        DB::beginTransaction();

        $user = User::findOrFail($request->userId);
        Log::info("User Finded Data",$user->toArray());


       
      // PROFILE IMAGE UPDATE
     
        $profileName = $user->profile;

        if ($request->hasFile('profile')) {

           
            if ($profileName && file_exists(public_path("profileImages/" . $profileName))) {
                unlink(public_path("profileImages/" . $profileName));
            }

            $imgFile = $request->file('profile');
            $profileName = time() . '_' . $imgFile->getClientOriginalName();
            $imgFile->move(public_path('profileImages'), $profileName);
        }

        
        //  UPDATE USER TABLE
       
        $user->update([
            'name' => $request->name,
            'dob' => $request->dob,
            'age' => Carbon::parse($request->dob)->age,
            'profile' => $profileName,
        ]);

        
        //  UPDATE ADDRESS
     
        $permanent_address = $request->p_line1 . '||' . ($request->p_line2 ?? '');
        $current_address = $request->c_line1 . '||' . ($request->c_line2 ?? '');

        $user->address->update([
            'per_address' => $permanent_address,
            'per_city' => $request->p_city,
            'per_state' => $request->p_state,
            'curr_address' => $current_address,
            'curr_city' => $request->c_city,
            'curr_state' => $request->c_state,
        ]);
        Log::info("User Updated Successed");


       
        //  QUALIFICATIONS UPDATE
      
        foreach ($request->qualification as $index => $qname) {

            $qid = $request->qualification_id[$index] ?? null;

            if ($qid) {
                // update existing
                Qualification::where('id', $qid)->where('userid', $user->id)
                    ->update(['qualification_name' => $qname]);
            } else {
                // create new
                Qualification::create([
                    'userid' => $user->id,
                    'qualification_name' => $qname,
                ]);
            }
        }
        Log::info("Qualification Updated Successed");


        
        //  EXPERIENCE UPDATE
       
        foreach ($request->experience as $index => $ename) {

            $eid = $request->experience_id[$index] ?? null;
            Log::info("Experience"." ".$ename);

            if ($eid) {
                // update existing
                Experience::where('id', $eid)->where('userid', $user->id)
                    ->update(['experience_name' => $ename]);
            } else {
                // new record
                Experience::create([
                    'userid' => $user->id,
                    'experience_name' => $ename,
                ]);
            }
        }
        Log::info("Experience Updated Successed");


        DB::commit();
        Log::info("Profile Updated Success full");
     
      return response()->json([
         'status' => true,
         'message' => 'Profile updated successfully',
         'redirect' => route('profile')
      ], 200);


    } catch (Exception $e) {
        DB::rollBack();
        Log::error("Update-Failed",[
          'error'=>$e->getMessage()
        ]);
        return response()->json([
            'status' => false,
            'message' => 'Server Error',
            'error' => $e->getMessage()
        ], 500);
    }
}



}

