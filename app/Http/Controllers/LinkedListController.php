<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LinkedList;

class LinkedListController extends Controller
{
    private $linkedList;

    public function __construct()
    {
        $this->linkedList = new LinkedList();
        // Initialize with sample data
        $this->linkedList->insert(['id' => 1, 'first_name' => 'John', 'last_name' => 'Doe', 'email' => 'john@example.com']);
        $this->linkedList->insert(['id' => 2, 'first_name' => 'Mary', 'last_name' => 'Moe', 'email' => 'mary@example.com']);
        $this->linkedList->insert(['id' => 3, 'first_name' => 'July', 'last_name' => 'Dooley', 'email' => 'july@example.com']);
    }

    public function index()
    {
        $items = $this->linkedList->toArray();
        return view('welcome', compact('items'));
    }

    public function swap(Request $request)
    {
        $order = $request->input('order');
        $this->linkedList->rearrange(explode(',', $order));
        return redirect()->route('welcome.index');
    }
}