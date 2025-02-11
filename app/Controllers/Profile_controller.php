<?php
namespace App\Controllers;

use App\Models\ImageModel;
use App\Models\PublicationModel;
use App\Models\UtilisateurModel;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Request;
use ErrorException;

class Profile_controller extends BaseController{

    public function index(){
        if (!session()->has('id'))
            return view('auth_view');
        $modele_publication = new PublicationModel();
        $modele_utilisateur = new UtilisateurModel();
        $images = new ImageModel();

        $data = [
            "posts" => $modele_publication->where('id_utilisateur', session()->get('id'))->getPublication(),
            "nb_posts" => $modele_publication->where('id_utilisateur', session()->get('id'))->countAllResults(),
            "utilisateur" => $modele_utilisateur->select('utilisateurs.id, utilisateurs.username, utilisateurs.email, utilisateurs.telephone, image_id, utilisateurs.created_ad')
                            ->where('id', session()->get('id'))
                            ->first()
        ];

        // get the image profile of user
        $data["imageProfile"]= $images->select("path")->find($data["utilisateur"]["image_id"]);
        // get image of each post
        foreach ($data['posts'] as $key => $post) {
            array_push($data['posts'][$key], $images->select('images.path')->where('publication_id', $post['publication_id'])->findAll(2));
        }

        return view('profile_view', $data);
    }

    public function updated() {
        // save image
        $image = new ImageModel();
        $utilisateur = new UtilisateurModel();
        $images = new ImageModel();

        $publicPath = ROOTPATH . 'public' . DIRECTORY_SEPARATOR .'assets' . DIRECTORY_SEPARATOR . 'uploads';
        $user = $utilisateur->select('image_id')->find(session()->get('id'));

        // delete last image
        $lastImage = $images->select('path, id as image_id')->find($user['image_id']);
        $f = new file(ROOTPATH . 'public' . $lastImage['path']);
        // try {
            if (!("\assets\uploads\user.png"==$lastImage['path'])) {
                unlink($f->getRealPath());
            }

        // } catch (ErrorException $error) {

        // }

        $newImage =  $this->request->getFile('imageProfile');

        if ($newImage->isValid() && !$newImage->hasMoved()) {
            $filepath = WRITEPATH . 'uploads' . DIRECTORY_SEPARATOR . $newImage->store();
            $f = new file($filepath);
            $f = $f->move($publicPath);
            $image->update( $lastImage['image_id'],[
                'path' => DIRECTORY_SEPARATOR .'assets' . DIRECTORY_SEPARATOR . 'uploads'.DIRECTORY_SEPARATOR.$f->getFilename()
            ]);
        }

        return redirect()->to('/profile');
    }
}