public function display()
    {
        $posts = $this->postRepository->getAll();
        $template = $this->twig->load('home.html.twig');
        $content = $template->render(['posts' => $posts]);

        $layout = $this->twig->load('layout.html.twig');
        echo $layout->render(['content' => $content]);
    }