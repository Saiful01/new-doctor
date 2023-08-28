<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Resources\Admin\BlogResource;
use App\Models\Blog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BlogResource(Blog::all());
    }

    public function store(StoreBlogRequest $request)
    {
        $blog = Blog::create($request->all());

        if ($request->input('featured_image', false)) {
            $blog->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        foreach ($request->input('files', []) as $file) {
            $blog->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
        }

        return (new BlogResource($blog))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Blog $blog)
    {
        abort_if(Gate::denies('blog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BlogResource($blog);
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $blog->update($request->all());

        if ($request->input('featured_image', false)) {
            if (! $blog->featured_image || $request->input('featured_image') !== $blog->featured_image->file_name) {
                if ($blog->featured_image) {
                    $blog->featured_image->delete();
                }
                $blog->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($blog->featured_image) {
            $blog->featured_image->delete();
        }

        if (count($blog->files) > 0) {
            foreach ($blog->files as $media) {
                if (! in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $blog->files->pluck('file_name')->toArray();
        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $blog->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
            }
        }

        return (new BlogResource($blog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Blog $blog)
    {
        abort_if(Gate::denies('blog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blog->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
