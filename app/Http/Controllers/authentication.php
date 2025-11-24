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

         DB::commit();
         return redirect()->route('login');

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
         return back()->withErrors(['email' => 'invalid email']);
      }

      if (!Hash::check($request->password, $user->password)) {
         return back()->withErrors(['password' => 'invalid password']);
      }

      session([
         'userid' => $user->id,
         'name' => $user->name
      ]);

      if ($user->userType == 0) {
         return redirect()->route('admin_dashboard');
      } else {
         return redirect()->route('profile');
      }
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


   // logout
   public function logout()
   {
      session()->flush();
      return redirect('/login');
   }
}

