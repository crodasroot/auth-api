<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::whereNull('parent_id')->with('children')->get();
        return response()->json($menus);
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string',
            'icon' => 'nullable|string',
            'parent_id' => 'nullable|exists:menus,id',
            'url' => 'nullable|string'
        ]);

        $menu = Menu::create($request->all());

        return response()->json($menu, 201);
    }
}
