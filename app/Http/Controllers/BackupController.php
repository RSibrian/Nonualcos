<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use Artisan;
use Log;
use Storage;
use App\Activos;
use App\Helpers\Helper;
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
                  'file_size' => Helper::humanReadableSize($disk->size($f)),
                  'last_modified' => Helper::getDate($disk->lastModified($f)),
              ];
            }
        }
        $backups = array_reverse($backups);
        //dd($files);
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
            Artisan::call('backup:run',['--only-db'=>true]);

            return redirect()->back()->with('create','Se ha creado con éxito el back up de la base de datos');
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }
    public function createComplete()
   {
       try {
           Artisan::call('backup:run');

           return redirect()->back()->with('create','Se ha creado con éxito el back up del sistema');
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
         $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
         if ($disk->exists($file)) {
             $fs = Storage::disk(config('laravel-backup.backup.destination.disks')[0])->getDriver();
             $stream = $fs->readStream($file);
             return \Response::stream(function () use ($stream) {
                 fpassthru($stream);
             }, 200, [
                 "Content-Type" => $fs->getMimetype($file),
                 "Content-Length" => $fs->getSize($file),
                 "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
             ]);
         } else {
             abort(404, "The backup file doesn't exist.");
         }
     }

     public function delete($file_name)
        {
            $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
            if ($disk->exists(config('laravel-backup.backup.name') . '/' . $file_name)) {
                $disk->delete(config('laravel-backup.backup.name') . '/' . $file_name);
                return redirect()->back()->with('sin_pass','Se ha borrado el archivo');
            } else {
                abort(404, "The backup file doesn't exist.");
            }
        }
}
