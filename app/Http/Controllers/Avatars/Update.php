<?php

namespace App\Http\Controllers\Avatars;

use App\Http\Controllers\Controller;
use App\Http\Requests\Avatars\UpdateRequest;
use Enraiged\Avatars\Models\Avatar;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Update extends Controller
{
    use AuthorizesRequests;

    /**
     *  Provide the requested avatar.
     *
     *  @param  \Enraiged\Avatars\Models\Avatar  $avatar
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateRequest $request, Avatar $avatar)
    {
        $this->authorize('update', $avatar);

        $color = hexdec($request->get('color'));

        (object) $avatar
            ->fill(['color' => $color])
            ->save();

        $request->session()->put('status', 205);
        $request->session()->put('success', 'Color updated');

        return redirect()->back();
    }
}
