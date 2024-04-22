<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        // ジャンルデータを取得
        $genreData = Genre::all();

        return response()->json($genreData, 200);
    }

    public function show($id)
    {
        // 特定のIDに対応するジャンルを取得
        $genre = Genre::findOrFail($id);

        return response()->json($genre, 200);
    }
}
