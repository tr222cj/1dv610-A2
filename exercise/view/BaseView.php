<?php
declare (strict_types = 1);

namespace view;

class BaseView {

    /**
     * @param string $view
     * @param array $data
     * @throws \Exception
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
     */
    public function renderError(string $view) {
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
