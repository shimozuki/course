<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseBanner;

class CourseBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = CourseBanner::all();
        return view('course_banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course_banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        CourseBanner::create($request->all());

        return redirect()->route('course_banners.index')->with('success', 'Banner created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseBanner  $courseBanner
     * @return \Illuminate\Http\Response
     */
    public function show(CourseBanner $courseBanner)
    {
        return view('course_banners.show', compact('courseBanner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseBanner  $courseBanner
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseBanner $courseBanner)
    {
        return view('course_banners.edit', compact('courseBanner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseBanner  $courseBanner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseBanner $courseBanner)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $courseBanner->update($request->all());

        return redirect()->route('course_banners.index')->with('success', 'Banner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseBanner  $courseBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseBanner $courseBanner)
    {
        $courseBanner->delete();

        return redirect()->route('course_banners.index')->with('success', 'Banner deleted successfully.');
    }
}

