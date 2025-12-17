<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

class MakeThumbnails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-thumbnails';

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
        $directory = storage_path('app/public/imported');
        $files = array_filter(scandir($directory), function($item) {
            if (in_array($item, ['.', '..'])) {
                return false;
            }
            if (preg_match('/\.[a-z]{1,}$/', $item) === false) {
                return false;
            }
            if (preg_match('/\_thumb\.[a-z]{3,}$/', $item)) {
                return false;
            }
            return true;
        });
        $bar = $this->output->createProgressBar(count($files));
        foreach ($files as $file) {
            if (! Storage::exists('imported/' . $this->getThumbnailFileName($file))) {
                $this->generateThumbnail('imported/' . $file);
            }
            $bar->advance();
        }
        $bar->finish();
        $this->output->write("\n");
    }
    

    protected function getThumbnailFileName($filename)
    {
        return preg_replace('/(\.[^.]+)$/', '_thumb.webp', $filename);
    }

    protected function generateThumbnail(string $originalPath): string
    {
        $disk = Storage::disk('public');
        $originalFullPath = $disk->path($originalPath);
        
        $img = ImageManager::gd()->read($originalFullPath)
            ->scale(height: 200)
            ->encode(new WebpEncoder(quality: 80));

        $thumbnailPath = preg_replace('/(\.[^.]+)$/', '_thumb.webp', $originalPath);
        $img->save($disk->path($thumbnailPath));

        return $thumbnailPath;
    }
}
