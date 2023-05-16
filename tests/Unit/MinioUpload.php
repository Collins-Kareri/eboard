<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('uploads image', function () {
    Storage::fake('s3');
    // Generate a fake image file
    $file = UploadedFile::fake()->image('it.jpg');

    // Upload the image to Minio using Storage::put
    Storage::put('it.jpg', file_get_contents($file));

    // Check that the file was stored on Minio
    $exists = Storage::exists('it.jpg');
    $this->assertTrue($exists);
});
