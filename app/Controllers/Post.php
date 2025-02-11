<?php

namespace App\Controllers;

use App\Models\ImageModel;
use App\Models\PublicationModel;
use App\Models\UtilisateurModel;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Request;
use DateTime;
use ErrorException;

class Post extends BaseController
{

    public function index(): string | array
    {
        // return to Auth page if not authentified
        if (!session()->has('id'))
            return view('auth_view');
        $publication = new PublicationModel();
        $images = new ImageModel();

        $data["posts"] = $publication->getPublication();

        // get image of each post
        foreach ($data['posts'] as $key => $post) {
            array_push($data['posts'][$key], $images->select('images.path')->where('publication_id', $post['publication_id'])->findAll(2));
        }

        return view('show_post', $data);
    }

    /**
     * render the view to create a post
     */
    public function create() {
        if (!session()->has('id'))
            return view('auth_view');
        $utilisateur = new UtilisateurModel();
        $images = new ImageModel();

        $data['utilisateur'] = $utilisateur->select('utilisateurs.id, utilisateurs.username, image_id')
            ->where('id', session()->get('id'))
            ->first();
        // get the image profile of user
        $data["imageProfile"] = $images->select("path")->find($data["utilisateur"]["image_id"]);

        return view('form_post', $data);
    }

    /**
     * show the form to update
     */
    public function update(string $segment){
        if (!session()->has('id'))
            return view('auth_view');
        $publication = new PublicationModel();
        $utilisateur = new UtilisateurModel();
        $images = new ImageModel();

        $user = $utilisateur->select('utilisateurs.id, utilisateurs.username, image_id')
            ->where('id', session()->get('id'))
            ->first();
        // get the image profile of user
        $imageProfile = $images->select("path")->find($user["image_id"]);

            // image of each post
        $publication = $publication->find($segment);
        $image = $images->select('path, id as image_id')->where('publication_id', $publication['id'])->findAll(2);

        return view('form_post', ['utilisateur' => $user,
            'publication'=>$publication,
            'images' => $image,
            'imageProfile' => $imageProfile    
        ]);
    }

    /**
     * save updated
     */
    public function store(string $segment) {
        if (!session()->has('id'))
            return view('auth_view');
        $publication = new PublicationModel();
        $lastImage = new ImageModel();
        $newImage = new ImageModel();
        $publicPath = ROOTPATH . 'public' . DIRECTORY_SEPARATOR .'assets' . DIRECTORY_SEPARATOR . 'uploads';

        // save post
        $publication = $publication->update( $segment,[
            "titre" => $this->request->getPost('title'), 
            "description" => $this->request->getPost('description'),
        ]);

        // save image
        if ($imagefile = $this->request->getFiles()) {
            $lastImage = $lastImage->select('path, id as image_id')->where('publication_id', $segment)->findAll(2);

            foreach ($imagefile['images'] as $i => $img) {
                if ($i==2) break;
                if ($img->isValid() && !$img->hasMoved()) {
                    $filepath = WRITEPATH . 'uploads' . DIRECTORY_SEPARATOR . $img->store();

                    $f = new file(ROOTPATH . 'public' . $lastImage[$i]['path']);
                    // delete last image saved
                    try {
                        unlink($f->getRealPath());
                    } catch (ErrorException $error) {
            
                    }

                    $fl = new file($filepath);
                    $fl = $fl->move($publicPath);

                    $newImage->update( $lastImage[$i]['image_id'],[
                        'path' => DIRECTORY_SEPARATOR .'assets' . DIRECTORY_SEPARATOR . 'uploads'.DIRECTORY_SEPARATOR.$fl->getFilename()
                    ]);
                    
                }
            }
        }
        
        return redirect('/');
    }

    /**
     * delea a post
     */
    public function delete(string $segment) {
        if (!session()->has('id'))
            return view('auth_view');
        $publication = new PublicationModel();
        $images = new ImageModel();

        $image = $images->select('path, id as image_id')->where('publication_id', $segment)->findAll(2);

        foreach($image as $img) {
            $f = new file(ROOTPATH . 'public' . $img['path']);
            try {
                unlink($f->getRealPath());
            } catch (ErrorException $error) {

            }
        }

        $publication->delete($segment);
        return redirect()->to('/profile');
    }

    /**
     * save the new publication
     */
    public function Save()
    {
        if (!session()->has('id'))
            return view('auth_view');
        $publication = new PublicationModel();
        $image = new ImageModel();
        $publicPath = ROOTPATH . 'public' . DIRECTORY_SEPARATOR .'assets' . DIRECTORY_SEPARATOR . 'uploads';

        // save post
        $publication = $publication->insert([
            "titre" => $this->request->getPost('title'), 
            "description" => $this->request->getPost('description'),
            "categorie" => $this->request->getPost('categorie'),
            "id_utilisateur" => session()->get('id')
        ]);

        // save image
        if ($imagefile = $this->request->getFiles()) {
            foreach ($imagefile['images'] as $i => $img) {
                if ($i==2) break;
                if ($img->isValid() && !$img->hasMoved()) {
                    $filepath = WRITEPATH . 'uploads' . DIRECTORY_SEPARATOR . $img->store();
                    $f = new file($filepath);
                    $f = $f->move($publicPath);
                    // move_uploaded_file( $filepath , ROOTPATH . 'public' . DIRECTORY_SEPARATOR .'assets' . DIRECTORY_SEPARATOR . 'uploads');
                    $image->insert([
                        'publication_id' => $publication,
                        'path' => DIRECTORY_SEPARATOR .'assets' . DIRECTORY_SEPARATOR . 'uploads'.DIRECTORY_SEPARATOR.$f->getFilename()
                    ]);
                }
            }
        }
        
        return redirect('/');
    }

    public function search(){
        if (!session()->has('id'))
            return view('auth_view');
        $images = new ImageModel();
        $model = new PublicationModel();
        $inputValue = $this->request->getPost('input_recherche');
        $data = [
            "posts" => $model->like('titre', $inputValue)
                             ->orLike('description', $inputValue)
                             ->getPublication()     
        ];

        // get image of each post
        foreach ($data['posts'] as $key => $post) {
            array_push($data['posts'][$key], $images->select('images.path')->where('publication_id', $post['publication_id'])->findAll(2));
        }

        return view('show_post', $data);
    }

    public function filter(){
        if (!session()->has('id'))
            return view('auth_view');
        $model = new PublicationModel();
        $images = new ImageModel();
        $categorie = $this->request->getPost('input_filtre');

        //filtre publications récentes
        if($categorie == 'recents'){
            $timestamp_3j_avant = time() - (3 * 24 * 60 * 60);
            $date_3j_avant = date("Y-m-d", $timestamp_3j_avant);

            $data = [
                "posts" => $model->where('date_creation >', $date_3j_avant)
                                 ->getPublication()
            ];


            // get image of each post
            foreach ($data['posts'] as $key => $post) {
                array_push($data['posts'][$key], $images->select('images.path')->where('publication_id', $post['publication_id'])->findAll(2));
            }

            return view('show_post', $data);
        }
        
        else {
            $data = [
                "posts" => $model->like('categorie', $categorie)
                                 ->getPublication()                     
            ];

            // get image of each post
            foreach ($data['posts'] as $key => $post) {
                array_push($data['posts'][$key], $images->select('images.path')->where('publication_id', $post['publication_id'])->findAll(2));
            }

            return view('show_post', $data);
        }
    }


    // function render(string $segment) {

    //     $images = new ImageModel();

    //     return $images->where('path', "/writable/uploads/20241013/1728844014_bfd98b1235a818519439.jpg");
    // }
}
