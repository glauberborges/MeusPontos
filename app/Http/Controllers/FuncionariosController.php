<?php

namespace App\Http\Controllers;

use App\Funcionarios;
use function dd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function md5;
use PhpParser\Node\Expr\New_;

class FuncionariosController extends Controller
{
    public function index()
    {

        $data_tables = Funcionarios::where("user_id", Auth::user()->id)->get();

        return view('funcionarios.index', compact('data_tables'));
    }

    public function extrato($id)
    {

        $funcionario = Funcionarios::find($id);

        $extrato = $funcionario->movimentacoes()->get();

        return view('funcionarios.extrato', compact('extrato'));
    }

    public function novoForm()
    {

        return view('funcionarios.form');
    }

    public function inserir(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nome_completo"           		=> "required",
            "login"              			=> "required|email",
            "senha"              			=> "required|min:8",
        ]);
        $validator->setAttributeNames([
            "nome_completo"             => "nome",
            "login"                     => "login",
            "senha"                     => "senha",
        ]);

        if($validator->fails()) {

            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }else{

            $funcionario = new Funcionarios();
            $funcionario->nome_completo = $request->nome_completo;
            $funcionario->login = $request->login;
            $funcionario->senha = Hash::make($request->senha);
            $funcionario->saldo_atual = (isset($request->saldo_atual) ? $request->saldo_atual : 0);
            $funcionario->user_id = Auth::user()->id;

            $funcionario->save();

        }

        return redirect()
            ->route('funcionarios')
            ->with('success', 'Inseção realizada com sucesso!');
    }

    public function editarForm(Funcionarios $funcionarios)
    {
        return view('funcionarios.form', compact('funcionarios'));
    }

    public function edicao(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nome_completo"           		=> "required",
            "login"              			=> "required|email|unique:funcionarios,login,".$request->id.",id",
            "senha"              			=> "required|min:8",
        ]);
        $validator->setAttributeNames([
            "nome_completo"             => "nome",
            "login"                     => "login",
            "senha"                     => "senha",
        ]);

        if($validator->fails()) {

            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }else{

            $funcionario = Funcionarios::find($request->id);
            $funcionario->nome_completo = $request->nome_completo;
            $funcionario->login = $request->login;
            $funcionario->senha = Hash::make($request->senha);
            $funcionario->saldo_atual = $request->saldo_atual;
            $funcionario->save();

        }

        return redirect()
            ->route('funcionarios')
            ->with('success', 'Funcionário editado com sucesso!');
    }
}
