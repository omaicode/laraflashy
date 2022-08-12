<?php

namespace Omaicode\Admin\Form\Field;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use ReflectionException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Image extends File
{
    use ImageField;

    protected $directory = 'uploads/images';

    /**
     * {@inheritdoc}
     */
    protected $view = 'admin::form.file';

    /**
     *  Validation rules.
     *
     * @var string
     */
    protected $rules = 'image';

    /**
     * @param array|UploadedFile $image
     *
     * @return string
     */
    public function prepare($image)
    {
        if ($this->picker) {
            return parent::prepare($image);
        }

        if (request()->has(static::FILE_DELETE_FLAG)) {
            return $this->destroy();
        }

        $uuid = (string)Str::uuid();
        $this->name = $uuid.'.'.$image->getClientOriginalExtension();

        $this->callInterventionMethods($image->getRealPath());

        $path = $this->uploadAndDeleteOriginal($image);

        $this->uploadAndDeleteOriginalThumbnail($image);

        try {
            $media_class = 'Modules\\Media\\Repositories\\Interfaces\\MediaRepository';
            if(class_exists($media_class)) {
                app($media_class)->create([
                    'disk' =>  config('admin.extensions.media-manager.disk', 'public'),
                    'uuid' => $uuid,
                    'path' => $this->getDirectory(),
                    'file_name' => $this->name,
                    'extension' => $image->getClientOriginalExtension(),
                    'mime'      => $image->getMimeType(),
                    'size'      => $image->getSize()
                ]);
        
                return $uuid;
            }
        } catch(ReflectionException $e) {
            Log::error("MediaRepository does not exists. Skipping...");
        }

        return $path;
    }

    /**
     * force file type to image.
     *
     * @param $file
     *
     * @return array|bool|int[]|string[]
     */
    public function guessPreviewType($file)
    {
        $extra = parent::guessPreviewType($file);
        $extra['type'] = 'image';

        return $extra;
    }
}
