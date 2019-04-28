<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Administrateur;
class administrateurController extends Controller
{
    public function index()
     {
        $administrateur=DB::table('administrateurs')->orderBy('id', 'asc')->paginate(3);
        return view('GestionAdministrateurs',compact('administrateur'));
     }

    public function show(Request $request,$id)
     {

        $administrateur=Administrateur::findOrFail($id);

        return view('FormAdministrateurs',compact('administrateur'));
        
     }
      public function ajouterAdministrateur(Request $request)
    	{
    		$administrateur=new Administrateur();
            if(Administrateur::where('nom',$request->input('wnom'))->exists())
            {
                return 'Cet administrateur existe déja dans la base ';
            }
            else

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



                $administrateur->nom=$request->input('wnom');
                $administrateur->prenom=$request->input('wprenom');
                $administrateur->adresse=$request->input('wadresse');
                $administrateur->telephone=$request->input('wtelephone');
                $administrateur->email=$request->input('wemail');
                $administrateur->login=$request->input('wlogin');
                $administrateur->mdp=$request->input('wmdp');
                $administrateur->image=$fileNameStore;
                $administrateur->save();
                $request->session()->flash('success', 'Ajout avec succèes');
                return redirect()->back();

            }   
    	}


    	     public function modifierAdministrateur(Request $request)
      {
      

   
                 
                $administrateur=Administrateur::findOrFail($request->input('wid1'));
                $administrateur->nom=$request->input('wnom');
                $administrateur->prenom=$request->input('wprenom');
                $administrateur->adresse=$request->input('wadresse');

                             if( $request->hasFile('post_image') ){  

                    $filenameWithExtention = $request->file('post_image')->getClientOriginalName();
                    $fileName = pathinfo($filenameWithExtention,PATHINFO_FILENAME);
                    $extension = $request->file('post_image')->getClientOriginalExtension();
                    $fileNameStore = $fileName .'_'.time().'.'.$extension;

                    $path = $request->file('post_image')->move(base_path() . '/public/images/', $fileNameStore);
      
                    $administrateur->image=$fileNameStore;
                
                      }
                $administrateur->telephone=$request->input('wtelephone');
                $administrateur->email=$request->input('wemail');
                $administrateur->login=$request->input('wlogin');
                $administrateur->mdp=$request->input('wmdp');

                $administrateur->save();
                $request->session()->flash('success', 'Modification effectuée avec succèes');
                $administrateur=DB::table('administrateurs')->orderBy('id', 'asc')->paginate(3);
                return redirect('administrateurs');

               
      }


           public function supprimerAdministrateur(Request $request,$id)
         {
            $administrateur=Administrateur::findOrFail($id)->delete();
            $request->session()->flash('success', 'Suppression effectuée avec succèes');
            return redirect()->back();
         }
    



         public function getLogin()
         {
          return view('Login');
         }

         public function authentification(Request $request)
         {
          if(Administrateur::where('login',$request->input('wlogin'))->exists() )
            {
              if(Administrateur::where('mdp',$request->input('wmdp'))->exists() )
              {
                  
                  return redirect('/etudiants');
                  
              }
              else
              {
                return redirect('/');
              }

            }
            else
            {
              return redirect('/');
            }



         }


         public function getDashboard()
         {
          return view('Dashboard');
         }



}
