<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\MediaFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaLibraryPicker extends Component
{
    use WithFileUploads;

    public $isPickerMode = false;
    public $targetStatePath = null;

    public $search = '';
    public $uploads = [];
    public $selectedMediaId = null;
    
    // Edit form fields
    public $editTitle = '';
    public $editAltText = '';
    public $editCaption = '';
    public $editDescription = '';
    public $editUrl = '';

    // Cursor pagination
    public $mediaFiles = [];
    public $nextCursor = null;
    public $hasMore = true;

    protected $queryString = ['search' => ['except' => '']];

    public function mount()
    {
        $this->loadMedia(true);
    }

    public function updatedSearch()
    {
        $this->loadMedia(true);
    }

    public function loadMedia($reset = false)
    {
        if ($reset) {
            $this->mediaFiles = [];
            $this->nextCursor = null;
            $this->hasMore = true;
        }

        if (!$this->hasMore) {
            return;
        }

        $query = MediaFile::query()->orderBy('created_at', 'desc')->orderBy('id', 'desc');

        if (!empty($this->search)) {
            $term = '%' . $this->search . '%';
            $query->where(function($q) use ($term) {
                $q->where('filename', 'like', $term)
                  ->orWhere('original_name', 'like', $term)
                  ->orWhere('title', 'like', $term)
                  ->orWhere('alt_text', 'like', $term)
                  ->orWhere('caption', 'like', $term)
                  ->orWhere('description', 'like', $term)
                  ->orWhere('path', 'like', $term);
            });
        }

        $paginator = $query->cursorPaginate(100, ['*'], 'cursor', $this->nextCursor);

        $newItems = $paginator->items();
        
        foreach ($newItems as $item) {
            $this->mediaFiles[] = $item->toArray();
        }

        $this->nextCursor = $paginator->nextCursor()?->encode();
        $this->hasMore = $paginator->hasMorePages();
    }

    public function loadMore()
    {
        $this->loadMedia();
    }

    public function selectMedia($id)
    {
        $this->selectedMediaId = $id;
        $media = MediaFile::find($id);
        
        if ($media) {
            $this->editTitle = $media->title ?? '';
            $this->editAltText = $media->alt_text ?? '';
            $this->editCaption = $media->caption ?? '';
            $this->editDescription = $media->description ?? '';
            $this->editUrl = Storage::disk($media->disk)->url($media->path);
        }
    }

    public function saveMetadata()
    {
        if (!$this->selectedMediaId) return;

        $media = MediaFile::find($this->selectedMediaId);
        if ($media) {
            $media->update([
                'title' => $this->editTitle,
                'alt_text' => $this->editAltText,
                'caption' => $this->editCaption,
                'description' => $this->editDescription,
            ]);

            // Update local array to reflect changes immediately
            foreach ($this->mediaFiles as $key => $file) {
                if ($file['id'] == $media->id) {
                    $this->mediaFiles[$key]['title'] = $this->editTitle;
                    $this->mediaFiles[$key]['alt_text'] = $this->editAltText;
                    $this->mediaFiles[$key]['caption'] = $this->editCaption;
                    $this->mediaFiles[$key]['description'] = $this->editDescription;
                    break;
                }
            }

            session()->flash('message', 'Đã lưu thông tin thành công.');
        }
    }

    public function selectForField()
    {
        if (!$this->selectedMediaId || !$this->isPickerMode) return;
        
        $media = MediaFile::find($this->selectedMediaId);
        if ($media) {
            // Lưu relative path (vd: uploads/2026/09/file.png)
            // blade helper tự động thêm storage/ prefix khi render
            $this->dispatch('media-selected', path: $media->path, target: $this->targetStatePath);
        }
    }

    public function updatedUploads()
    {
        $this->validate([
            'uploads.*' => 'image|max:10240', // 10MB Max per file
        ]);

        $folderYear = date('Y/m');
        $uploadDir = 'uploads/' . $folderYear;

        foreach ($this->uploads as $file) {
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '-' . time() . '.' . $extension;
            
            $path = $file->storeAs($uploadDir, $filename, 'public');
            
            $media = MediaFile::create([
                'filename' => $filename,
                'original_name' => $originalName,
                'path' => $path,
                'disk' => 'public',
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'folder_year' => $folderYear,
                'uploaded_by' => auth()->id(),
            ]);
            
            // Insert at the beginning of the list
            array_unshift($this->mediaFiles, $media->toArray());
            $this->selectMedia($media->id);
        }

        $this->uploads = [];
        session()->flash('message', 'Tải ảnh lên thành công.');
    }

    public function render()
    {
        if ($this->isPickerMode) {
            return view('livewire.admin.media-library-picker');
        }
        return view('livewire.admin.media-library-picker')->layout('components.layouts.media-picker');
    }
}
