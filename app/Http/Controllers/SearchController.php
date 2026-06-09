<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //

    public function search(Request $request)
    {
        // Validate the search input
        $query = $request->input('query');

        // Example search logic (modify as per your database models and requirements)
        // $results = User::where('name', 'LIKE', "%{$query}%")->get();

         // Example: Searching for users
         $results = User::where('name', 'LIKE', "%{$query}%")
         ->orWhere('email', 'LIKE', "%{$query}%")
         ->get();
       

        // Return search results to a view (you can create a search view for displaying results)
        return view('search.results', compact('results', 'query'));
    }
}
