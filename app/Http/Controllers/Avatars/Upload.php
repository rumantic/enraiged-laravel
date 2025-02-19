<?php

namespace App\Http\Controllers\Avatars;

use App\Http\Controllers\Controller;
use App\Http\Requests\Avatars\UploadRequest;
use Enraiged\Avatars\Models\Avatar;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Upload extends Controller
{
    use AuthorizesRequests;

    /**
     *  Provide the requested avatar.
     *
     *  @param  \Enraiged\Avatars\Models\Avatar  $avatar
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UploadRequest $request, Avatar $avatar)
    {
        $this->authorize('upload', $avatar);

        $avatar->upload($request->file('image'));

        $request->session()->put('status', 205);
        $request->session()->put('success', 'Avatar uploaded');

        return redirect()->back();
    }
}
