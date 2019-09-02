<?php
//Author: Kshitij Paithankar
//BannerId:B00800573
defined('BASEPATH') OR exit('No direct script access allowed');
class Comments extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('commentPost');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->helper('security');
    $this->load->helper('url');
  }
  public function reportAbuse(){

    $name=$this->input->post('name');
    $email=$this->input->post('emailID');
    $abuseContent=$this->input->post('reportAbuse');
    $post_id=$this->input->post('hiddenPostId');
    $user_id=$this->session->user_id;
    $data=array(
      'name' => $name,
      'email_id' =>$email,
      'abuse_description' =>$abuseContent,
      'post_id' =>$post_id,
      'user_id' =>$user_id

    );
    $formdata=array();
    $this->commentPost->insertAbuseData($data);
    //$this->session->set_flashdata('message','Report Abuse Submitted Successfully');
    //redirect($this->url->index);
    echo "Kshitij";
  }
  /*---------------------------------------------------------------
  /              LOAD COMMENTS FROM DATABASE
  /----------------------------------------------------------------
  /   This method is responsible for fetching the stored comments
  /   from the database and displaying it back in the view.
  /   $data= data array consisting of post id

  /   This method fetches data from the database ,then creates
  /   dynamic html for each comment on a post and the  renders
  /   it back to the view.
  /   $name= name of comment creater.
  */
  public function load_comments_from_database(){
    $data=array();
    $post_id=$this->input->post('post_id');
    $data=array(
      'post_id' =>$post_id

    );
    $result = $this->commentPost->load_uploadedComments($post_id);
    $this->load->library('session');
    $userId= $this->session->user_id; //$this->commentPost->fetchUserID($post_id);
    $userName= $this->session->name; //$this->commentPost->fetchUserName($userId);
    $output = '';
    foreach($result as $row)
    {
      $output .= '
      <div class="row">
      <div class="col-md-12 col-xs-2 col-sm-12">
      <div class="panel panel-default">
      <br />
      <div class="panel-heading" style="color:black; font-size:15.5px;"><img src="assets/images/prof-pic.png" style="border-radius: 50%;height: 30px; width: 5%;">  Commented By <b>'.$userName.'</b> on <i>'.$row["date_added"].'</i></div>
      <div class="panel-body" style="color:black; margin-top:5px;"> '.$row["comment"].'</div>
      <div class="" style="color:#007bff!important; font-size:small; margin-top:5px"><a class="reply" name="'.$row["post_id"].'" id="'.$row["comment_id"].'">Reply</a></div>
      </div>
      ';
      $output .= $this->fetch_reply($row["comment_id"],$row["post_id"]);
    }
    echo $output;
  }
  /*---------------------------------------------------------------
  /              FETCH COMMENTS FROM DATABASE FOR REPLY
  /----------------------------------------------------------------
  /   This method is responsible for fetch ing the stored comments
  /   from the database for reply and displaying it back in the view.
  /   $data= data array consisting of post id
  */
  public function fetch_reply($parent_id = 0,$post_id,$marginleft = 0)
  {
    $name="Yash";
    $output = '';
    $userId=$this->commentPost->fetchUserID($post_id);
    $userName=$userName= $this->session->name;
    $result = $this->commentPost->load_reply_comments($parent_id,$post_id);

    if($parent_id == 0)
    {
      $marginleft = 0;
    }
    else
    {
      $marginleft = $marginleft + 45;
    }
    foreach($result as $row)
    {
      $output .= '
      <div class="row">
      <div class="col-md-12 col-xs-2 col-sm-12">
      <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
      <div class="panel-heading" style="color:black; font-size:15.5px;"><img src="assets/images/prof-pic.png" class="img-responsive" style="border-radius: 50%;height: 30px; width: 5%;">  Replied By <b>'.$userName.'</b> on <i>'.$row["date_added"].'</i></div>
      <div class="panel-body" style="color:black; margin-top:5px;"> '.$row["comment"].'</div>
      <div class="" style="color:#007bff!important; font-size:small; margin-top:5px"><a class="reply"name="'.$row["post_id"].'" id="'.$row["comment_id"].'">Reply</a></div>
      </div>
      ';
      $output .= $this->fetch_reply($row["comment_id"],$row["post_id"],$marginleft);
    }
    return $output;
  }
  /*---------------------------------------------------------------
  /               UPVOTE  A POST
  /----------------------------------------------------------------
  /  This method increments the upvote counter by 1. It
  accepts post id , upvote count and user id and sends
  it to the model to be entered in the database respectively
  */  public function upvotePost(){
        $upvoteData=array();
        // $post_id=1;
        // $upvote_count=2 + 2 ;
        // $upvoteData['post_id']=3;

        $post_id=$_POST['post_id'];
        $upvote_count=$_POST['labelValue'] + 1 ;
        $upvoteData['post_id']=$post_id;
        $userId=$this->session->user_id;
        //$votes_upvoteCount=$this->commentPost->getUpvoteCount($post_id,$userId) +1;
        //$userId=$userId=$this->commentPost->fetchUserID($post_id);
        $upvoteData['upvote_count']=$upvote_count;
        $data=array(
          'upvote' =>$upvote_count
        );
        $upvoteCountData=array(
          'post_id' => $post_id,
          'user_id' => $userId,
          'upvote' => $upvote_count
        );
        $this->commentPost->maintainVotesCount($post_id,$upvoteCountData,$userId);
        $count=$this->commentPost->checkUpvoteCountForUser($post_id,$userId);
        //print_r($count);
        if($count <= 1){
          $upvoteData['vote_count']=$this->commentPost->updateUpvote($post_id,$data);
        }else{
          $upvoteData['vote_count']=$_POST['labelValue'];
        }
        $voteCount= $upvoteData['vote_count'];
        $upvoteData['downvoteCount']=$this->commentPost->fetchDownvoteCount($post_id);
        $this->session->set_flashdata('upvoteCount', $voteCount);
        echo json_encode($upvoteData);
   }
  /*---------------------------------------------------------------
  /               DOWNVOTE  A POST
  /----------------------------------------------------------------
  /   This method increments the downvote counter by 1. It
  /   accepts post id , downvote count and user id and sends
  /   it to the model to be entered in the database respectively.
  /   Also this method decrements the upvote counter by 1
  /
  /   $data = data array to be passed to the model
  /   $upvoteData = data array for decrementing the upvote counter.
  */
  public function downvotePost(){
    $downvoteData=array();
    $post_id=$_POST['post_id'];
    $downvote_count=$_POST['labelValue'] + 1 ;
    $user_Id=$this->session->user_id;
    $data=array(
      'downvote' =>$downvote_count
    );
    $this->commentPost->maintainDownvoteCount($post_id,$user_Id);
    $count=$this->commentPost->checkdownvoteCountForUser($post_id,$user_Id);
    if($count <=1){
        $downvoteData['vote_count']=$this->commentPost->updateDownvote($post_id,$data,$user_Id);
    }else{

    $downvoteData['vote_count']=$_POST['labelValue'];
    }
    $downvoteData['upvote_count']=$this->commentPost->fetchUpvoteCount($post_id);
    echo json_encode($downvoteData);
  }
  /*---------------------------------------------------------------
  /              LOAD AJAX VALUES ON PAGE LOAD
  /----------------------------------------------------------------
  /   The values such as upvote and downvote fetched using a Ajax
  /   call get lost after a page refresh leading to incorrect VALUES
  /   getting inserted into the database. This method fetches data
  /   from the database before the page gets loaded and populates
  /   the respective fields.

  /   $upvoteData= data array storing the upvote and downvote return
  /   value from the database.
  */
  public function load_values(){
    $upvoteData=array();
    $post_id=$_POST['post_idCount'];
    $upvoteData['post_id']=$post_id;
    $upvoteData['vote_count_initial']=$this->commentPost->updateUpvoteCount($post_id);
    $upvoteData['downvote_count_initial']=$this->commentPost->updateDownvoteCount($post_id);
    echo json_encode($upvoteData);
  }

  public function checkCount(){
    $form_data = array();
    $connect = new PDO('mysql:host=localhost;dbname=comments', 'root', 'password');
    $query = "SELECT * FROM comment  WHERE parent_comment_id = '0' ORDER BY comment_id DESC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    $form_data['count']=$count;
    echo json_encode($count);
  }
  /*---------------------------------------------------------------
  /              INSERT COMMENTS TO DATABASE
  /----------------------------------------------------------------
  /   This method accepts the comment data from the view and then
  /   inserts the data into the database. It accepts a data array
  /   of parent_id , coment, post_id and user_id and the calls the
  /   model to insert data. Moreover in order to avoid XSS attack
  /   the data is cleaned before being added into the database.
  /
  */
  public function insertData(){
    $this->form_validation->set_rules('postComment', 'PostComment',  'required');
    $parent_id = $_POST['parent_id'];
    $dataPost = $_POST['postComment'];
    $post_id = $_POST['post_id'];
    //$userId=$this->commentPost->fetchUserID($post_id);

    $this->load->library('session');
    $user_id = $this->session->user_id;

    $data=array(
      'parent_comment_id' => $parent_id,
      'comment'    => $dataPost,
      'post_id'    => $post_id,
      'user_id'    => $user_id
    );

    $data=$this->security->xss_clean($data);
    if($this->form_validation->run() === TRUE)
    {
      $this->commentPost->create($data);
    } else {
      echo "validation error";
    }
    $form_data = array(); //Pass back the data to `form.php`
    $form_data['parent_id'] = $parent_id;
    $form_data['userId'] = $user_id;
    echo json_encode($form_data);
  }

  public function delete() {
    if(!isset($_POST["selected_comments"])) {
			redirect(base_url().'account/profile');
		}

		if($this->commentPost->deleteComment($_POST["selected_comments"])) {
			$this->session->set_flashdata('msg', 'Comment(s) Successfully Deleted');
		} else {
			$this->session->set_flashdata('msg', 'Something unexpected happened, please try again later');
		}
		redirect(base_url().'account/profile');
  }
}
?>
