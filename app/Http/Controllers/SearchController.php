<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataMahasiswa;

class SearchController extends Controller
{
    public function index(string $query, Request $request)
    {
        $searchQuery = urldecode($query);
        $keywords = array_filter(explode(' ', $searchQuery));

        $results = DataMahasiswa::query();
        
        if (!empty($keywords)) {
            $results->where(function ($q) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $q->orWhere('nim', 'like', '%' . $keyword . '%')
                      ->orWhere('nama', 'like', '%' . $keyword . '%')
                      ->orWhere('jenjang_prodi', 'like', '%' . $keyword . '%');
                }
            });
        }

        $results = $results->paginate(6)->withQueryString();

        return view('search', [
            'searchQuery' => $searchQuery,
            'keywords' => $keywords,
            'results' => $results,
            'totalResults' => $results->total(),
        ]);
    }
}
