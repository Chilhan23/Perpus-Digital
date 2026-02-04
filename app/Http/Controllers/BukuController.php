<?php

namespace App\Http\Controllers;
use App\Models\Books;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $books = Books::latest()->Filter(request(['keyword','category','author']))->paginate(9)->withQueryString();
        if(Auth::user()->is_admin){
            return view('admin.book',compact('books'));
        }
       return redirect()->back()->with('error', 'Anda tidak memiliki akses kesini.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|min:3',
            'code' => 'required|min:5',
            'penulis' => 'required|min:3',
            'category_id' => 'required',
            'tahun_terbit' => 'required',
            'body' => 'nullable'
        ]);
    
        Books::create($validated);
        return redirect()->route('buku.index')->with('success', 'Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $buku = Books::all();
        // $bukudetail = Books::findOrfail($id);
        // return view('buku.index',compact('bukudetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $validated = $request->validate([
        'judul' => 'required|min:3',
        'code' => 'required|min:4',
        'penulis' => 'required|min:3',
        'category_id' => 'required',
        'tahun_terbit' => 'required',
        'body' => 'nullable'
    ]);

    $book = Books::findOrFail($id);


    $book->update($validated);

    return redirect()->route('buku.index')->with('success', 'Buku berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bukudetail = Books::findOrfail($id);
        $bukudetail->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
    }
}
