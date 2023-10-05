<?php

namespace App\Http\Controllers\Realty;

use App\Datatables\RealtyIndex;
use App\Http\Controllers\Controller;
use Enraiged\Users\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Index extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $this->authorize('index', User::class);

        $table = RealtyIndex::from($request);

        return inertia('realty/Index', [
            'template' => $table->template(),
        ]);
    }
}
