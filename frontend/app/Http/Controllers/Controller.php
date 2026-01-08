<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

abstract class Controller
{
    public function create()
    {
        return view('home.create');
    }

    public function store(Request $request)
    {
        $baseUrl = 'http://localhost:8000';

        $request->validate([
            'id' => ['required', 'regex:/^\S+$/'],
            'name' => ['required'],
            'description' => ['required'],
        ]);

        $payload = [
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ];

        $response = Http::post($baseUrl . '/api/Category', $payload);

        if ($response->successful()) {
            $body = $response->json();
            $message = isset($body['message']) ? $body['message'] : 'Category created successfully';

            return redirect()->route('home.index')->with('success', $message);
        }

        return back()->withInput()->with('error', 'Gagal membuat category');
    }
}
