<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\requests\createTaskRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Arr;


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

        $imageFile =file('image');


        $myTask = new Task;
        $myTask->title=$request->title;
        $myTask->description=$request->description;
        if(isset($imageFile)){
            $path = $request->$imageFile->store('uploads', 'public');
            $myTask->image=$path;
        }

        $myTask->save();



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
        $lines = explode("\n", $csvData);
        $rows = array();

        foreach ($lines as $line) {
            $rows[] = str_getcsv($line, ';');
        }

        $i = 0;

        foreach ($rows as $row) {

            if ((!isset($row[0])) && (!isset($row[1]))) {
                $row[0] = null;
                $row[1] = null;
            }

            $rows[$i] = ([
                'title' => $row[0],
                'description' => $row[1],
            ]);
            $i++;
        }

        unset($rows[count($rows)-1]);

        $task = new Task;
        $task->insert($rows);

        return redirect()->route('tasks.index');
    }

    public function export()
    {
        $table = Task::all();
        $output='';

        foreach ($table as $row) {
            $rows = $row->toArray();
            $rows = Arr::except($rows, ['id', 'created_at', 'updated_at']);
            $output.=  implode(";", $rows);
            $output.="\n";
        }

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="ExportFileName.csv"',
        );

        return response(rtrim($output, "\n"), 200, $headers);

    }
}
