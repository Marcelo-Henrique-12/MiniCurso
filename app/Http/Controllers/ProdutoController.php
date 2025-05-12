<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::with('categoria')->get();
        return view('admin.produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.produtos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdutoRequest $request)
    {
        $data = $request->validated();
        DB::transaction(function () use ($data, $request) {
            $produto = Produto::create($data);

            if ($request->foto) {
                $produto->foto = $request->file('foto')->store("produtosFotos/{$produto->id}", 'public');
                $produto->save();
            }
        });
        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        $categorias = Categoria::all();
        return view('admin.produtos.edit', compact('produto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdutoRequest $request, Produto $produto)
    {
        $data = $request->validated();
        DB::transaction(function () use ($data, $produto, $request) {
            $produto->update($data);

            if ($request->foto) {
                Storage::delete($produto->foto);
                $produto->foto = $request->file('foto')->store("produtosFotos/{$produto->id}", 'public');
                $produto->save();
            }
        });
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        DB::transaction(function () use ($produto) {
            Storage::delete($produto->foto);
            $produto->delete();
        });
        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }
}
