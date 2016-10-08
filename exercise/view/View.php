<?php
declare (strict_types = 1);

namespace view;

final class View {

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

        self::renderRequestedView($view);

        require('./view/layout/footer.php');
    }

    public function renderError(string $view) {
        require('./view/layout/header.php');

        self::renderRequestedView($view);

        require('./view/layout/footer.php');
    }

    private function renderRequestedView(string $view) {
        $view = './view/' . $view . '.php';

        if (file_exists($view)) {
            require($view);
        } else {
            throw new \Exception("View does not exist");
        }
    }
}
