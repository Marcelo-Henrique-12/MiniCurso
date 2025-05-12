<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosClienteController extends Controller
{

    public function index()
    {
        $produtos = Produto::with('categoria')->get();
        return view('cliente.produtos.index', compact('produtos'));
    }


}
