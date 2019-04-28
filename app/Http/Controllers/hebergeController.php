<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Heberge;
use App\Chambre;
use App\Gouvernorat;
use App\Etudiant;

use Excel;
class hebergeController extends Controller
{
      public function index()
     {
        $heberge=DB::table('heberges')->orderBy('id', 'asc')->paginate(30);
         $chambre=Chambre::all();
        return view('GestionHeberges',compact('heberge','chambre'));
     }

           public function ajouterHeberge(Request $request)
        {

            if($request->hasFile('post_image')){  

                    $filenameWithExtention = $request->file('post_image')->getClientOriginalName();
                    $fileName = pathinfo($filenameWithExtention,PATHINFO_FILENAME);
                    $extension = $request->file('post_image')->getClientOriginalExtension();
                    $fileNameStore = $fileName .'_'.time().'.'.$extension;

                    $path = $request->file('post_image')->move(base_path() . '/public/images/', $fileNameStore);
      
     
                
            }else{
                    $fileNameStore = 'noImage.jpg';
                  }

                $heberge=new Heberge();     
                $student=DB::table('etudiants')->where('cin', 'LIKE', ''.$request->input('search').'')->get();
                
                $heberge->etudiant_id=$student[0]->id;
                $heberge->chambre_id=$request->input('wchambre');
                $heberge->ApprobationLogement=$request->input('wd1');
                $heberge->recuInscriptionUniversitaire=$request->input('wd2');               
                $heberge->certificatResidence=$request->input('wd3');
                $heberge->copieCin=$request->input('wd4');
                $heberge->certificatMedicale=$request->input('wd5');
                $heberge->enveloppes=$request->input('wd6');
                $heberge->photos=$request->input('wd7');
                $heberge->reglementInterieur=$request->input('wd8');
                $heberge->photo=$fileNameStore;
                $heberge->save();
                $request->session()->flash('success', 'Ajout avec succèes');
                return redirect()->back();

             
        }
        
     public function show(Request $request,$id)
     {

        $heberge=Heberge::findOrFail($id);
        $chambre=Chambre::all();
        $student=DB::table('etudiants')->where('id', $heberge->etudiant_id)->first();

        return view('FormHeberges',compact('heberge','chambre','student'));
        
     }

    public function modifierHeberge(Request $request)
      { 
         if( $request->hasFile('post_image') ){  

                    $filenameWithExtention = $request->file('post_image')->getClientOriginalName();
                    $fileName = pathinfo($filenameWithExtention,PATHINFO_FILENAME);
                    $extension = $request->file('post_image')->getClientOriginalExtension();
                    $fileNameStore = $fileName .'_'.time().'.'.$extension;

                    $path = $request->file('post_image')->move(base_path() . '/public/images/', $fileNameStore);

                
                      }else{
                    $fileNameStore = 'noImage.jpg';
                  }


                $heberge=Heberge::findOrFail($request->input('wid1'));
                $student=DB::table('etudiants')->where('cin', 'LIKE', ''.$request->input('search').'')->get();

                $heberge->etudiant_id=$student[0]->id;
                $heberge->chambre_id=$request->input('wchambre');
                $heberge->ApprobationLogement=$request->input('wd1');
                $heberge->recuInscriptionUniversitaire=$request->input('wd2');               
                $heberge->certificatResidence=$request->input('wd3');
                $heberge->copieCin=$request->input('wd4');
                $heberge->certificatMedicale=$request->input('wd5');
                $heberge->enveloppes=$request->input('wd6');
                $heberge->photos=$request->input('wd7');
                $heberge->photo=$fileNameStore;
                $heberge->reglementInterieur=$request->input('wd8');
                $heberge->save();
                $request->session()->flash('success', 'Modification effectuée avec succèes');
                $article=DB::table('heberges')->orderBy('id', 'asc')->paginate(30);
                return redirect('heberges');

               
      }

       public function ws(Request $request)
      {
        if($request->ajax())
         {


               $query = $request->get('query');                  
             $data=DB::table('etudiants')->where('cin', 'LIKE', ''.$query.'')->get();

          $data_test = Etudiant::find($data[0]->id)->heberge;
          if($data_test)
          {  
                     $output = 'étudiant deja hébergé';
                     $gouvernorat = 'étudiant deja hébergé';
                     $faculte = 'étudiant deja hébergé';
                     $telephone = 'étudiant deja hébergé';
                     $data = array('result'  => $output,'gouvernorat'  => $gouvernorat,'faculte'  => $faculte,'telephone'  => $telephone);
                     echo json_encode($data);

          }
           else{
             $total_row = $data->count();
             if($total_row)
                    {
                        foreach($data as $row)
                        {
                            $output = ''.$row->nom.'';
                            $gouvernorat=''.$row->gouvernorat.'';
                            $faculte=''.$row->faculte.'';
                            $telephone=''.$row->telephone.'';
                            
                        }    
                     
                     $data = array('result'  => $output,'gouvernorat'  => $gouvernorat,'faculte'  => $faculte,'telephone'  => $telephone);
                     echo json_encode($data); 
                }
                else
                {
                     $output = 'pas de données';
                     $gouvernorat = 'pas de données';
                     $faculte = 'pas de données';
                     $telephone = 'pas de données';
                     $data = array('result'  => $output,'gouvernorat'  => $gouvernorat,'faculte'  => $faculte,'telephone'  => $telephone);
                     echo json_encode($data);
                }
          
         }
       }

      }
      public function supprimerHeberge(Request $request,$id)
      {
         $heberge=Heberge::findOrFail($id)->delete();
         $request->session()->flash('success', 'Suppression effectuée avec succèes');
         return redirect()->back();
      }

       public function test()
      {
        $heberge=Heberge::find(1)->chambre;       
        echo json_encode($heberge);
      }

}
