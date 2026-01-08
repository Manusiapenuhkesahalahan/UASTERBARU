<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    private $baseUrl = 'http://localhost:8000/api/Category';

    public function index()
    {
        $Category = []; 
        $response = Http::get($this->baseUrl);

        if ($response->successful()) {
            $body = $response->json();
            $Category = $body['data'] ?? [];
        }

        return view('home.index', [
            'Category' => $Category,
        ]);
    }

    public function create()
    {
        // Mengarahkan ke resources/views/home/create.blade.php
        return view('home.create');
    }

    public function store(Request $request)
{
    $response = Http::post($this->baseUrl, $request->all());
    $result = $response->json();

    if ($response->successful()) {
        return redirect()->route('home.index')->with('success', 'Kategori berhasil ditambah');
    }

    // Jika terjadi validation failed (biasanya error 422)
    if (isset($result['errors'])) {
        // Mengirim pesan error spesifik dari API kembali ke form
        return redirect()->back()
            ->withErrors($result['errors']) 
            ->withInput();
    }

    return redirect()->back()->with('error', $result['message'] ?? 'Gagal menambah kategori');
}

    public function destroy($id)
    {
        // Menghapus data via API
        $response = Http::delete($this->baseUrl . '/' . $id);

        if ($response->successful()) {
            return redirect()->route('home.index')->with('success', 'Kategori berhasil dihapus');
        }

        return redirect()->route('home.index')->with('error', 'Gagal menghapus kategori');
    }
}