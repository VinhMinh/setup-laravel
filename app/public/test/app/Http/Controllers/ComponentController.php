<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Component;

class ComponentController extends Controller
{
    public function create()
    {
        return view('components.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer',
        ]);

  
        $imagePath = null;
        if ($request->hasFile('image')) {

            $imageName = Str::slug($request->input('title')) . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->move(public_path('images'), $imageName);
            $url = asset('images/' . $imageName);
        }

        Component::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $url,
            'order' => $request->input('order'),
        ]);

        return redirect()->route('component.create')->with('success', 'Create.');
    }

    public function getAllComponent()
    {
        $posts = Component::all();
        
        return view('components.view',compact('posts'));
    }
}
