<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Gouvernorat;
use Excel;
class gouvernoratController extends Controller
{
     public function index()
     {
        $gouvernorat=DB::table('gouvernorats')->orderBy('id', 'asc')->paginate(30);
        return view('GestionGouvernorats',compact('gouvernorat'));
     }
     
     public function show(Request $request,$id)
     {

        $gouvernorat=Gouvernorat::findOrFail($id);

        return view('FormGouvernorats',compact('gouvernorat'));
        
     }

     	   public function ajouterGouvernorat(Request $request)
    	{
    		$gouvernorat=new Gouvernorat();
            if(Gouvernorat::where('code_gouvernorat',$request->input('code_gouvernorat'))->exists())
            {
                $request->session()->flash('danger', 'Cette gouvernorat existe dans la base');
                return redirect()->back();
            }
            else

            {
                     
                $gouvernorat->code_gouvernorat=$request->input('wcode_gouvernorat');
                $gouvernorat->libelle_gouvernorat=$request->input('wlibelle_gouvernorat');
                $gouvernorat->save();
                $request->session()->flash('success', 'Ajout avec succèes');
                return redirect()->back();

            }   
    	}

             public function supprimerGouvernorat(Request $request,$id)
         {
            $gouvernorat=Gouvernorat::findOrFail($id)->delete();
            $request->session()->flash('success', 'Suppression effectuée avec succèes');
            return redirect()->back();
         }

    public function modifierGouvernorat(Request $request)
      { 

                $gouvernorat=Gouvernorat::findOrFail($request->input('wid1'));
                $gouvernorat->code_gouvernorat=$request->input('wcode_gouvernorat');
                $gouvernorat->libelle_gouvernorat=$request->input('wlibelle_gouvernorat');
                $gouvernorat->save();
                $request->session()->flash('success', 'Modification effectuée avec succèes');
                $article=DB::table('gouvernorats')->orderBy('id', 'asc')->paginate(30);
                return redirect('gouvernorats');

               
      }

      public function ws(Request $request)
      {
        if($request->ajax())
         {

             $query = $request->get('query');                  
             $data = DB::table('gouvernorats')->where('libelle_gouvernorat', 'LIKE', ''.$query.'')->orderBy('id', 'asc')->get();
             $total_row = $data->count();
             if($total_row > 0)
                    {
                        foreach($data as $row)
                        {
                            $output = ''.$row->id.'';
                        }    
                     
                     $data = array('result'  => $output);
                     echo json_encode($data); 
                }
                else
                {
                    $output = '';
                     $data = array('result'  => $output);
                     echo json_encode($data);
                }
          
         }


      }




    //Génerer PDF//////////////////////////////////////////////////////
    function get_customer_data()
    {
     $customer_data = DB::table('gouvernorats')->orderBy('id', 'asc')->get();
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
     <title>Fichier Gouvernorat</title>
     <h3 align="center">Liste des gouvernorats</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="20%">Code</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Libelle</th>
      </tr>
     ';  
     foreach($customer_data as $gouv)
     {
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$gouv->code_gouvernorat.'</td>
       <td style="border: 1px solid; padding:12px;">'.$gouv->libelle_gouvernorat.'</td>
       
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;
    }
 //Fin Génerer PDF//////////////////////////////////////////////////////

     //Génerer EXCEL//////////////////////////////////////////////////////

public function excel()
{
     $customer_data =DB::table('gouvernorats')->limit(10)->get();
     $customer_array[] = array('Code','Libelle');
     foreach($customer_data as $customer)
     {
      $customer_array[] = array(
       'Code'  => $customer->code_gouvernorat,
       'Libelle'   => $customer->libelle_gouvernorat,
      );
     }
     Excel::create('Gouvernorats', function($excel) use ($customer_array){
      $excel->setTitle('Gouvernorats');
      $excel->sheet('Gouvernorats', function($sheet) use ($customer_array){
       $sheet->fromArray($customer_array, null, 'A1', false, false);
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
                    $product_list[] = ['code_gouvernorat' => $value->code_gouvernorat, 'libelle_gouvernorat' => $value->libelle_gouvernorat];
                    if(!empty($value->code_gouvernorat)){
                    $gouv=new Gouvernorat();
                    $gouv->code_gouvernorat=$value->code_gouvernorat;
                    $gouv->libelle_gouvernorat=$value->libelle_gouvernorat;
                    $gouv->save();
                    }

                }
    
            }
        }
        else{
                return "Error";
        }

        return redirect()->back();


}    
 //Fin Importer EXCEL//////////////////////////////////////////////////////

}
