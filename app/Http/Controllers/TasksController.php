<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\requests\createTaskRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;


class TasksController extends Controller
{
    use ValidatesRequests;

    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(createTaskRequest $request)
    {
        Task::create($request->all());

        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $myTask = Task::find($id);

        return view('tasks.edit', ['task' => $myTask]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $myTask = Task::find($id);
        $myTask->fill($request->all());
        $myTask->save();

        return redirect()->route('tasks.index');
    }

    public function show($id)
    {
        $myTask = Task::find($id);

        return view('tasks.show', ['task' => $myTask]);
    }

    public function destroy($id)
    {
        Task::find($id)->delete();
        return redirect()->route('tasks.index');
    }

    public function import()
    {
        return view('tasks.import');
    }

    public function handleImport(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
        ]);

        $file = $request->file('file');
        $csvData = file_get_contents($file);
        //dd($csvData);
        $lines = explode(PHP_EOL, $csvData);
        $rows = array();

        foreach ($lines as $line) {
            $rows[] = str_getcsv($line,';');
        }
        
        $header = array_shift($rows);

        foreach ($rows as $row) {
            $row = array_combine($header, $row);

            Task::create([
                'title' => $row['title'],
                'description' => $row['description'],
            ]);

        }
        return redirect()->route('tasks.index');
    }
}
