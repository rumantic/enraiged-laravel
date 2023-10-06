<?php

namespace App\Http\Controllers\Realty\Index;

use App\Datatables\RealtyIndex;
use App\Http\Controllers\Controller;
use App\Models\Realty;
use Enraiged\Users\Models\User;
use Enraiged\Users\Tables\Builders\UserIndex;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Data extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->authorize('index', User::class);

        $table = RealtyIndex::from($request);

        return response()->json($table->data());
    }
}
