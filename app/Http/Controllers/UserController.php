<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Frame;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Response;
use PDF;
use Hash;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\ImageManager;
use Intervention\Image\Typography\FontFactory;


class UserController extends Controller
{
    public function index()
    {
        $usersQuery = User::with('roles')->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'Admin');
        });

        // Paginate the filtered results
        $users = $usersQuery->paginate(10);
        return view('user.index', ['users' => $users]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'position_code' => 'required|string|max:255|unique:users,position_code',
            'emp_code' => 'required|string|max:255',
            'position_name' => 'required|string|max:255',
            'hq_code' => 'required|string|max:255',
            'hq_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
        ]);

        $request['password'] = Hash::make($request->position_code);
        $user = new User();
        $user->fill($request->all());
        $user->save();
        return redirect()->route('users')
            ->with('message', 'User save successfully');
    }

    public function upload(Request $request)
    {
        $max = getFileSizeInBytes(ini_get('upload_max_filesize')) / 1024;
        // Validate the file
        $request->validate([
            'users_list' => 'required|mimes:csv,xlsx|max:'.$max,
        ]);

        // Try importing and handle exceptions
        try {
            $import = new UsersImport();
            Excel::import($import, $request->file('users_list'));

            // Redirect with success message
            return redirect()->route('users')
                ->with('message', 'User uploaded successfully');
        } catch (\Exception $e) {
            // If there's an error in processing, pass the error message
            return redirect()->route('users')
                ->withErrors(['error' => 'There was an issue uploading the file.'])
                ->with('message', 'File upload failed.');
        }
    }

    public function edit($position_code)
    {
        $user = User::where('position_code', '=', $position_code)->first();

        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {

        $request->validate([
            'user_name' => 'required|string|max:255',
            'position_code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'position_code')->ignore($request->position_code, 'position_code')
            ],
            'emp_code' => 'required|string|max:255',
            'position_name' => 'required|string|max:255',
            'hq_code' => 'required|string|max:255',
            'hq_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
        ]);
        unset($request['_token']);

        user::where('position_code', '=', $request->position_code)->update($request->all());
        return redirect()->route('users')
            ->with('message', 'User uploaded successfully');
    }

    public function delete($position_code)
    {
        User::where('position_code', '=', $position_code)->delete();
        return redirect()->route('users')
            ->with('message', 'User deleted successfully');
    }

    public function export($type)
    {
        if ($type == 'pdf') {
            $users = User::with(['roles','userDetail'])
                ->whereDoesntHave('roles', function ($query) {
                    $query->where('name', 'Admin');
                })
                ->whereHas('userDetail')
                ->get();

            $pdf = PDF::loadView('user.pdf', ['users' => $users]);

            return $pdf->download('users.pdf');
        } else {
            return Excel::download(new UsersExport, 'users.' . $type);
        }
    }

    public function userForm()
    {
        return view('users-details.form');
    }

    public function posterPreview(Request $request)
    {
        // dd($request->all());
        $max = getFileSizeInBytes(ini_get('upload_max_filesize')) / 1024;
        $request->validate([
            'poster' => 'required|mimes:png,jpg,jpeg,webp,heic,heif|max:'.$max,
        ]);

        $userDetail = [
            'doctor_name' => $request->doctor_name,
            'speciality' => $request->speciality,
            'place' => $request->place,
        ];

        $uploadedImage = $request->file('poster');
        $frames = Frame::get();

        $frameData = [];
        foreach($frames as $frame){
            $base64Image = $this->imageMerge($uploadedImage, $userDetail,$frame->frame);
            $frameData[] = ['base64Image' => $base64Image,'id' => $frame->id];
        }
        
        return response()->json(['message' => 'Image successfully processed', 'frameData' => $frameData]);
    }

    public function updateUser(Request $request)
    {
        $max = getFileSizeInBytes(ini_get('upload_max_filesize')) / 1024;
        $request->validate([
            'poster' => 'required|mimes:png,jpg,jpeg,webp,heic,heif|max:'.$max,
            'doctor_name' => 'required',
            'speciality' => 'required',
            'place' => 'required',
        ]);
        $user = [
            'user_name' => $request->user_name,
            'position_code' => $request->position_code,
            'emp_code' => $request->emp_code,
            'position_name' => $request->position_name,
            'hq_code' => $request->hq_code,
            'hq_name' => $request->hq_name,
        ];
       
        $uploadedImage = $request->file('poster');



        $userDetail = [
            'doctor_name' => $request->doctor_name,
            'speciality' => $request->speciality,
            'place' => $request->place,
            'user_id' => $request->user_id,
            'frame_id' => $request->selected_frame
        ];
        $frame = Frame::where('id', $request->selected_frame)->first();
        $poster = $this->imageMerge($uploadedImage, $userDetail,$frame->frame);

        $userDetail['poster'] = $poster;

        $check = UserDetail::where('user_id', '=', $request->user_id)->exists();

        $msg = "Thank you, Dr. " . $request->doctor_name . " your record has been";
        if ($check) {
            UserDetail::where('user_id', '=', $request->user_id)->update($userDetail);
            $msg .= " updated";
        } else {
            $saveUserDetails = new UserDetail;
            $saveUserDetails->fill($userDetail);
            $saveUserDetails->save();
            $msg .= " created";
        }
        return redirect()->back()->with("success", $msg);

    }

    private function imageMerge($uploadedImage, $text = null,$frame)
    {
        $manager = new ImageManager(['driver' => 'imagick']);

        // Load the frame
        $framePath = public_path('frame/'.$frame);
        $frame = $manager->make($framePath);

        if ($text != null) {
            $fontPath = public_path('assets/fonts/Nunito/Nunito-Regular.ttf'); // Ensure this path is correct

            $doctor_name = "Dr. " . $text['doctor_name'];
            $speciality = $text['speciality'];
            $place = $text['place'];
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
        }


        // Load the uploaded image
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
        $canvas->insert($image, 'center', 10, 80);

        // Insert the frame on top of the canvas
        $canvas->insert($frame, 'top-left');

        $base64Image = (string) $canvas->encode('data-url');

        return $base64Image;
    }

    public function download($user_id)
    {
        $user = User::where('id', '=', $user_id)->with('userDetail')->first();

        if ($user && $user->userDetail && $user->userDetail->poster) {
            $posterBase64 = $user->userDetail->poster;

            // Extract the file type and Base64 content
            list($type, $posterData) = explode(';', $posterBase64);
            list(, $posterData) = explode(',', $posterData);
            $posterData = base64_decode($posterData);

            // Determine the file extension
            $extension = '';
            if (str_contains($type, 'jpeg')) {
                $extension = 'jpg';
            } elseif (str_contains($type, 'png')) {
                $extension = 'png';
            } elseif (str_contains($type, 'pdf')) {
                $extension = 'pdf';
            }

            // Create a file name
            $fileName = $user->userDetail->doctor_name . '_' . $user->id . '.' . $extension;
            User::where('id', '=', $user_id)->update(['downloaded' => true]);
            // Create and return a response to download the file
            return Response::make($posterData, 200, [
                'Content-Type' => $type,
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ]);
        }

        return abort(404, 'Poster not found.');
    }
}
