<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Student;
use App\User;
use App\UserSocialAccount;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    //Moetodo Loggout
    public function loggout(Request $request){
        auth()->loggout();
        session()->flush();
        return redirect('/login');
    }

    public function redirectToProvider(string $driver)
    {
        return Socialite::driver($driver)->redirect();
    }
    public function handleProviderCallback(string $driver)
    {
        //nos permite acceder los datos que entran a la aplicacion
        //cerrar bien la vinculacion del login
        if (!request()->has('code') || request()->has('denied')) {
            session()->flash('menssage', ['damager', __("Inicio de sesion cancelado")]);
            return redirect('login');
        }
        $socialUser = Socialite::driver($driver)->user();
        //El usuario no se ah creado
        $user = null;
        //si no tememos errores sera true
        $success = true;
        //retorno de email
        $email = $socialUser->email;
        //usaremos los modelos de elocuent
        $check = User::whereEmail($email)->first();
        if ($check) {
            $user = $check;
        } else {
            \DB::beginTransaction();
            //si la trabsaccion resulta
            try {
                $user = User::create([
                    "name" => $socialUser->name,
                    "email" => $email
                ]);
                UserSocialAccount::create([
                    "user_id" => $user->id,
                    "provider" => $driver,
                    "provider_uid" => $socialUser->id
                ]);
                Student::create([
                    "user_id" => $user->id
                ]);
            } catch (\Exception $exception) {
                $success = $exception->getMessage();
                \DB::rollBack();
            }
        }
        if ($success === true) {
            //guarda toda la informacion en la BD
            \DB::commit();
            auth()->loginUsingId($user->id);
            return redirect(route('home'));
        }
        session()->flash('message', ['danger', $success]);
        return redirect('login');
    }
}
