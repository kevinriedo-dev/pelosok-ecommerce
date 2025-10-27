<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegionController extends Controller
{
    /**
     * Display a listing of regions
     */
    public function index()
    {
        $regions = Region::latest()->paginate(10);
        return view('regions.index', compact('regions'));
    }

    /**
     * Show form to create new region
     */
    public function create()
    {
        return view('regions.create');
    }

    /**
     * Store new region in database
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|max:255|unique:regions,name',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/regions'), $imageName);
            $validated['image'] = 'images/regions/' . $imageName;
        }

        // Save to database
        Region::create($validated);

        return redirect()->route('regions.index')
            ->with('success', 'Region created successfully!');
    }

    /**
     * Display single region
     */
    public function show(Region $region)
    {
        return view('regions.show', compact('region'));
    }

    /**
     * Show form to edit region
     */
    public function edit(Region $region)
    {
        return view('regions.edit', compact('region'));
    }

    /**
     * Update region in database
     */
    public function update(Request $request, Region $region)
    {
        // Validasi input (allow same name untuk region ini)
        $validated = $request->validate([
            'name' => 'required|max:255|unique:regions,name,' . $region->id,
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($region->image && file_exists(public_path($region->image))) {
                unlink(public_path($region->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/regions'), $imageName);
            $validated['image'] = 'images/regions/' . $imageName;
        }

        // Update database
        $region->update($validated);

        return redirect()->route('regions.index')
            ->with('success', 'Region updated successfully!');
    }

    /**
     * Delete region from database
     */
    public function destroy(Region $region)
    {
        // Delete image if exists
        if ($region->image && file_exists(public_path($region->image))) {
            unlink(public_path($region->image));
        }

        // Delete from database
        $region->delete();

        return redirect()->route('regions.index')
            ->with('success', 'Region deleted successfully!');
    }
}