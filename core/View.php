<?php
declare (strict_types = 1);

namespace core;

final class View {

    /**
     * @param string $view
     * @param array $data
     */
    public function render(string $view, array $data) {
        // Add each item in the array as variables in the object
        // http://stackoverflow.com/questions/829823/can-you-create-instance-properties-dynamically-in-php
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }

        $view = './view/' . $view . '.php';
        require_once('./view/LayoutView.php');
    }
}
