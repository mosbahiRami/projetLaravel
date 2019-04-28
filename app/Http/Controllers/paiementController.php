<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Paiement;
use App\Etudiant;
use App\Heberge;

class paiementController extends Controller
{
       public function index()
       {
           $paiement=DB::table('paiements')->orderBy('id', 'asc')->paginate(30);
           $paiement=Paiement::all();
           $heberge=Heberge::all();
           return view('GestionPaiements',compact('paiement','heberge'));
       }
        public function show(Request $request,$id)
       {

           $paiement=Paiement::findOrFail($id);
        

          return view('FormPaiement',compact('paiement'));
          
       }

       public function ajouterPaiement(Request $request)
        {
            $paiement=new Paiement();
            $student=DB::table('etudiants')->where('cin', 'LIKE', ''.$request->input('search').'')->get();
            $paiement->etudiant_id=$student[0]->id;
            $paiement->trimestre1=$request->input('trimestre1');
            $paiement->trimestre2=$request->input('trimestre2');
            $paiement->trimestre3=$request->input('trimestre3');
            $paiement->cautionnement=$request->input('cautionnement');
            $paiement->save();
            $request->session()->flash('success', 'Ajout avec succèes');
            return redirect()->back();
        }

       public function modifierPaiement(Request $request)
        { 
                $paiement=Paiement::findOrFail($request->input('wid1'));

                $paiement->trimestre1=$request->input('trimestre1');
                $paiement->trimestre2=$request->input('trimestre2');
                $paiement->trimestre3=$request->input('trimestre3');
                $paiement->cautionnement=$request->input('cautionnement');
                $paiement->save();
                $request->session()->flash('success', 'Modification effectuée avec succèes');
                return redirect('paiements');
        } 

       public function supprimerPaiement(Request $request,$id)
         {
            $paiement=Paiement::findOrFail($id)->delete();
            $request->session()->flash('success', 'Suppression effectuée avec succèes');
            return redirect()->back();
         }


       
public function wsPaiement(Request $request)
      {
        if($request->ajax())
         {


             $query = $request->get('query');                  
             $data=DB::table('etudiants')->where('cin', 'LIKE', ''.$query.'')->get();

           $data_test = Etudiant::find($data[0]->id)->paiement;
             if($data_test)
                    {
                     $output = 'deja inscrit';
                     $data = array('result'  => $output);
                     echo json_encode($data);
                }
                else 
                {

             $total_row = $data->count();
             if($total_row)
                    {
                         foreach($data as $row)
                        {
                            $output = ''.$row->nom.'';
                            
                        }    
                     
                     $data = array('result'  => $output);
                     echo json_encode($data); 
                }
                else
                {
                     $output = 'pas de données';
                     $data = array('result'  => $output);
                     echo json_encode($data);
                }
              }
          
         
       }

      }



}
