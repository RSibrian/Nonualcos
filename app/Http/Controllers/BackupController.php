<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use Artisan;
use Log;
use Storage;
use App\Activos;
class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        $files = $disk->files(config('laravel-backup.backup.name'));
        $backups = [];
        foreach ($files as $k => $f) {
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
              $backups[] = [
                  'file_path' => $f,
                  'file_name' => str_replace(config('laravel-backup.backup.name') . '/', '', $f),
                  'file_size' => $disk->size($f),
                  'last_modified' => $disk->lastModified($f),
              ];
            }
        }
        $backups = array_reverse($backups);
        return view('backups.index',compact('backups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        try {
            Artisan::call('backup:run');
            $output = Artisan::output();
            return redirect()->back();
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * download file backup
     */
     public function download($file_name)
     {
         $file = config('laravel-backup.backup.name') . '/' . $file_name;
         dd($file);
         $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
         if ($disk->exists($file)) {
             $fs = Storage::disk(config('laravel-backup.backup.destination.disks')[0])->getDriver();
             $stream = $fs->readStream($file);

             /*return \Response::stream(function () use ($stream) {
                 fpassthru($stream);
             }, 200, [
                 "Content-Type" => $fs->getMimetype($file),
                 "Content-Length" => $fs->getSize($file),
                 "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
             ]);*/

         } else {
             abort(404, "The backup file doesn't exist.");
         }
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
