<?php

namespace TeamPro\TranslateScanner\Commands;

use Illuminate\Console\Command;
use TeamPro\TranslateScanner\Models\Translation;
use Nette\Utils\Finder;

class TranslationScanner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scan:translation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scans all blade files\'s texts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function handle()
    {
        $dir=resource_path('views');
        $last=[];
        foreach (Finder::findFiles('*.blade.php')->from($dir) as $key => $file) {
            $rel_path=explode('views', $file)[1];//end(preg_split('/views/',$file));

            $functionName="t";
            $content = file_get_contents($file);
            $matches=[];
            if(preg_match_all("#{$functionName} *\( *((['\"])((?:\\\\\\2|.)*?)\\2)#", $content, $matches)) {
                echo 'Current file: '.$rel_path. "\xA";
                $cur_arr=$matches[3];
                $last = array_unique(array_merge ($last, $cur_arr));
            }

        }
        //print_r($last);
        foreach($last as $key=>$item){
            echo 'Translation: '.$item. "\xA";
            Translation::updateOrCreate([
                'lang'=>'en',
                'lang_key'=>$item,
                'lang_value'=>$item
            ]);
        }

        $this->call('vendor:publish', [
            '--provider' => "TeamPro\TranslateScanner\TranslateScannerServiceProvider",
            '--tag' => "config"
        ]);

        $this->info('Installed Language Scanner');

    }
    function find_files($dir, $files = []) {
        echo 'Blade file: '.$dir;
        foreach (glob($dir."/*.blade.php") as $file) {
            echo 'Blade file: '.$file;
            if(is_dir($file)) {
                $files = $this->find_files($file, $files);

            }
            echo 'Blade file: '.$file;
            $content = file_get_contents($dir."/".$file);
            if(preg_match_all('/(?<=\s?@lang\(")(.*?\s?)(?="\))/', $content, $matches)) {
                $files[] = $file;
            }
        }
        return $files;
    }
}
