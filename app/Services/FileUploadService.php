<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class FileUploadService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new GdDriver());
    }
    /**
     * Upload image/pdf/other file with optional resize/convert for images.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param array $options [
     *    'type' => 'webp'|'jpg'|'png'|'pdf'|null,
     *    'size' => ['width' => int, 'height' => int] (only for images),
     *    'previous' => 'old/file/path.ext' (optional for delete)
     * ]
     * @return array|null ['path' => 'folder/filename.ext', 'name' => 'filename.ext']
     */
    public function upload(UploadedFile $file, string $folder, array $options = []): ?array
    {
        $requestedType = $options['type'] ?? $file->getClientOriginalExtension();
        $extension = strtolower($requestedType);

        $filename = time() . '_' . Str::random(10) . '.' . $extension;
        $relativePath = $folder . '/' . $filename;

        if (!empty($options['previous'])) {
            Storage::disk('public')->delete($options['previous']);
        }

        $imageExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $originalExtension = strtolower($file->getClientOriginalExtension());

        // যদি ইমেজ হয়
        if (in_array($originalExtension, $imageExtensions)) {
            $image = $this->manager->read($file);

            if (!empty($options['size']['width']) && !empty($options['size']['height'])) {
                $image = $image->cover(
                    $options['size']['width'],
                    $options['size']['height']
                );
            }

            if ($extension !== $originalExtension) {
                switch ($extension) {
                    case 'webp':
                        $image = $image->toWebp(90);
                        break;
                    case 'jpg':
                    case 'jpeg':
                        $image = $image->toJpeg(90);
                        break;
                    case 'png':
                        $image = $image->toPng();
                        break;
                    default:
                        $image = $image->toJpeg();
                }

                Storage::disk('public')->put($relativePath, (string) $image);
            } else {
                $file->storeAs($folder, $filename, 'public');
            }
        } else {
            $file->storeAs($folder, $filename, 'public');
        }

        return [
            'path' => $relativePath,
            'name' => $filename,
        ];
    }

    /**
     * Delete file by path
     */
    public function delete(string $path): bool
    {
        return Storage::disk('public')->delete($path);
    }
}
