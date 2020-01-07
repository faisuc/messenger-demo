<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use View;

class SearchController extends Controller
{
    protected $privacy;
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index()
    {
        $users = [];
        $query_string =  str_replace( ['%', '<', '>'],  '', $this->request->input('query'));
        if(!empty($query_string) && $query_string != null && strlen($query_string) >= 3) {
                $users = User::query()->where('firstName', 'LIKE', "%{$query_string}%")
                    ->orWhere('lastName', 'LIKE', "%{$query_string}%")
                    ->orWhere('email', $query_string)
                    ->with(['info'])
                    ->get();
        }
        return View::make('search', compact('users'));
    }
}

