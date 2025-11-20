<?php

namespace App\Console\Commands;

use App\CSVReader;
use App\Models\Image;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DownloadListOfFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:download-list-of-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $csv = new CSVReader(database_path('seeders/data/images.csv'), [])
            ->read();
        $urls = array_map(fn($r) => $r['url'], $csv->getData());
        $this->output->write("Processing " . count($urls) . " urls", true);
        if (! Storage::directoryExists('imported')) {
            Storage::makeDirectory('imported');
        }
        $bar = $this->output->createProgressBar(count($urls));
        foreach ($urls as $url) {
            $path = get_url_path($url);
            $filename = substr(str_replace('/', '-', $path), 1, strlen($path));
            if (Storage::fileExists('imported/' . $filename)) {
                $this->output->write('existed.', true);
                usleep(300);
                $this->remove_upper_line();
                if (Image::where('url', 'like', '%imported/' . $filename)->limit(1)->exists()) {
                    $this->output->write('skipping ...', true);
                    usleep(300);
                    $this->remove_upper_line(); 
                } else {
                    $this->output->write('inserting to DB ...', true);
                    new Image([
                        'url' => 'storage/imported/' . $filename,
                        'thumbnail_url' => 'storage/imported/' . preg_replace('/(\.[^.]+)$/', '_thumb.webp', $filename)
                    ])->save();
                    usleep(300);
                    $this->remove_upper_line(); 
                }
                $bar->advance();
                continue;
            }
            $this->output->write('downloading ...', true);
            $response = Http::get($url);
            if ($response->ok()) {
                Storage::put('imported/' . $filename, $response->body());
                usleep(300);
                $this->remove_upper_line();
                $bar->advance();
            } else {
                $this->remove_upper_line();
                $this->output->write('failed.', true);
                usleep(300);
                $this->remove_upper_line();
            }
        }
        $bar->finish();
        $this->newLine();
    }

    protected function remove_upper_line()
    {
        $this->output->write("\033[1A");  // Move cursor up one line
        $this->output->write("\033[2K");
    }
}
