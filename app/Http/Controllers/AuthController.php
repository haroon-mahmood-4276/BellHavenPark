<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function LoginView ( Request $request )
	{
		if ( !request()->ajax() ) {
			return view( 'auth.login' );
		} else {
			abort( 403 );
		}
	}

	/**
	 * Handle an authentication attempt.
	 *
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function Login ( Request $request )
	{
		if ( !request()->ajax() ) {
			$credentials = $request->validate( [
				'email' => [ 'required', 'email' ],
				'password' => [ 'required' ],
			] );

			if ( Auth::attempt( $credentials ) ) {
				$request->session()->regenerate();
				return redirect()->route( 'dashboard.index' );
			}

			return back()->withErrors( [
				'email' => __('auth.failed'),
			] );

		} else {
			abort( 403 );
		}
	}

	/**
	 * Log the user out of the application.
	 *
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function Logout ( Request $request )
	{
		Auth::logout();

		$request->session()->invalidate();

		$request->session()->regenerateToken();

		return redirect()->route( 'auth.login.view' );
	}
}
