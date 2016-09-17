<?php

/**
 * Class View
 * Handles rendering of specified view
 */
class View {

    /**
     * Render specified view with optional data
     * @param string $view The view to render
     * @param array $data Any data that you want presented in the view
     */
    public function render($view, $data) {
        // Add each item in the array as variables in the object
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }

        $view = './view/'.$view.'.php';
        require_once('./view/LayoutView.php');
    }
}