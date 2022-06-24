<?php

namespace App\Http\Controllers\SuperAdmin\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Tools;

class ToolsController extends Controller
{
    //
    public function editTool(Request $request, $id){
        
        $tools = $request->all(); 
        if($tools['tool_title_en'] && $tools['tool_description_en']){
            Tools::whereTools_id($id)->update([
                'name_frensh' =>"",
                'name_english' =>$tools['tool_title_en'],
                'description_frensh' =>"",
                'description_english' =>$tools['tool_description_en']
            ]);
        } else {
            Tools::whereTools_id($id)->update([
                'name_frensh' =>$tools['tool_title_fr'],
                'name_english' =>"",
                'description_frensh' =>$tools['tool_description_fr'],
                'description_english' =>""
            ]);
        }
        
        $notification = array(
            'message' => 'Updated successfuly!', 
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }
}
