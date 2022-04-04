<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Slider::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<button class="btn btn-primary btn-sm" onclick="Status('.$row->id.')"><i class="fas fa-sync-alt"></i></button>
                            <button class="btn btn-warning btn-sm" onclick="Show('.$row->id.')"><i class="fas fa-pen-square"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="Delete('.$row->id.')"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->addColumn('status', function($row){
                    if ($row->status == 1){
                        $btn = '<span class="badge badge-pill badge-primary">Active</span>';

                    }else{
                        $btn = '<span class="badge badge-pill badge-danger">Disabled</span>';

                    }
                    return $btn;
                })
                ->addColumn('photo', function($row){
                    return '<img style="width: 50px" src="storage/slider/'.$row->photo.'">';
                })
                ->addColumn('detail', function($row){
                    return mb_strimwidth($row->detail, 0, 50, "...");
                })
                ->rawColumns(['action', 'status', 'photo'])
                ->make(true);
        }
        return view('admin.pages.slider.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if($request->hasfile('photo'))
        {
         /*   $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().Str::random(5).'.'.$extension;


            $filePath = 'public/slider';
            $file->storeAs($filePath, $filename);*/

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().Str::random(5).'.'.$extension;
            $resize = Image::make($file)->resize(560, 500)->encode($extension);
            $save = Storage::put("public/slider/".$filename, $resize->__toString());

            Slider::updateOrCreate([
                    'id' => $request->id
                ]
                ,[
                    'photo' => $filename,
                    'title' => $request->title,
                    'sort' => $request->sort,
                    'detail' => $request->details,
                    'status' => 1,
                ]);
        }else{
            if ($request->id){
                $target = Slider::find($request->id)->photo;
            }else{
                $target = 'default.png';
            }
            Slider::updateOrCreate([
                    'id' => $request->id
                ]
                ,[
                    'photo' => $target,
                    'title' => $request->title,
                    'sort' => $request->sort,
                    'detail' => $request->details,
                    'status' => 1,
                ]);
        }
        return response()->json([
            'message' => "New Slider Created"
        ], 200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function status($id)
    {
        $data = Slider::find($id);
        if ($data->status){
            $data = Slider::where('id', $id)->update([
                'status' => false
            ]);
            return response()->json([
                'message' => 'Data status update to disabled',
                'data' => $data
            ],200);
        }else{
            $data = Slider::where('id', $id)->update([
                'status' => true
            ]);
            return response()->json([
                'message' => 'Data status update to enable',
                'data' => $data
            ],200);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $data = Slider::find($id);
        if ($data){
            return response()->json([
                'message' => 'Data Found',
                'data' => $data
            ],200);
        }else{
            return response()->json([
                'message' => 'Data not found',
                'data' => $data
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Slider::destroy($id);
        return response()->json([
            'message' => 'Data deleted',
            'data' =>[]
        ],202);
    }
}
