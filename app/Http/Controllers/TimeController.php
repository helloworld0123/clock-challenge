<?php
namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class TimeController extends Controller
{

    /**
     * Update the user's time.
     */
    public function update(Request $request)
    {

        $request->user()->hourOffset = $request->hourOffset;
        $request->user()->minuteOffset = $request->minuteOffset;
        $request->user()->save();

        return to_route('dashboard');

    }
}