<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('uploads image', function () {
    Storage::fake('s3');
    // Generate a fake image file
    $file = UploadedFile::fake()->image('test.jpg');

    // Upload the image to Minio using Storage::put
    Storage::put('test.jpg', file_get_contents($file));

    // Check that the file was stored on Minio
    $exists = Storage::exists('test.jpg');
    $this->assertTrue($exists);
});
