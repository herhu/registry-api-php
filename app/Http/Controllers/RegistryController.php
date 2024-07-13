<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class RegistryController extends Controller
{
    public function __construct()
    {
        // Initialize the registry in the session if it does not exist
        if (!Session::has('registry')) {
            Session::put('registry', []);
            Log::info('Session initialized:', Session::all());
        } else {
            Log::info('Session loaded:', Session::all());
        }
    }

    public function add(Request $request)
    {
        $item = $request->input('item');
        $request->validate([
            'item' => 'required|alpha_num'
        ]);

        $registry = Session::get('registry');
        $registry[$item] = true;
        Session::put('registry', $registry);
        
        Log::info('Item added:', ['item' => $item, 'registry' => $registry]);

        return response()->json(['status' => 'OK']);
    }

    public function remove(Request $request)
    {
        $item = $request->input('item');
        $request->validate([
            'item' => 'required|alpha_num'
        ]);

        $registry = Session::get('registry');
        if (isset($registry[$item])) {
            unset($registry[$item]);
        }

        Session::put('registry', $registry);
        
        Log::info('Item removed:', ['item' => $item, 'registry' => $registry]);

        return response()->json(['status' => 'OK']);
    }

    public function check(Request $request)
    {
        $item = $request->input('item');
        $request->validate([
            'item' => 'required|alpha_num'
        ]);

        $registry = Session::get('registry');
        $exists = isset($registry[$item]);
        
        Log::info('Item check:', ['item' => $item, 'exists' => $exists]);

        return response()->json(['exists' => $exists]);
    }

    public function diff(Request $request)
    {
        $items = explode(',', $request->input('items'));
        $request->validate([
            'items' => 'required|regex:/^[a-zA-Z0-9, ]*$/'
        ]);

        $registry = Session::get('registry');
        $diff = array_diff($items, array_keys($registry));
        
        Log::info('Items diff:', ['submitted' => $items, 'diff' => $diff]);

        return response()->json(['diff' => $diff]);
    }

    public function invert()
    {
        $registry = Session::get('registry');
        $currentItems = array_keys($registry);

        // This should be defined according to your application's logic
        $allPossibleItems = ['item1', 'item2', 'item3']; 

        $inverted = array_diff($allPossibleItems, $currentItems);
        Session::put('registry', array_fill_keys($inverted, true));
        
        Log::info('Registry inverted:', ['inverted' => $inverted]);

        return response()->json(['status' => 'OK']);
    }

    // Method to set a session value
    public function setSession()
    {
        Session::put('test_key', 'test_value');
        return response()->json(['status' => 'Session set']);
    }

    // Method to get the session value
    public function getSession()
    {
        $value = Session::get('test_key', 'No session data');
        return response()->json(['test_key' => $value]);
    }
}
