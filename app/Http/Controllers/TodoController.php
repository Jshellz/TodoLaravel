<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * created view
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function index()
    {
        $todos = ToDo::all();

        return view('todos.index', compact('todos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * created view
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Todo::create($request->all());

        return redirect()->route('todos.index')
            ->with('success', 'Todo created successfully.');
    }

    /**
     * created view
     * @param ToDo $todo
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function show(Todo $todo)
    {
        return view('todos.show', compact('todo'));
    }

    /**
     * created view
     * @param ToDo $todo
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    /**
     * @param Request $request
     * @param ToDo $todo
     * @return RedirectResponse
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $todo->update($request->all());

        return redirect()->route('todos.index')
            ->with('success', 'Todo updated successfully');
    }

    /**
     * @param ToDo $todo
     * @return RedirectResponse
     */
    public function delete(ToDo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index')
            ->with('success', 'Todo deleted successfully');
    }
}
