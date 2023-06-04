<?php

namespace App\Controllers;

class Notifications extends BaseController
{
    function getNotifications()
    {
        return view('dashboard/admin/notification');
    }

    function postNotification($view)
    {
        date_default_timezone_set('Asia/Manila');

        // Get the current date in Manila timezone
        $currentDateTime = new \DateTime('now', new \DateTimeZone('Asia/Manila'));
        $currentDate = $currentDateTime->format('Y-m-d');
        $loggedUser = session()->get('name');

        if (isset($_POST['view'])) {
            $con = mysqli_connect("localhost", "root", "", "tup-dms");

            if ($_POST["view"] != '') {
                $update_query = "UPDATE comments SET comment_status = 1 WHERE comment_status=0";
                mysqli_query($con, $update_query);
            }
            $query = "SELECT * FROM comments WHERE reminder_date = '$currentDate' AND username = '$loggedUser' ORDER BY comment_id DESC LIMIT 5";
            $result = mysqli_query($con, $query);
            $output = '';
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $output .= '
                        <div class="p-2 rounded-md mt-1">
                            <a href="#">
                            <strong>' . $row["comment_subject"] . '</strong><br />
                            <small><em>' . $row["comment_text"] . '</em></small><br />
                            <small><em>' . $row["reminder_date"] . '</em></small>
                            </a>
                        </div>
                        ';
                }
            } else {
                $output .= '
                    <div><a href="#" class="text-bold text-italic">No Notifications</a></div>';
            }



            $status_query = "SELECT * FROM comments WHERE comment_status=0";
            $result_query = mysqli_query($con, $status_query);
            $count = mysqli_num_rows($result_query);
            $data = array(
                'notification' => $output,
                'unseen_notification'  => $count
            );

            echo json_encode($data);
        }
    }

    function postNewNotification()
    {
        if (isset($_POST["subject"])) {
            $con = mysqli_connect("localhost", "root", "", "tup-dms");
            $subject = mysqli_real_escape_string($con, $_POST["subject"]);
            $date = mysqli_real_escape_string($con, $_POST["date"]);
            $comment = mysqli_real_escape_string($con, $_POST["comment"]);
            print_r($date);
            $query = "
                INSERT INTO comments(comment_subject, reminder_date, comment_text)
                VALUES ('$subject', '$date', '$comment')
            ";
            mysqli_query($con, $query);
        }
    }
}
