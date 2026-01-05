<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\NestedFileRule;
use Illuminate\Validation\Rules\File;

Route::redirect('/', '/bypass');

Route::view('/test', 'test');

Route::post('/test', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'attachments' => ['array'],
        'attachments.*.file' => ['required', new NestedFileRule],
    ]);

    return response()->json([
        'passes' => $validator->passes(),
        'errors' => $validator->errors(),
    ]);
});

Route::get('/bypass/sample', function () {
    $jpegBase64 = <<<'BASE64'
/9j/4AAQSkZJRgABAQEAYABgAAD//gA+Q1JFQVRPUjogZ2QtanBlZyB2MS4wICh1c2luZyBJSkcg
SlBFRyB2ODApLCBkZWZhdWx0IHF1YWxpdHkK/9sAQwAIBgYHBgUIBwcHCQkICgwUDQwLCwwZEhMP
FB0aHx4dGhwcICQuJyAiLCMcHCg3KSwwMTQ0NB8nOT04MjwuMzQy/9sAQwEJCQkMCwwYDQ0YMiEc
ITIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIy/8AAEQgA
AQABAwEiAAIRAQMRAf/EAB8AAAEFAQEBAQEBAAAAAAAAAAABAgMEBQYHCAkKC//EALUQAAIBAwMC
BAMFBQQEAAABfQECAwAEEQUSITFBBhNRYQcicRQygZGhCCNCscEVUtHwJDNicoIJChYXGBkaJSYn
KCkqNDU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6g4SFhoeIiYqSk5SVlpeY
mZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2drh4uPk5ebn6Onq8fLz9PX29/j5
+v/EAB8BAAMBAQEBAQEBAQEAAAAAAAABAgMEBQYHCAkKC//EALURAAIBAgQEAwQHBQQEAAECdwAB
AgMRBAUhMQYSQVEHYXETIjKBCBRCkaGxwQkjM1LwFWJy0QoWJDThJfEXGBkaJicoKSo1Njc4OTpD
REVGR0hJSlNUVVZXWFlaY2RlZmdoaWpzdHV2d3h5eoKDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ip
qrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uLj5OXm5+jp6vLz9PX29/j5+v/aAAwDAQACEQMR
AD8ASiiigD//2Q==
BASE64;
    $content = base64_decode($jpegBase64);

    return response($content, 200, [
        'Content-Type' => 'image/jpeg',
        'Content-Disposition' => 'attachment; filename="text_as_jpg.jpg"',
    ]);
});

Route::view('/bypass', 'bypass');

Route::post('/bypass', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'files' => ['array'],
        'files.*' => [File::types(['image/png'])],
    ]);

    return response()->json([
        'passes' => $validator->passes(),
        'errors' => $validator->errors(),
    ]);
});
