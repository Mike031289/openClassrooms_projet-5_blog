<?php

class PostManager extends BaseManager
{
    public function __construct($datasource)
    {
        parent::__construct("post", "Post", $datasource);
    }

    public function getById($id)
    {
        return $this->findOneBy(array("id" => $id));
    }

    public function getAll()
    {
        return $this->findAll();
    }

    public function create(Post $post)
    {
        $data = array(
            "titre" => $post->getTitre(),
            "chapeau" => $post->getChapeau(),
            "images" => $post->getImages(),
            "date_publication" => $post->getDatePublication(),
            "date_mise_a_jour" => $post->getDateMiseAJour(),
            "id_utilisateur" => $post->getUtilisateurId()
        );

        return $this->insert($data);
    }

    public function update(Post $post)
    {
        $data = array(
            "titre" => $post->getTitre(),
            "chapeau" => $post->getChapeau(),
            "images" => $post->getImages(),
            "date_publication" => $post->getDatePublication(),
            "date_mise_a_jour" => $post->getDateMiseAJour(),
            "id_utilisateur" => $post->getUtilisateurId()
        );

        return $this->updateById($post->getId(), $data);
    }

    public function delete(Post $post)
    {
        return $this->deleteById($post->getId());
    }
}
