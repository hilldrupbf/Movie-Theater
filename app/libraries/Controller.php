<!-- Core controller class -->
<!-- Makes it so we can easily load models and views from other controllers -->
<?php
    /*
    * Base Controller
    * Loads the models and views
    */
    class Controller {
        // Function to load model
        public function model($model) {
            // Require model file
            require_once '../app/models/' . $model . '.php';

            // Instantiate the model
            return new $model();
        }

        // Function to load view
        public function view($view, $data = []) {
            // Check for the view file
            if(file_exists('../app/views/' . $view . '.php')) {
                require_once '../app/views/' . $view . '.php';
            }
            else {
                // Stop the function and print an error
                die('View does not exist');
            }
        }

    }
