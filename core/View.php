<?php
declare (strict_types = 1);

namespace core;

final class View {

    /**
     * @param string $view
     * @param array $data
     * @throws \Exception
     */
    public function render(string $view, array $data) {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }

        $view = './view/' . $view . '.php';

        require('./view/layout/header.php');

        if (file_exists($view)) {
            require($view);
        } else {
            throw new \Exception("View does not exist");
        }

        require('./view/layout/footer.php');
    }
}
