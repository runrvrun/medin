<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Schema;
use Session;
use Validator;
use App\News;

class NewsController extends Controller
{
    private $cols;

    public function __construct()
    {
        //setup cols
        $dbcols = Schema::getColumnListing('news');//get all columns from DB
        foreach($dbcols as $key=>$val){
            // add bread props
            $cols[$val] = ['column'=>$val,'dbcolumn'=>$val,
                'caption'=>ucwords(str_replace('_',' ',$val)),
                'type' => 'text',
                'B'=>1,'R'=>1,'E'=>1,'A'=>1,'D'=>1
            ];
            // add joined columns, if any
        } 
        // modify defaults

        $this->cols = $cols;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cols = $this->cols;        
        return view('admin.news.index',compact('cols'));
    }

    public function indexjson()
    {
        return datatables(News::select('news.*')
        )->addColumn('action', function ($dt) {
            return view('admin.news.action',compact('dt'));
        })
        ->toJson();
    }

    public function csvall()
    {
        $export = News::all();
        $filename = 'medin-news.csv';
        $temp = 'temp/'.$filename;
        (new FastExcel($export))->export('temp/medin-news.csv');
        $headers = [
            'Content-Type: text/csv',
            ];
        return response()->download($temp, $filename, $headers)->deleteFileAfterSend(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cols = $this->cols;        
        return view('admin.news.createupdate',compact('cols'));
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
            'title' => 'required',
            'content' => 'required',
        ]);

        $requestData = $request->all();
        // upload images
        if ($request->hasFile('featured_image')) {
            $featured_image = $request->file('featured_image');
            $name = time().rand(1000,9999).'.'.$featured_image->getClientOriginalExtension();
            $destinationPath = 'uploads/news/thumbnail';
            $featured_image->move(base_path('public/'.$destinationPath), $name);  
            $requestData['featured_image']=$destinationPath.'/'.$name;            
        }
        if (isset($request->images)) {
            unset($requestData['images']);
            foreach($request->images as $key=>$val){
                $name = time().rand(1000,9999).'.'.$val->getClientOriginalExtension();
                $destinationPath = 'uploads/news/images';
                $val->move(base_path('public/'.$destinationPath), $name);  
                $requestData['images'][]=$destinationPath.'/'.$name;            
            }
            $requestData['images'] = json_encode($requestData['images']);
        }
        News::create($requestData);
        Session::flash('message', 'News added'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/news');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $cols = $this->cols;        
        $item = News::find($news->id);
        return view('admin.news.createupdate',compact('cols','item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $requestData = $request->all();
        // upload images
        $item = News::find($news->id);// get old item to delete old images
         if ($request->hasFile('featured_image')) {
            $featured_image = $request->file('featured_image');
            $name = time().rand(1000,9999).'.'.$featured_image->getClientOriginalExtension();
            $destinationPath = 'uploads/news/thumbnail';
            $featured_image->move(base_path('public/'.$destinationPath), $name);  
            $requestData['featured_image']=$destinationPath.'/'.$name;            
            @unlink($item->featured_image);// delete old image
        }
        if (isset($request->images)) {
            unset($requestData['images']);
            foreach($request->images as $key=>$val){
                $name = time().rand(1000,9999).'.'.$val->getClientOriginalExtension();
                $destinationPath = 'uploads/news/images';
                $val->move(base_path('public/'.$destinationPath), $name);  
                $requestData['images'][]=$destinationPath.'/'.$name;            
            }
            $images = json_decode($item->images);
            foreach($images as $val){
                @unlink($val);// delete old images
            }
            $requestData['images'] = json_encode($requestData['images']);
        }
        News::find($news->id)->update($requestData);
        Session::flash('message', 'News updated'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        News::destroy($news->id);
        Session::flash('message', 'News removed'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/news');
    }
}
