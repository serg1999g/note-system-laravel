<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use App\Task;
use App\Image;
use App\Http\Requests\createTaskRequest;
use App\Http\Requests\CreateCsvFileRequest;
use Illuminate\Support\Str;


class TasksController extends Controller
{
    public function index(): Renderable
    {
        $tasks = Task::query()->paginate(20);

        foreach($tasks as $task){
            $task->limit = Str::limit($task->description, 200);
        }

        return view('tasks.index', compact('tasks'));
    }

    public function create(): Renderable
    {
        return view('tasks.create');
    }

    public function store(createTaskRequest $request): RedirectResponse
    {
        $task = new Task();
        $task->title        = $request->input('title');
        $task->description  = $request->input('description');
        $task->save();

        $taskId =$task->id;
        $files = [];

        for ($i=1; $i <= 5; $i++) {
            $imageFile = $request->file('image-'. $i);

            if(!isset($imageFile)){
                break;
            }

            $files[] = [
                'task_id' => $taskId,
                'images' => $imageFile->store($taskId, 'public')
            ];
        }

        $image = new Image();
        $image->insert($files);

        return redirect()->route('tasks.index');
    }

    public function edit($id): Renderable
    {
        $task = Task::query()->find($id);

       return view('tasks.edit', ['task' => $task]);
    }

    public function update(createTaskRequest $request, int $id): RedirectResponse
    {
        $task = Task::query()->find($id);
        $task->fill($request->all());
        $task->save();

        $taskId =$task->id;
        $files = [];

        for ($i=1; $i <= 5; $i++) {
            $imageFile = $request->file('image-'. $i);

            if(!isset($imageFile)){
                continue;
            }

            $files[] = [
                'task_id' => $taskId,
                'images' => $imageFile->store($taskId, 'public')
            ];
        }

        $image = new Image();
        $image->insert($files);

        return redirect()->route('tasks.index');
    }

    public function show(int $id): Renderable
    {
        $task = Task::query()->find($id);

        return view('tasks.show', ['task' => $task]);
    }

    public function destroy($id): RedirectResponse
    {
        Task::query()->find($id)->delete();

        return redirect()->route('tasks.index');
    }

    public function DeleteImage(int $id)
    {
        $imageId = Image::query()->find($id)->images;
        Image::query()->where('id', $id)->delete();

        $path = public_path() . "/../storage/app/public/" . $imageId;
        unlink($path);
    }

    public function import()
    {
        return view('tasks.import');
    }

    public function handleImport(CreateCsvFileRequest $request): RedirectResponse
    {
        $file = $request->file('file');
        $csvData = file_get_contents($file);
        $lines = explode("\n", $csvData);
        $rows = [];

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

        $task = new Task();
        $task->insert($rows);

        return redirect()->route('tasks.index');
    }


    public function export()
    {
        $headers = [
            'id',
            'title',
            'description'
        ];

        $file = fopen('php://output', 'w');

        header("Content-Disposition:attachment; filename=ExportFileName.csv");
        header('Content-Type:text/csv');

        fputcsv($file, $headers, ';');

        Task::query()
            ->select($headers)
            ->chunk(1000, function ($records) use ($file) {
                foreach ($records as $record) {
                    fputcsv($file, $record->toArray(), ';');
                }
            });

        fclose($file);
    }
}
