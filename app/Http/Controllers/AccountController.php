<?php

namespace App\Http\Controllers;

use App\Grade;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $grades = Grade::all();
        return view('my_account.index', ['user' => $user, 'grades' => $grades]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $id)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'grade' => 'required|max:255',
            'identification_document' => 'nullable',
            'telephone' => 'nullable',
            'address' => 'nullable',
        ]);

        $user = User::find($id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->grade = $request->grade;
        $user->identification_document = $request->identification_document;
        $user->telephone = $request->telephone;
        $user->address = $request->address;

        $img = $request->file('image');

        $strFlash = 'User Edited';
        $strStatus = 'success';

        if ($img != null) {
            if ($img->getError() == 0) {

                $exists = Storage::disk('imagesUsers')->exists($user->image);
                if ($exists) {
                    Storage::disk('imagesUsers')->delete($user->image);
                }
                $file_route = time() . '_' . $img->getClientOriginalName();
                Storage::disk('imagesUsers')->put($file_route, \File::get($img));
                $user->image = $file_route;

            } elseif($img->getError() == 1) {
                $strFlash = $img->getErrorMessage();
                $strStatus = 'warning';
            }
        }

        $user->save();
        return redirect(route('my_account'))->with($strStatus, $strFlash);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
