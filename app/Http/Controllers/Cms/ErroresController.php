<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
// https://github.com/rap2hpoutre/laravel-log-viewer/blob/master/src/views/log.blade.php

class ErroresController extends Controller
{
    private $levels_classes = [
        'debug' => 'info',
        'info' => 'info',
        'notice' => 'info',
        'warning' => 'warning',
        'error' => 'danger',
        'critical' => 'danger',
        'alert' => 'danger',
        'emergency' => 'danger',
        'processed' => 'info',
        'failed' => 'warning'
    ];

    private $levels_imgs = [
        'debug' => 'info-circle',
        'info' => 'info-circle',
        'notice' => 'info-circle',
        'warning' => 'exclamation-triangle',
        'error' => 'exclamation-triangle',
        'critical' => 'exclamation-triangle',
        'alert' => 'exclamation-triangle',
        'emergency' => 'exclamation-triangle',
        'processed' => 'info-circle',
        'failed' => 'exclamation-triangle'
    ];

    private $log_levels = [
        'emergency',
        'alert',
        'critical',
        'error',
        'warning',
        'notice',
        'info',
        'debug',
        'processed',
        'failed'
    ];

    const MAX_FILE_SIZE = 8523512; // Why? Uh... Sorry Aprox. 8 MB

    public function __construct() 
    {
        $this->middleware('CMSAuthenticate');
    }

    public function index()
    {
        return view('cms.errores.index');
    }

    public function getLogErrores()
    {
        $log = array();
        $pattern = '/\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}([\+-]\d{4})?\].*/';

        $archivos = $this->getFiles();
        if(!count($archivos)) { return []; }
        //dd($archivos);

        foreach ($archivos as $archivo) {

            $file = File::get($archivo);
            if (File::size($archivo) > self::MAX_FILE_SIZE) { continue; }
            preg_match_all($pattern, $file, $headings);
            if (!is_array($headings)) { continue; }
            $log_data = preg_split($pattern, $file);
            if ($log_data[0] < 1) { array_shift($log_data); }

            foreach ($headings as $h) {
                for ($i=0, $j = count($h); $i < $j; $i++) {
                    foreach ($this->log_levels as $level) {
                        if (strpos(strtolower($h[$i]), '.' . $level) || strpos(strtolower($h[$i]), $level . ':')) {
                            preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}([\+-]\d{4})?)\](?:.*?(\w+)\.|.*?)' . $level . ': (.*?)( in .*?:[0-9]+)?$/i', $h[$i], $current);
                            if (!isset($current[4])) continue;
                            $log[] = array(
                                'context' => $current[3],
                                'level' => $level,
                                'level_class' => $this->levels_classes[$level],
                                'level_img' => $this->levels_imgs[$level],
                                'date' => $current[1],
                                'text' => $current[4],
                                'in_file' => isset($current[5]) ? $current[5] : null,
                                'archivo' => $archivo,
                                'stack' => mb_convert_encoding(preg_replace("/^\n*/", '', $log_data[$i]), 'UTF-8', 'UTF-8')   
                            );
                        }
                    }
                }
            }

        }

        //

        return response()->json(array_reverse($log));
    }

    protected function getFiles($basename = false)
    {
        $files = glob(storage_path() . '/logs/*.log');
        $files = array_reverse($files);
        $files = array_filter($files, 'is_file');
        if ($basename && is_array($files)) {
            foreach ($files as $k => $file) {
                $files[$k] = basename($file);
            }
        }
        return array_values($files);
    }
}
