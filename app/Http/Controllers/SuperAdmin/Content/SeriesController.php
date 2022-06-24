<?php

namespace App\Http\Controllers\SuperAdmin\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Series;

class SeriesController extends Controller
{
    //
    // Adding series
    public function addSeries(Request $request)
    {
        $series = Series::all();
        // dd($request);
        $nowtime = date('Y_m_d');
        // $temp="public/eshop/upload/temp/";
        $path="uploads/";
        if( $request->hasFile('thumbnail') )	{

            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $type_mime_shot = $request->file('thumbnail')->getMimeType();
            $sizeFile = $request->file('thumbnail')->getSize();
            $thumbnail = $nowtime.'-'.mt_rand(10, 100).'.'.$extension;
            // dd($thumbnail);
            $request->file('thumbnail')->move($path, $thumbnail);

            $validateData = $request->all();
            // dd($validateData);
            Series::create([
                'title_frensh' => $validateData['series_title_en'],
                'title_english' => $validateData['series_title_fr'],
                'description_frensh' => $validateData['series_description_en'],
                'description_english' => $validateData['series_description_fr'],
                'picture' => $thumbnail,
                'display_order' => 1
            ]);
            foreach ($series as $serie) {
                Series::where('serie_id', $serie->serie_id)->update([
                    'display_order' => $serie->display_order+1
                ]);
            }
            
        } else {
            $validateData = $request->all();
            // dd($validateData);
            Series::create([
                'title_frensh' => $validateData['series_title_en'],
                'title_english' => $validateData['series_title_fr'],
                'description_frensh' => $validateData['series_description_en'],
                'description_english' => $validateData['series_description_fr'],
                'display_order' => 1
            ]);
        }//
        $notification = array(
            'message' => 'Added successfuly!', 
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }

    // Editing series
    public function editSeries(Request $request, $id)
    {
        $nowtime = date('Y_m_d');
        // $temp="public/eshop/upload/temp/";
        $path="uploads/";
        if( $request->hasFile('thumbnail1') )	{

            $extension = $request->file('thumbnail1')->getClientOriginalExtension();
            $type_mime_shot = $request->file('thumbnail1')->getMimeType();
            $sizeFile = $request->file('thumbnail1')->getSize();
            $thumbnail = $nowtime.'-'.mt_rand(101, 200).'.'.$extension;
            
            $request->file('thumbnail1')->move($path, $thumbnail);

            $validateData = $request->all();
            Series::whereSerie_id($id)->update([
                'title_frensh' => $validateData['series_title_en'],
                'title_english' => $validateData['series_title_fr'],
                'description_frensh' => $validateData['series_description_en'],
                'description_english' => $validateData['series_description_fr'],
                'picture' => $thumbnail,
            ]);
        }else{
            $validateData = $request->all();
            Series::whereSerie_id($id)->update([
                'title_frensh' => $validateData['series_title_en'],
                'title_english' => $validateData['series_title_fr'],
                'description_frensh' => $validateData['series_description_en'],
                'description_english' => $validateData['series_description_fr'],
                // 'picture' => $thumbnail,
            ]);
        } //
        $notification = array(
            'message' => 'Saved successfuly!', 
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }

    //deleting Series
    public function delete($id)
    {
        Series::whereSerie_id($id)->delete();
        // $serie->delete();
        $notification = array(
            'message' => 'Deleted successfuly!', 
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }
    //display series
    public function seriesDisplay(Request $request){
        $ids = Series::all(); 
        $series = $request->all(); 

        foreach($ids as $id){
           
                
            Series::where('serie_id', $id->serie_id)->update([
                'display_order' => $series[$id->serie_id]
            ]);
            
            
        }
        $notification = array(
            'message' => 'Saved successfuly!', 
            'alert-type' => 'success'
        );
        
        return back()->with($notification);

    }

}
