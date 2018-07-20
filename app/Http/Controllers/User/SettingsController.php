<?php

namespace App\Http\Controllers\User;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

class SettingsController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    /**
     * View current user's settings
     *
     * @return \Illuminate\Http\Response
     */
    public function settings(Request $request)
    {
        $user = $request->user();

        if ($user) {
            return view('user.settings')
            ->with('user', $user);
        }

        return back()->withErrors(['Không tồn tại người dùng này']);
    }

    /**
     * Update the user
     *
     * @param  UpdateAccountRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request)
    {
        if ($this->service->update(auth()->id(), $request->all())) {
            return back()->with('message', 'Cập nhật thành công');
        }

        return back()->withErrors(['Cập nhật thất bại']);
    }

    public function postAvatar(Request $request, $id)
    {

        //get uploaded file
        //'file' param name is determined in Dropzone options script
        $file = $request->file('file');

        //add timestamp to original file name
        $name = time() . $file->getClientOriginalName();

        //move uploaded image to specific directory changing the name
        $file->move(public_path(User::AVATAR_PATH), $name);
        //retrieve authenticated user
        $user = User::findOrfail($id);
        $user->avatar = $name;
        $user->save();
        return $user->getAvatar();
    }

    public function deleteAvatar($id)
    {
        $user = User::findOrfail($id);
        $user->avatar = null;
        $user->save();
        return null;
    }
}
