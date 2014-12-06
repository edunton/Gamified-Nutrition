<?php
/**
 * Created by PhpStorm.
 * User: Sida
 * Date: 11/23/2014
 * Time: 2:47 PM
 */


namespace Display;

use Facade\UserHistoryFacade as UHF;


class HistoryPage extends Page
{

    public function __construct()
    {
        parent::__construct('View History', 'History', '');
        if(isset($_GET['delete']))
        {
            UHF::delete_history_item($this->getUser(),$_GET['delete']);
        }
        $item = '';
        $brand = '';
        $confirmation = false; // Whether we need a confirmation for successfully adding a history
        // confirmation message
        $msg = <<<EOD
                    <div class="alert alert-success" role="alert">Congratulations! You have successfully added a new record to your history!</br>Keep searching if you want to add more.</div>

EOD;

        if (count($_POST) > 0) {
            // enter HistoryPage by adding a history
            if (isset($_POST['servings']) && isset($_POST['date']) && isset($_POST['itemID'])) {
                $itemID = $_POST["itemID"];
                $userID = $this->getUser();
                $servings = $_POST["servings"];
                $date = $_POST["date"];
                str_replace("/","-","$date");
                UHF::enter_history_item($userID, $itemID, intval($servings), $date);
                $history = UHF::get_history_by_user($userID);
                $confirmation = true;
            } // enter HistoryPage by clicking the History button in the nav bar
            else {
                $userID = $this->getUser();
                $history = UHF::get_history_by_user($userID);
                //echo $history;
            }
        }
        else{
            $userID = $this->getUser();
            $history = UHF::get_history_by_user($userID);
        }
        $lst = function () use (&$history) {

                $offset = sizeof($history);

                if ($offset !== 0) {

                    echo '<div class="table-responsive"><table class="table table-striped table-bordered"><thead><tr><th>Name</th><th>Brand</th>><th>Servings</th><th>Total Calories</th><th>Date</th><th>Delete</th></tr></thead><tbody>';

                    for ($i = 0; $i < $offset; $i++) {
                        echo '<tr><td>' . $history[$i]->itemName . '</td><td>' . $history[$i]->brandName . '</td><td>'
                            . $history[$i]->servings . '</td><td>' . $history[$i]->calories .'</td><td>'
                            . $history[$i]->historyDate . '</td><td><a href="history.php?delete='.$history[$i]->historyID.'">
                            <i class="icon-remove" style="color: red; font-size: 14pt;">x</i></a></td></tr>';
                    }

                } else {

                    echo '<div class="alert alert-info" role="alert">No history so far!</div>';
                }
        };


        if (!$confirmation) {
            $sb = new SearchBar('search.php');
            $sbstr = $sb->display(NULL, 'row', $item, $brand);
            $this->setBodyFromString($sbstr);
            $this->setBodyFromCallable($lst);


        } else {
            $sb = new SearchBar('search.php');
            $sbstr = $sb->display(NULL, 'row', $item, $brand);
            $this->setBodyFromString($sbstr);
            $this->setBodyFromString($msg);
            $this->setBodyFromCallable($lst);


        }



    }
}






