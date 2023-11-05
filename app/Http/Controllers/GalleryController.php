<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\GalleryStoreRequest;
use App\Http\Requests\GalleryUpdateRequest;
use App\Http\Resources\GalleryResource;
use App\Models\Gallery;
use App\Services\GalleryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\SuccessMessage;
class GalleryController extends Controller
{
    use SuccessMessage;
    /**
     * Display a listing of the resource.
     */
    public function index(GalleryService $galleryService)
    {
        $gallery=$galleryService->getAllGalleries(5);
        return GalleryResource::collection($gallery);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryStoreRequest $request,GalleryService $galleryService)
    {
        try {
            DB::beginTransaction();
            $galleryService->create($request->validated());
            DB::commit();
            [$msg,$status] = array($this->getSuccessMessage('gallery'),Response::HTTP_CREATED);
            //            return redirect ('api/category');
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);

        }catch (\Exception $exception){
            DB::rollBack();
            [$msg,$status]=array($exception->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([$msg,$status]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryService $galleryService,GalleryUpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $galleryService->update($request->validated());
            DB::commit();
            [$msg,$status] = array($this->getUpdateSuccessMessage('gallery'),Response::HTTP_CREATED);
            //            return redirect ('api/category');
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);

        }catch (\Exception $exception){
            DB::rollBack();
            [$msg,$status]=array($exception->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([$msg,$status]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryService $galleryService,$id)
    {
        try {
            DB::beginTransaction();
            $galleryService->destroy($id);
            DB::commit();
            [$msg,$status] = array($this->getDestroySuccessMessage('gallery'),Response::HTTP_CREATED);
            //            return redirect ('api/category');
        }catch (CustomException $exception){
            DB::rollBack();
            [$msg,$status] = array($exception->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);

        }catch (\Exception $exception){
            DB::rollBack();
            [$msg,$status]=array($exception->getMessage('something went wrong'),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([$msg,$status]);
    }
    public function mediaImageUpload(Request $request){
        if ($request->hasFile('images')) {
            $uploadedFiles = $request->file('images');

            // Process and save each uploaded file
            foreach ($uploadedFiles as $file) {
                // You can store the file in the storage or public directory
                // Example: Storage::disk('public')->putFile('uploads', $file);

                // Or you can store it in the public directory
                $file->store('uploads', 'public');
            }

            return response()->json(['message' => 'Files uploaded successfully']);
        }

        return response()->json(['message' => 'No files were uploaded'], 400);
//        if ($request->hasFile('file')) {
//            $file = $request->file('file');
//            //$folder = public_path('images/gallery/'.$request->gallery_id);
//            $folder =  storage_path('/app/public/images');
//            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
//            $slider_image_success = $file->move($folder, $filename);
//            if ($slider_image_success) {
//                return response()->json([
//                    "status" => "success",
//                ], 200);
//            }else{
//                return response()->json([
//                    "status" => "error"
//                ], 400);
//            }
//
//        } else {
//            return response()->json('error: upload file not found.', 400);
//        }
    }
    public function allUploadedImages(): \Illuminate\Http\JsonResponse
    {
        $imagePath = 'public/images'; // Change this to the appropriate path where your images are stored in the public storage directory.
        $files = collect(File::files(storage_path('app/public/uploads')))->sortByDesc(function ($file) {
            return $file->getCTime();
        });
//        $files = Storage::files($imagePath);

        $images = [];
        foreach ($files as $file) {
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                $images[] = basename($file);
            }
        }

        return response()->json(['uploads' => $images]);
    }
    public function destroyImage($image)
    {
        if(Storage::exists("public/uploads/".$image)){
            Storage::delete("public/uploads/".$image);
        }else{
            return response("image not found");
        }
        return redirect('mediaManager');
    }
}
