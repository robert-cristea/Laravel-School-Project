<?php

namespace App\Http\Controllers\SuperAdmin\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Quotes;
use App\Model\Quote_video_related;

class QuotesController extends Controller
{
    //
    public function addQuote(Request $request){
        
        $quotes = $request->all();
        if ($quotes['associated_le'] !== null) {
            Quotes::create([
                'content' => $quotes['add_quote'],
                'language' => $quotes['quoteradio'],
                'Author' => $quotes['add_author'],
                'video_id' => $quotes['associated_le']
            ]);
            $notification = array(
                'message' => 'Added successfuly!', 
                'alert-type' => 'success'
            );
            
            return back()->with($notification);
        } else {
            $notification = array(
                'message' => 'You must select associated lesson.', 
                'alert-type' => 'error'
            );
            
            return back()->with($notification);
        }
        
        

    }
    public function editQuote(Request $request, $id){

        $quotes = $request->all(); 
        Quotes::whereQuote_id($id)->update([
            'content' => $quotes['edit_quote'],
            'language' => $quotes['editradio'],
            'Author' => $quotes['edit_author'],
            'video_id' => $quotes['quote_le']
        ]);
        $notification = array(
            'message' => 'Updated successfuly!', 
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
    public function deleteQuote($id){
        Quotes::whereQuote_id($id)->delete();
        $notification = array(
            'message' => 'Deleted successfuly!', 
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
