<?php

namespace App\Http\Controllers\Auth;

use App\Funcionarios;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use function dd;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function md5;
use function session;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:funcionarios')->except('logout');
    }

    public function showFuncionarioLoginForm()
    {
        return view('adminlte::funcionarios.auth.login', ['url' => 'funcionario']);
    }

    public function funcionarioLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'login'     => 'required|email',
            'senha'     => 'required|min:8'
        ]);

        if($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $funcionario = Funcionarios::where("login", $request->login)->where("senha", md5($request->senha) )->first();

        if($funcionario){
            return redirect()->intended('/funcionarios');
        }else{
            return back()
                ->withErrors($validator)
                ->withErrors(['login' => 'Usuário ou senha inválidos'])
                ->withInput();
        }
//        if (Auth::guard('funcionarios')->attempt($credentials ) ) {
////        if (Auth::attempt($credentials)) {
//            dd("vai logar");
//            return redirect()->intended('/funcionarios');
//        }

    }
}
// func@teste.com
