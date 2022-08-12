<?php

namespace Omaicode\Admin\Form\Field;

use Illuminate\Support\Str;
use Modules\Media\Repositories\Interfaces\MediaRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MultipleImage extends MultipleFile
{
    use ImageField;

    /**
     * {@inheritdoc}
     */
    protected $view = 'admin::form.multiplefile';

    /**
     *  Validation rules.
     *
     * @var string
     */
    protected $rules = 'image';

    /**
     * Prepare for each file.
     *
     * @param UploadedFile $image
     *
     * @return mixed|string
     */
    protected function prepareForeach(UploadedFile $image = null)
    {
        $this->name = $this->getStoreName($image);

        $this->callInterventionMethods($image->getRealPath());

        /* return tap($this->upload($image), function () {
            $this->name = null;
        }); */

        /* Copied from single image prepare section and made necessary changes so the return
        value is same as before, but now thumbnails are saved to the disk as well. */

        $uuid = (string)Str::uuid();
        $this->name = $uuid.'.'.$image->getClientOriginalExtension();        

        $this->upload($image);
        $path = $this->uploadAndDeleteOriginalThumbnail($image);

        $media_class = 'Modules\Media\Repositories\Interfaces\MediaRepository';

        if(interface_exists($media_class)) {
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

        return $path;
    }
}
