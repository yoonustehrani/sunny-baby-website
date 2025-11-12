<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

trait HandleImageIdInFilament
{
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!empty($data['uploaded_image'])) {
            // Optional: delete old image and thumbnail
            if (isset($this->record) && $this->record->image) {
                Storage::disk('public')->delete(
                    array_map(fn(string $path) => str_replace('storage/', '', $path),
                    [$this->record->image->url, $this->record->image->thumbnail_url])
                );
                $this->record->image->delete();
            }

            $storedPath = $data['uploaded_image'];
            $thumbnailPath = $this->generateThumbnail($storedPath);

            $image = Image::create([
                'url' => 'storage/' . $storedPath,
                'thumbnail_url' => 'storage/' . $thumbnailPath,
            ]);

            $data['image_id'] = $image->id;
            unset($data['uploaded_image']);
        }

        return $data;
    }

    protected function generateThumbnail(string $originalPath): string
    {
        $disk = Storage::disk('public');
        $originalFullPath = $disk->path($originalPath);

        $img = ImageManager::gd()->read($originalFullPath)
            ->encode(new WebpEncoder(quality: 10));
            // ->resize(300, 300, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // });

        $thumbnailPath = preg_replace('/(\.[^.]+)$/', '_thumb.webp', $originalPath);
        $img->save($disk->path($thumbnailPath));

        return $thumbnailPath;
    }
}
