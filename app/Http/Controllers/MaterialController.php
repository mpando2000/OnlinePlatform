<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Material;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function materialForm(SchoolClass $class, Subject $subject){
        return view('admin.materials.materialForm',[
            'subject' => $subject,
            'class' =>  $class
        ]);
    }
    public function addMaterial(Request $request,  SchoolClass $class, Subject $subject)
    {
    
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:document,link,video',
            'file' => 'required_if:type,document,video|mimes:pdf,docx,doc,zip,mp4,avi,mov|max:92160', // Allow PDF for documents and MP4 for videos
            'url' => 'nullable|url',
            'class_id' => 'required|exists:school_classes,id',
            'subject_id' => 'required|exists:subjects,id'
        ]);


        $filePath = null;
        $url = null;

        if ($request->type === 'document' || $request->type === 'video') {
            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('materials', 'public');
            }
        }


        if ($request->type === 'link') {
            $url = $request->url;
        }

        Material::create([
            'title' => $request->title,
            'type' => $request->type,
            'file_path' => $filePath,
            'url' => $url,
            'subject_id' => $subject->id,
            'class_id' => $class->id
        ]);
        return response()->json(['message' => 'Material uploaded successfully']);
    }

}
