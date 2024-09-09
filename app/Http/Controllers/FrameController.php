<?php

namespace App\Http\Controllers;

use App\Models\Frame;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
class FrameController extends Controller
{
    public function index()
    {
        $frameCount = Frame::count();

        $frames = Frame::get();

        return view('frame.list',['frameCount' => $frameCount,'frames' =>$frames]);
    }

    public function create()
    {
        return view('frame.create');
    }

    public function preview(Request $request)
    {
        $left = $request->left != null ? $request->left : 10;
        $top = $request->top != null ? $request->top : 80;
        
        $newFrame = $request->file('frame');
    
        $manager = new ImageManager(['driver' => 'imagick']);

        // Load the frame
        $frame = $manager->make($newFrame);

        $fontPath = public_path('assets/fonts/Nunito/Nunito-Regular.ttf'); // Ensure this path is correct

        $doctor_name = "Dr. John";
        $speciality = "orthopedic";
        $place = "Paris";
        $frame->text($doctor_name, 450, 1210, function ($font) use ($fontPath) {
            $font->file($fontPath); // Ensure this path is correct
            $font->size(48);
            $font->color('#000000');
            $font->align('center');
            $font->valign('middle');
        });

        $frame->text($speciality, 450, 1260, function ($font) use ($fontPath) {
            $font->file($fontPath); // Ensure this path is correct
            $font->size(36); // Adjust size if needed
            $font->color('#000000');
            $font->align('center');
            $font->valign('middle');
        });

        $frame->text($place, 450, 1300, function ($font) use ($fontPath) {
            $font->file($fontPath); // Ensure this path is correct
            $font->size(36); // Adjust size if needed
            $font->color('#000000');
            $font->align('center');
            $font->valign('middle');
        });


        // Load the uploaded image
        $uploadedImage = public_path('img/preview.jpg');
        $image = $manager->make($uploadedImage);

        // Get dimensions of the frame
        $frameWidth = $frame->width();
        $frameHeight = $frame->height();

        // Resize the image to cover the frame dimensions while maintaining aspect ratio
        $image->resize($frameWidth, $frameHeight, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Create a new canvas with the same size as the frame
        $canvas = $manager->canvas($frameWidth, $frameHeight);


        // Assuming the image should cover the entire frame
        // Insert the resized image onto the canvas
        $canvas->insert($image, 'center', $left, $top);

        // Insert the frame on top of the canvas
        $canvas->insert($frame, 'top-left');

        $base64Image = (string) $canvas->encode('data-url');

        return response()->json(['message' => 'Image successfully processed', 'image' => $base64Image]);
    }

    public function store(Request $request){
        $max = getFileSizeInBytes(ini_get('upload_max_filesize')) / 1024;
        $request->validate([
            'frame' => 'required|mimes:png|max:'.$max,
        ]);

        $lastFrame = Frame::orderBy('id', 'desc')->first();
        $nextFrameNumber = $lastFrame ? $lastFrame->right + 1 : 1; // Default to 1 if no frames exist

        $fileName = time() . '.' . $request->frame->getClientOriginalExtension();
        $request->frame->move(public_path('frame'), $fileName);
        
        $request['frame'] = $fileName;
        $data = [
            'frame' => $fileName,
            'top' => $request->top,
            'left' => $request->left,
            'right' => $nextFrameNumber,
        ];
        $frame = new Frame;
        $frame->fill($data);
        $frame->save();

        return redirect()->route('frame')->with("message", 'Frame Uploaded successfully.');
    }

    public function edit($id){
        $frame = Frame::findOrFail($id);
        return view('frame.edit',['frame' => $frame]);
    }

    public function update(Request $request){
        $max = getFileSizeInBytes(ini_get('upload_max_filesize')) / 1024;
        $request->validate([
            'frame' => 'required|mimes:png|max:'.$max,
        ]);

        if(isset($request->frame) && $request->frame != null){
            $oldFilePath = public_path('frame/' . $request->old_frame);
            unlink($oldFilePath);
            $fileName = time() . '.' . $request->frame->getClientOriginalExtension();
            $request->frame->move(public_path('frame'), $fileName);
        }else{
            $fileName = $request->old_frame;
        }
        $data = [
            'frame' => $fileName,
            'top' => $request->top,
            'left' => $request->left,
        ];

        Frame::where('id','=',$request->id)->update($data);

        return redirect()->route('frame')->with("message", 'Frame Uploaded successfully.');
    }
}
