<?php

namespace App\Http\Controllers;

use App\Funcionarios;
use App\Movimentacoes;
use function compact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MovimentacoesController extends Controller
{
    public function index()
    {
        $data_tables = Movimentacoes::orderBy('id', 'desc')->get();
        return view('movimentacoes.index', compact('data_tables'));
    }

    public function novoForm(Funcionarios $funcionarios)
    {
        return view('movimentacoes.form', compact('funcionarios'));
    }

    public function inserir(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "func_id"              		=> "required|exists:funcionarios,id", // Valida de o ID do Funcionário existe.
            "tipo_movimentacao"         => "required|in:".TIPO_MOVIMENTACAO,
            "valor"              		=> "required|numeric",
            "observacao"           		=> "required",
        ]);

        $validator->setAttributeNames([
            "func_id"                   => "funcionário",
            "tipo_movimentacao"         => "monvimentações",
            "valor"              		=> "valor",
            "observacao"           		=> "observação",
        ]);

        if($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }else{

            $movimentacoes = new Movimentacoes();
            $movimentacoes->tipo_movimentacao   = $request->tipo_movimentacao;
            $movimentacoes->tipo_movimentacao   = $request->tipo_movimentacao;
            $movimentacoes->valor               = $request->valor;
            $movimentacoes->observacao          = $request->observacao;
            $movimentacoes->func_id             = $request->func_id;
            $movimentacoes->user_id             = Auth::user()->id;
            $movimentacoes->save();

        }

        return redirect()
            ->route('movimentacoes')
            ->with('success', 'Inseção realizada com sucesso!');
    }
}
