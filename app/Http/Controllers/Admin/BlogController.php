<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBlogRequest;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blogs = Blog::with(['media'])->get();

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        abort_if(Gate::denies('blog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.blogs.create');
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

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $blog->id]);
        }

        return redirect()->route('admin.blogs.index');
    }

    public function edit(Blog $blog)
    {
        abort_if(Gate::denies('blog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.blogs.edit', compact('blog'));
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

        return redirect()->route('admin.blogs.index');
    }

    public function show(Blog $blog)
    {
        abort_if(Gate::denies('blog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.blogs.show', compact('blog'));
    }

    public function destroy(Blog $blog)
    {
        abort_if(Gate::denies('blog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blog->delete();

        return back();
    }

    public function massDestroy(MassDestroyBlogRequest $request)
    {
        $blogs = Blog::find(request('ids'));

        foreach ($blogs as $blog) {
            $blog->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('blog_create') && Gate::denies('blog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Blog();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
