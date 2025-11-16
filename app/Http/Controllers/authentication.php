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
    //
    public function register(Request $request)
    {
      try{
      
      DB::beginTransaction();


         $user = User::create([
            'name'=> $request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
            'profile'=> $request->profile,
            'dob'=> $request->dob,
            'age'=> Carbon::parse($request->dob)->age,
         ]);
        $permanent_address = $request->p_line1 . '||' . $request->p_line2;
        $current_address = $request->c_line1 . '||' . $request->c_line2;

 
         Address::create([
            'userid'=>$user->id,
            'per_address'=>$permanent_address,
            'per_city'=>$request->p_city,
            'per_state'=>$request->p_state,
            'curr_address'=>$current_address,
            'curr_city'=>$request->c_city,
            'curr_state'=>$request->c_state
         ]);

         if($request->filled('qualification_name') )
         {
              foreach ($request->qualification_name as $qual) {
              Qualification::create([
                'userid' => $user->id,
                'qualification_name' => $qual,
            ]);
           }
         }

         if($request->filled('experience_name') )
         {
              foreach ($request->experience_name as $exp) {
              Experience::create([
                'userid' => $user->id,
                'experience_name' => $exp,
            ]);
           }
         }
       

         DB::commit();
         return redirect()->route('login');
      }
     catch (Exception $e) {
      DB::rollBack();
      return response()->json([
        'error' => $e->getMessage(), 
         ], 500); 
      }
      
   }

   // login method..............

   public function login(Request $request)
   {
      $request->validate([
           'email'=>'required|email',
           'password'=>'required|min:8'
      ]);
      
      $user = User::where('email' , $request->email)->first();
     if(!$user)

      {
            return back()->withErrors(['email'=> 'invalid email']);
      }elseif(!Hash::check($request->password, $user->password))
      {
          return back()->withErrors(['password'=> 'invalid password']);
      }
      session(['userid'=> $user->id ,
               'name' => $user->name
     ]);

     return redirect()->route('profile');
   }

   public function empProfile()
   {
      if(!session()->has('userid'))
      {
           return redirect()->route('login');
      }
      $user = User::with(['address' , 'qualification' , 'experience'])->find(session('userid'));
      
      // dd($user);

      return view('emp-profile' ,compact('user') );

   }
}
