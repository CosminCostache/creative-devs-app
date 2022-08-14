<?php
class Games extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Game');
        $this->userModel = $this->model('User');
    }

    public function xsio()
    {
        $data = [];

        $this->view('games/xsio', $data);
    }

    public function fazan()
    {
        $data = [
            'cuvant' => '',
            'cuvant_err' => '',
            'last2letters' => ''
        ];

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function randLetter()
        {
            $int = rand(0, 51);
            $a_z = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $rand_letter = $a_z[$int];
            return $rand_letter;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'cuvant' => test_input($_POST["cuvant"]),
                'cuvant_err' => '',
                'last2letters' => '',
                'random_letter' => strtoupper(randLetter()),
                'scor' => '',
                'jucatori' => test_input($_SESSION['user_name'])
            ];

            if (array_key_exists('start_btn', $_POST)) {
                $data['random_letter'];
            }

            // Validate data
            if (empty($data['cuvant'])) {
                $data['cuvant_err'] = 'Te rog introduce un cuvant valid...';
            } else {
                $data['last2letters'] = substr($data['cuvant'], -2);

                if ($data['last2letters'] == 'nt') {
                    $data['scor'] = 'F';
                    $data['last2letters'] = '';
                    $data['random_letter'] = '';
                }
            }
            $this->view('games/fazan', $data);
        } else {
            $data = [
                'cuvant' => '',
                'cuvant_err' => '',
                'last2letters' => ''
            ];

            $this->view('games/fazan', $data);
        }
    }
}