<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Chambre;
class chambreController extends Controller
{
public function index()
     {
        $chambre=DB::table('chambres')->orderBy('id', 'asc')->paginate(30);
        return view('GestionChambres',compact('chambre'));
     }
     
     public function show(Request $request,$id)
     {

        $chambre=Chambre::findOrFail($id);

        return view('FormChambres',compact('chambre'));
        
     }

     	   public function ajouterChambre(Request $request)
    	{
    		$chambre=new Chambre();
            if(Chambre::where('num_chambre',$request->input('wnum_chambre'))->exists())
            {
                $request->session()->flash('danger', 'Cette chambre existe dans la base');
                return redirect()->back();
            }
            else

            {
                     
                $chambre->bloc_chambre=$request->input('wbloc_chambre');
                $chambre->num_chambre=$request->input('wnum_chambre');
                $chambre->etat=$request->input('wetat');
                $chambre->capacite=$request->input('wcapacite');
                $chambre->compteur=0;
                $chambre->save();
                $request->session()->flash('success', 'Ajout avec succèes');
                return redirect()->back();

            }   
    	}

             public function supprimerChambre(Request $request,$id)
         {
            $chambre=Chambre::findOrFail($id)->delete();
            $request->session()->flash('success', 'Suppression effectuée avec succèes');
            return redirect()->back();
         }

    public function modifierChambre(Request $request)
      { 

                $chambre=Chambre::findOrFail($request->input('wid1'));
                $chambre->bloc_chambre=$request->input('wbloc_chambre');
                $chambre->num_chambre=$request->input('wnum_chambre');
                $chambre->etat=$request->input('wetat');
                $chambre->capacite=$request->input('wcapacite');
                $chambre->save();
                $request->session()->flash('success', 'Modification effectuée avec succèes');
                $article=DB::table('facultes')->orderBy('id', 'asc')->paginate(30);
                return redirect('facultes');

               
      }
     
}
