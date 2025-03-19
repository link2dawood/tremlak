<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
//    admin actions
    public function all()
    {
        try {

            $blogs = Blog::orderBy('id','DESC')->get();

            return view('admin.pages.blogs', compact('blogs'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function add()
    {
        try {

            return view('admin.pages.add-blog');
        } catch (\Throwable $th) {

            dd("Some thing went wrong");
        }
    }
    public function save(Request $request)
    {
        try {

            $rules = [
                'cover_picture' => ['required', 'mimetypes:image/jpeg,image/png,image/gif,image/svg+xml'],
            ];

            // Create a validator instance
            $validator = Validator::make($request->all(), $rules);

            // Perform the validation
            if ($validator->fails()) {
                // Redirect back with errors if validation fails
                $errors = $validator->errors()->first();

                return back()->with(['icon' => 'error','title'=>'Failed', 'text' => $errors]);
            }
            $image_path = '';
            if ($request->hasFile('cover_picture')) {
                $image = $request->file('cover_picture');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/blogs/'), $imageName);
                $image_path = 'uploads/blogs/' . $imageName;
            }

            DB::beginTransaction();

            {
                $blog=Blog::create([
                    'image_path'=>$image_path,
                    'mata_title'=>$request->mata_title,
                    'mata_tags'=>$request->mata_tags,
                    'mata_description'=>$request->mata_description,
                    'create_date'=>date('Y-m-d'),
                ]);
                $slug='TREMLAK360-Blog-'.$blog->id;
                $blog->slug=$slug;
                $blog->save();
                unset($request['_token']);
                unset($request['cover_picture']);
                unset($request['mata_title']);
                unset($request['mata_tags']);
                unset($request['mata_description']);

                foreach ($request->all() as $key => $value) {
                    $lang[] = $key;
                    $lang_id[] = $value['id'];
                    unset($value['id']);
                    $data[] = $value;
                }

                for ($i=0; $i < count($lang_id); $i++) {

                    $blog_detail = new BlogDetails();

                    $blog_detail->blog_id   = $blog->id;
                    $blog_detail->subject   = $data[$i]['subject'];
                    $blog_detail->body      = $data[$i]['body'];
                    $blog_detail->lang      = $lang[$i];
                    $blog_detail->lang_id   = $lang_id[$i];
                    $blog_detail->save();
                }
            }

            DB::commit();
            return redirect(route('admin_blogs'))->with(['icon' => 'success', 'title' => 'Blog saved  successfully','text'=>'']);

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with(['icon' => 'error', 'title' => 'Exception to save blog','text'=>'']);
        }
    }
    public function delete(Request $request)
    {
        try {

            $id=$request->id;
            DB::beginTransaction();
            $blog = Blog::findorfail($id);
            if(!$blog->delete()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => 'Failed to delete blog']);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' => 'Agent deleted successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => 'Exception to delete blog ']);
        }
    }
    public function updateStatus(Request $request)
    {
        try {
            $id=$request->id;
            DB::beginTransaction();
            $blog = Blog::findorfail($id);
            $blog->status=$request->status;

            if(!$blog->update()){
                return response()->json(['status' => 'false','icon'=>'error', 'message' => 'Failed to update  status']);
            }
            DB::commit();
            return response()->json(['status' => 'true','icon'=>'success', 'message' =>'Agent status updated successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'false','icon'=>'error', 'message' => 'Exception to update status']);
        }
    }
    public function edit($slug='')
    {
        try {
            $blog = Blog::with('details')->where('slug',$slug)->first();
            if(!$blog){
                return back();
            }
            return view('admin.pages.edit-blog', compact('blog'));
        } catch (\Throwable $th) {
            dd("Some thing went wrong");
        }
    }
    public function update(Request $request)
    {
        try {

            $rules = [
                'cover_picture' => ['nullable', 'mimetypes:image/jpeg,image/png,image/gif,image/svg+xml'],
            ];

            // Create a validator instance
            $validator = Validator::make($request->all(), $rules);

            // Perform the validation
            if ($validator->fails()) {
                // Redirect back with errors if validation fails
                $errors = $validator->errors()->first();

                return back()->with(['icon' => 'error','title'=>'Failed', 'text' => $errors]);
            }
            DB::beginTransaction();

            $blog=Blog::where('id',$request->id);
            if(!$blog){
                return back();
            }
            if ($request->hasFile('cover_picture')) {
                $image = $request->file('cover_picture');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/blogs/'), $imageName);
                $image_path = 'uploads/blogs/' . $imageName;
                $blog->image_path=$image_path;
                unset($request['cover_picture']);
            }
            $blog->mata_title=$request->mata_title;
            $blog->mata_tags=$request->mata_tags;
            $blog->mata_description=$request->mata_description;
            $blog->save();

            // first remove last blog details then add new blog

            $blog_detail=BlogDetails::where('blog_id',$request->id)->truncate();

            unset($request['_token']);
            unset($request['id']);
            unset($request['mata_title']);
            unset($request['mata_tags']);
            unset($request['mata_description']);

            foreach ($request->all() as $key => $value) {
                $lang[] = $key;
                $lang_id[] = $value['id'];
                unset($value['id']);
                $data[] = $value;
            }

            for ($i=0; $i < count($lang_id); $i++) {

                $blog_detail = new BlogDetails();

                $blog_detail->blog_id   = $blog->id;
                $blog_detail->subject   = $data[$i]['subject'];
                $blog_detail->body      = $data[$i]['body'];
                $blog_detail->lang      = $lang[$i];
                $blog_detail->lang_id   = $lang_id[$i];
                $blog_detail->save();
            }

            DB::commit();
            return redirect(route('admin_blogs'))->with(['icon' => 'success', 'title' => 'Blog updated successfully','text'=>'']);

        } catch (\Throwable $th) {
            DB::rollback();

            return back()->with(['icon' => 'error', 'title' => 'Exception to update blog','text'=>$th->getMessage()]);
            return back()->with(['icon' => 'error', 'title' => 'Exception to update blog','text'=>'']);
        }
    }
    public function upload(Request $request)
    {

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        ]);
        try {
            $fileName = time() . $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('uploads', $fileName, 'custom_disk');
            return response()->json(['location' => "/storage/$path"]);

//            $image_path = '';
//            if ($request->hasFile('file')) {
//                $image = $request->file('file');
//                $imageName = time() . '_' . $image->getClientOriginalName();
//                $image->move(public_path('uploads/blogs/'), $imageName);
//                $image_path = 'uploads/blogs/' . $imageName;
//            }
//            return response()->json(['location' => asset($image_path)]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

//    user side
    public function index()
    {
        try {
            if (session()->has('language')) {
                $language = session()->get('language');
            } else {
                $language = 'en';
            }

            $response = Http::withHeaders([
                'api-key' => env('COCKPITAPIKEY'),
            ])->get(env('COCKPITURL') . 'items/blog?locale=' . $language . '&sort=%7B_created%3A-1%7D');

            if ($response->successful()) {
                $blogs = json_decode($response);

                // Fetch English slugs separately
                $response_en = Http::withHeaders([
                    'api-key' => env('COCKPITAPIKEY'),
                ])->get(env('COCKPITURL') . 'items/blog?locale=en&sort=%7B_created%3A-1%7D');

                if ($response_en->successful()) {
                    $blogs_en = json_decode($response_en);

                    // Replace slugs in other locales with English slugs
                    foreach ($blogs as $key => $blog) {
                        $blog_en = $blogs_en[$key];
                        $blog->slug = $blog_en->slug;
                    }
                } else {
                    // Handle the case when fetching English slugs fails
                    return response()->json(['error' => 'Failed to fetch English slugs from API'], $response_en->status());
                }

                return view('pages.blogs', compact('blogs'));
            } else {
                // Handle the case when the API request fails
                return response()->json(['error' => 'Failed to fetch data from API'], $response->status());
            }
        } catch (\Throwable $th) {
            // Handle any exceptions
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function details($slug='')
    {
        try {
            if (session()->has('language')) {
                $language = session()->get('language');
            } else {
                $language = 'en';
            }

//            $response = Http::withHeaders([
//                'api-key' => env('COCKPITAPIKEY'),
//            ])->get(env('COCKPITURL').'items/blog?locale='.$language, [
//                'filter' => json_encode(['slug' => $slug]),
//            ]);

//            curl -X GET "https://tremlak-blog.shahab01.com/api/content/items/blog?locale=ar&filter=%7B%22slug%22%3A+%22english-blog-title%22%7D" \

            $response = Http::withHeaders([
                'api-key' => env('COCKPITAPIKEY'),
            ])->get(env('COCKPITURL') . 'items/blog?locale=' . $language . '&filter=%7B%22slug%22%3A+%22' . urlencode($slug) . '%22%7D');


            if ($response->successful()) {
                $blog = json_decode($response);

                $blog=$blog[0];

                return view('pages.blog-detail', compact('blog'));
            } else {
                // Handle the case when the API request fails
                return response()->json(['error' => 'Failed to fetch data from API'], $response->status());
            }


        } catch (\Throwable $th) {
            dd("Some thing went wrong");
        }
    }
}
