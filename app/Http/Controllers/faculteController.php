<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Faculte;
class faculteController extends Controller
{
     public function index()
     {
        $faculte=DB::table('facultes')->orderBy('id', 'asc')->paginate(30);
        return view('GestionFacultes',compact('faculte'));
     }
     
     public function show(Request $request,$id)
     {

        $faculte=Faculte::findOrFail($id);

        return view('FormFacultes',compact('faculte'));
        
     }

     	   public function ajouterFaculte(Request $request)
    	{
    		$faculte=new Faculte();
            if(Faculte::where('code_faculte',$request->input('wcode_faculte'))->exists())
            {
                $request->session()->flash('danger', 'Cette faculté existe dans la base');
                return redirect()->back();
            }
            else

            {
                     
                $faculte->code_faculte=$request->input('wcode_faculte');
                $faculte->libelle_faculte=$request->input('wlibelle_faculte');
                $faculte->save();
                $request->session()->flash('success', 'Ajout avec succèes');
                return redirect()->back();

            }   
    	}

             public function supprimerFaculte(Request $request,$id)
         {
            $faculte=Faculte::findOrFail($id)->delete();
            $request->session()->flash('success', 'Suppression effectuée avec succèes');
            return redirect()->back();
         }

    public function modifierFaculte(Request $request)
      { 

                $faculte=Faculte::findOrFail($request->input('wid1'));
                $faculte->code_faculte=$request->input('wcode_faculte');
                $faculte->libelle_faculte=$request->input('wlibelle_faculte');
                $faculte->save();
                $request->session()->flash('success', 'Modification effectuée avec succèes');
                $article=DB::table('facultes')->orderBy('id', 'asc')->paginate(30);
                return redirect('facultes');

               
      }
}
