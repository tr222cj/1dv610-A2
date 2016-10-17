<?php
declare (strict_types = 1);

namespace view;

abstract class BaseView {

    /**
     * @param string $view
     * @param array $data
     */
    public function render(string $view, array $data = []) {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }

        require('./view/layout/header.php');

        require('./view/layout/content.php');

        $this->renderRequestedView($view);

        require('./view/layout/footer.php');
    }

    /**
     * @param string $view
     * @param array $data
     */
    public function renderWithoutMenu(string $view, array $data = []) {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }

        require('./view/layout/header.php');

        $this->renderRequestedView($view);

        require('./view/layout/footer.php');
    }

    /**
     * @param string $view
     * @throws \Exception
     */
    private function renderRequestedView(string $view) {
        $view = './view/' . $view . '.php';

        if (file_exists($view)) {
            require($view);
        } else {
            throw new \Exception("View does not exist");
        }
    }
}
