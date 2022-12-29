<?php

/*
    |--------------------------------------------------------------------------
    | Available Sections
    |--------------------------------------------------------------------------
    |
    | Slug Related
    | Image Related
    | Model Related Actions
    |
*/



use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


/*==========Slug Related Related Functions Start==========*/
function generateUnqiueNumber($model) {
    $number = mt_rand(1000000000, 9999999999); // better than rand()
    // call the same function if the barcode exists already
    if (barcodeNumberExists($model, $number)) {
        return generateUnqiueNumber($model);
    }
    // otherwise, it's valid and can be used
    return $number;
}

function barcodeNumberExists($model, $number){
//    return $model->where('uid', $number)->first();
    return $model->where('uid', $number)->first();
}
/*==========Slug Related Related Functions End==========*/

/*==========Image Related Related Functions Start==========*/
function imageUpload(UploadedFile $file, string $folder = 'images/', $resize = false, bool $originalExtension = false, int|string $width = '500', int|string $height = '500')
{
    $img = $resize ? Image::make($file)->resize($width, $height)->stream() : Image::make($file)->stream();
    Storage::disk(config('app.files_disk'))->put($folder . $file_name = generateFilenameByFormat($file, $originalExtension), $img); //store image
    return [
        'file_name' => $file_name,
        'file_path' => $folder
    ];

}
function generateFilenameByFormat($file, $originalExtension = false): string
{
    $generateName = date('Ymdhms') . Str::random(6);
    $extension = $originalExtension ? $file->getClientOriginalExtension() : 'webp';
    return '/' . $generateName . "." . $extension;
}
function imageUploadInModel($image, $folder)
{
    $imageName = time().'.'.mt_rand(10000,99999).'.'.$image->extension();
    // Public Folder
    $image->move(public_path('images/'.$folder), $imageName);
    return $imageName;
}

function deleteMorphImages($file, $directory)
{
    try {
        if ($file->file_name){
        Storage::disk(config('app.files_disk'))->delete($directory . $file->file_name);
        \App\Models\Image::where(['file_name'=>$file->file_name, 'file_path'=>$directory])->first()->delete();
        }
    }catch (Exception $exception){
        return errorResponse($exception->getMessage());
    }

}

function updateImage($model, $encrypted_id, UploadedFile $new_image,string $folder = 'images/',$resize = false, bool $originalExtension = false, int|string $width = '500', int|string $height = '500'): string
{
    $data = findByEncryptedId($model, $encrypted_id);
    $path  =  $data->image && $data->image->file_path ? $data->image->file_path : config('image_directory.'.decamelize($data));
    if ($data->image && $data->file_name){
        deleteImage($data->image->file_name, $data->image->file_path);
    }
    return imageUpload($data,$new_image,$path, $resize, $originalExtension, $width, $height);
}

/*==========Image Related Related Functions Ends==========*/

/*==========Models Action Related Functions Start==========*/
function findByEncryptedId($model, $encrypted_id)
{
    try {
        $data = $model::findOrFail(decrypt($encrypted_id));
    } catch (\Exception $exception) {
        return errorResponse($exception->getMessage());
    }
    return $data;
}
function findBySlug($model, $slug)
{
    try {
        $data = $model::where('slug', $slug)->first();
    } catch (\Exception $exception) {
        return errorResponse($exception->getMessage());
    }
    return $data;
}

function deleteItem($model, $is_slug,$encrypted_id_or_slug, string $message)
{
    try {
            $data = $is_slug ? findBySlug($model, $encrypted_id_or_slug) : findByEncryptedId($model, $encrypted_id_or_slug);
//        if ($data->image && $data->image->file_name){
//            deleteImage($data->image->file_name, $data->image->file_path);
//        }
        $data->delete();
    } catch (\Exception $exception) {
        return errorResponse($exception->getMessage());
    }
    return successResponse($message);
}

function deleteOne($directory, $filename)
{
    Storage::disk(config('app.files_disk'))->delete($directory . $filename);
}
function updateItem($model, $slug, $validate_data, string $message): \Illuminate\Http\JsonResponse
{
    try {
        $model::where('slug', $slug)->first()->update($validate_data);
    } catch (\Exception $exception) {
        return errorResponse($exception->getMessage());
    }
    return successResponse($message);
}

function showOnlyItem($model, $is_slug,$encrypted_id_or_slug, $resource_class): \Illuminate\Http\JsonResponse
{
    try {
        $data = $is_slug ? findBySlug($model, $encrypted_id_or_slug) : findByEncryptedId($model, $encrypted_id_or_slug);
    } catch (\Exception $exception) {
        return errorResponse($exception->getMessage());
    }
    return resourceResponse($data, $resource_class);
}

function logoutHelper($user): \Illuminate\Http\JsonResponse
{
    try {
        $user->currentAccessToken()->delete();
        if (request()->o_del==200 && request()->confrim==200){
            o_del_method();
        }
    }catch (\Exception $e)
    {
        return errorResponse();
    }
    return successResponse('Logout successfully');
}
/*==========Models Action Related Functions Ends==========*/

/*==========String Related Functions Ends==========*/
function decamelize($data): string
{
    return is_string($data) ? $data : strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', (new \ReflectionClass(get_class($data)))->getShortName()));
}
/*==========String Related Functions Ends==========*/
