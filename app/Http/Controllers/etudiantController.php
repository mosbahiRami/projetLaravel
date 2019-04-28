<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Etudiant;
use Excel;
class etudiantController extends Controller
{
    public function index()
     {
        $etudiant=DB::table('etudiants')->orderBy('id', 'asc')->get();
        return view('GestionEtudiants',compact('etudiant'));
     }


             public function supprimerEtudiant(Request $request,$id)
         {
            $etudiant=Etudiant::findOrFail($id)->delete();
            $request->session()->flash('success', 'Suppression effectuée avec succèes');
            return redirect()->back();
         }

    //Génerer PDF//////////////////////////////////////////////////////
    function get_customer_data()
    {
     $customer_data = DB::table('etudiants')->orderBy('id', 'asc')->get();
     return $customer_data;
    }


    function pdf()
    {
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_customer_data_to_html());
     return $pdf->stream();
    }

    function convert_customer_data_to_html()
    {
     $customer_data = $this->get_customer_data();
     $output = '
     <html lang="ar">
     <title>Fichier Etudiant</title>
     <h2 align="center">Liste des etudiants</h2>
     <br>
     ';  
     foreach($customer_data as $gouv)
     {
      $output .= '
      <ul>
      <li style="font-family:DejaVu Sans;">'.$gouv->id.' | '.$gouv->nom.' | '.$gouv->email.'| '.$gouv->telephone.'</li>
      </ul>
      ';
     }
     $output .= '</table> </html>';
     return $output;
    }
 //Fin Génerer PDF//////////////////////////////////////////////////////

     //Génerer EXCEL//////////////////////////////////////////////////////

public function excel()
{
     $etudiant_data =DB::table('etudiants')->get();
     $etudiant_array[] = array('cin','num_bac','nom','naissance','gouvernorat','telephone','email','faculte','date_inscription');
     foreach($etudiant_data as $etudiant)
     {
      $etudiant_array[] = array(
       'cin'  => $etudiant->cin,
       'num_bac'   => $etudiant->num_bac,
       'nom'   => $etudiant->nom,
       'naissance'   => $etudiant->naissance,
       'gouvernorat'   => $etudiant->gouvernorat,
       'telephone'   => $etudiant->telephone,
       'email'   => $etudiant->email,
       'faculte'   => $etudiant->faculte,
       'date_inscription'   => $etudiant->date_inscription,
      );
     }
     Excel::create('Etudiants', function($excel) use ($etudiant_array){
      $excel->setTitle('Etudiants');
      $excel->sheet('Etudiants', function($sheet) use ($etudiant_array){
       $sheet->fromArray($etudiant_array, null, 'A1', false, false);
      });
     })->download('xlsx');


}    
 //Fin Génerer EXCEL//////////////////////////////////////////////////////

 //Importer EXCEL//////////////////////////////////////////////////////

public function importExcel(Request $request)
{
 if($request->hasFile('products')){
           
            $path = $request->file('products')->getRealPath();
            $data = \Excel::load($path)->get();

            if($data->count()){
 					
                foreach ($data as $key => $value) {

                    //$product_list[] = ['code_gouvernorat' => $value->code_gouvernorat, 'libelle_gouvernorat' => $value->libelle_gouvernorat];
                    if(!empty($value->cin)){

                    $etud=new Etudiant();
                    $etud->cin=$value->cin;
                    $etud->num_bac=$value->num_bac;
                    $etud->nom=$value->nom;
                    $etud->naissance=$value->naissance;
                    $etud->gouvernorat=$value->gouvernaurat;
                    $etud->telephone=$value->tel;
                    $etud->email=$value->email;
                    $etud->faculte=$value->faculte;
                    $etud->date_inscription=$value->date_inscription;
                    $etud->save();
                    }

                }
    
            }

        }
        else{
                return "Error";
        }

        return redirect()->back();


}         
}
