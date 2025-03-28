<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Languages;
use Storage;
class LanguageController extends Controller
{
    private $type   =  "Languages";
    private $singular = "Language";
    private $plural = "Languages";
    private $view = "admin.pages.";
    private $db_key   =  "id";
    private $action   =  "admin/language";
    private $directory  =   '/public/flags';
    private $perpage   =  20;

    public function setLanguage(Request $request)
    {

        session()->put('language', $request->language ?? 'en');
        App::setLocale( $request->language);
        echo "true";
    }

    public function setCurrency(Request $request)
    {
        session()->put('currencyCode', $request->currencyCode ?? 'USD');
        echo "true";
    }
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function search($records,$request,&$data) {
        if($request->perpage)
            $this->perpage  =   $request->perpage;
        $data['sindex']     = ($request->page != NULL)?($this->perpage*$request->page - $this->perpage+1):1;
        $params = [];
        if($request->cons_id) {
            $params['cons_id'] = $request->cons_id;
            $records = $records->where("cons_id",$params['cons_id']);
        }
        if($request->is_active) {
            $params['is_active'] = $request->is_active;
            $records = $records->where("is_active",$params['is_active']);
        }

        $data['request'] = $params;
        return $records;
    }
    public function index(Request $request)
    {
        $data = array(
            "page_title" => $this->plural . " List",
            "page_heading" => $this->plural . ' List',
            "breadcrumbs" => array("#" => $this->plural . " List"),
            "action" => url('admin/' . $this->action),
            "module" => ['type' => $this->type, 'singular' => $this->singular, 'plural' => $this->plural, 'view' => $this->view, 'action' => 'admin/' . $this->action, 'db_key' => $this->db_key],
            "active_module" => "Admins"
        );

        $records = Languages::get(); // Keep it as a Collection

        $records = $this->search($records, $request, $data); 

        $data['count'] = $records->count();

        $data['Languages'] = $records; // Pass paginated object

        return view($this->view . 'language-list', $data);
    }

    public function cleanData(&$data) {
        $unset = ['q','_token'];
        foreach ($unset as $value) {
            if(array_key_exists ($value,$data))  {
                unset($data[$value]);
            }
        }
        $int = ['Price'];
        foreach ($int as $value) {
            if(array_key_exists ($value,$data))  {
                $data[$value] = (int)str_replace(['(','Rs',')',' ','-','_',','], '', $data[$value]);
            }

        }
    }
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $this->cleanData($data);

            if ($request->hasFile('flags')) {
                $file = $request->file('flags');
            $languageName = str_replace(' ', '_', strtolower($data['name'])); // Convert language name to lowercase and replace spaces
            $filename = $languageName . '.png'; // Save as SVG format
            $filePath = public_path('flags/' . $filename); // Directly save to the public folder

            // Move the uploaded file to the public/flags directory
            $file->move(public_path('flags'), $filename);

            // Save the file path in the database (relative to public/)
            $data['flags'] = 'flags/' . $filename;
        }


        // Create a new User instance
        $user = new Languages();
        $user->fill($data);
        // Save the user
        $user->save();

        // Prepare and return the response
        $response = array('flag' => true, 'msg' => $this->singular . ' is created successfully.');
        echo json_encode($response);
        return redirect(url('admin/language'));
    }

    // Render the "create" form view
    $data = [
        "page_title" => "Add " . $this->singular,
        "page_heading" => "Add " . $this->singular,
        "breadcrumbs" => ["dashboard" => "Dashboard", "#" => $this->plural . " List"],
        "action" => url('admin/language/create'),
        "active_module" => "Languages",
        "module" => [
            'type' => $this->type,
            'singular' => $this->singular,
            'plural' => $this->plural,
            'view' => $this->view,
            'action' => 'admin/' . $this->action,
            'db_key' => $this->db_key
        ]
    ];

    return view($this->view . 'language-create', $data);
}



public function edit($id)
{
    $row = Languages::findOrFail($id);
    return response()->json($row);
}
public function update(Request $request, $id)
{
    $language = Languages::findOrFail($id);
    $language->name = $request->name;
    $language->short_name = $request->short_name;
    $language->odr = $request->odr;

    if ($request->hasFile('flags')) {
        $file = $request->file('flags');
        $languageName = str_replace(' ', '_', strtolower($language->name));
        $filename = $languageName . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('flags'), $filename);

        $language->flags = 'flags/' . $filename;
    }

    $language->save();
    return response()->json(['msg' => 'Language updated successfully']);
}


public function delete($id)
{
    $item = Languages::find($id);

    if ($item) {
        $item->delete();
        return response()->json(['flag' => true, 'msg' => 'Language has been deleted.']);
    }

    return response()->json(['flag' => false, 'msg' => 'Language not found.'], 404);
}

}
