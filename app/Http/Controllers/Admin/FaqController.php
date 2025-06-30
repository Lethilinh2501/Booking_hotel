<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::withTrashed()
                  ->orderBy('id')
                  ->get();
                  
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
$request->validate([
        'question' => 'required|string',
        'answer' => 'required|string',
        'is_active' => 'required|boolean',
    ]);

    Faq::create($request->only(['question', 'answer', 'status', 'is_active']));

    return redirect()->route('admin.faqs.index')->with('success', 'Thêm câu hỏi thành công.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $this->validateRequest($request);
        
        $this->handleImageUpload($validated, $request, $faq);

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')
               ->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        
        return redirect()->route('admin.faqs.index')
               ->with('success', 'FAQ moved to trash.');
    }

    public function restore($id)
    {
        $faq = Faq::withTrashed()->findOrFail($id);
        $faq->restore();
        
        return redirect()->route('admin.faqs.index')
               ->with('success', 'FAQ restored successfully.');
    }

    public function forceDelete($id)
    {
        $faq = Faq::withTrashed()->findOrFail($id);
        
        $this->deleteImageIfExists($faq);
        
        $faq->forceDelete();
        
        return redirect()->route('admin.faqs.index')
               ->with('success', 'FAQ permanently deleted.');
    }

    /**
     * Validate the request data
     */
    protected function validateRequest(Request $request)
    {
        return $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);
    }

    /**
     * Handle image upload
     */
    protected function handleImageUpload(&$data, Request $request, $faq = null)
    {
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($faq && $faq->image) {
                Storage::disk('public')->delete($faq->image);
            }
            $data['image'] = $request->file('image')->store('faqs', 'public');
        } elseif ($request->has('remove_image')) {
            if ($faq && $faq->image) {
                Storage::disk('public')->delete($faq->image);
            }
            $data['image'] = null;
        }
    }

    

    /**
     * Delete image if exists
     */
    protected function deleteImageIfExists(Faq $faq)
    {
        if ($faq->image) {
            Storage::disk('public')->delete($faq->image);
        }
    }
}