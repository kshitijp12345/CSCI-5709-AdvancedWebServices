<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommentPost extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }
  /*---------------------------------------------------------------
  /              INSERT DATA INTO DATABASE
  /----------------------------------------------------------------
  /   This method is responsible for inserting the data into the
  /   database.
  /   $data= data array consisting data to be added into the
  databse.
  /
  */
  public function create($data){
    $this->db->insert('comment',$this->db->escape_str($data));
  }

  public function get_categories(){
  		$query=$this->db->query("SELECT DISTINCT(categories)as categories , COUNT(categories) as count FROM post GROUP BY categories ASC;");
  		return $query->result();
  	}

  public function fetchUserID($post_id){
    $query=$this->db->get_where('post',array('post_id'=>$post_id));
    $row = $query->row();
    $user_id=$row->user_id;
    return $user_id ;
  }

  public function fetchUserName($user_id){
    $query=$this->db->get_where('user',array('id'=>$user_id));
    $row = $query->row();
    $userName=$row->firstname . ' ' .$row->lastname;
    return $userName ;
  }
  public function getUpvoteCount($post_id,$userId){
      //$array = array('post_id' => $post_id,'user_id' => $userId);
      $query=$this->db->get_where('votes',array('post_id'=>$post_id));
      $query= $this->db->get();
      $upvoteCount="";
      $rowcount = $query->num_rows();
      if($rowcount ==0){

        $upvoteCount=0;
      }else{
        $row = $query->row();
        $upvoteCount=$row->upvote;
      }
      return $upvoteCount ;
  }

  public function checkUpvoteCountForUser($post_id,$userId){

    $query=$this->db->get_where('votes',array('post_id'=>$post_id,'user_id' =>$userId));
    $row = $query->row();
    $upvote=$row->upvote;
    return $upvote ;
  }
  public function checkdownvoteCountForUser($post_id,$userId){
    $query=$this->db->get_where('votes',array('post_id'=>$post_id,'user_id' =>$userId));
    $row = $query->row();
    $upvote=$row->downvote;
    return $upvote ;
  }
  public function maintainDownvoteCount($post_id,$user_Id){
    $array = array('post_id' => $post_id,'user_id' => $user_Id);
    $this->db->select('*');
    $this->db->from('votes');
    $this->db->where($array);
    $query= $this->db->get();
    $rowcount = $query->num_rows();
    if($rowcount !=0){
      $downvoted=1;
      $this->db->set('downvote','downvote+1', FALSE);
      //$this->db->set('downvote',$downvote);
      $this->db->where($array);
      $this->db->update('votes');
      //testing
      $this->db->set('downvoted',$downvoted);
      $this->db->where($array);
      $this->db->update('votes');

      $this->db->set('upvoted',0);
      $this->db->where($array);
      $this->db->update('votes');

      $this->db->set('upvote',0);
      $this->db->where($array);
      $this->db->update('votes');
      //
    }else{
      $downvote_new=1;
      $upvote=0;
      $downvoted=1;
      $array_new = array('post_id' => $post_id,'user_id' => $user_Id ,'upvote' =>$upvote,'downvote' => $downvote_new ,'downvoted'=>$downvoted);
      //$array_new = array('post_id' => $post_id,'user_id' => $user_Id ,'upvote' =>$upvote,'downvote' => $downvote_new);
      $query=$this->db->insert('votes',$array_new);

      $this->db->set('upvoted',0);
      $this->db->where($array);
      $this->db->update('votes');

      $this->db->set('upvote',0);
      $this->db->where($array);
      $this->db->update('votes');
    }
  }

  public function maintainVotesCount($post_id,$upvoteCountData,$userId){
    //$array = array('post_id' => $post_id, 'user_id' => $userId);
    //$query=$this->db->where($array);
    $array = array('post_id' => $post_id,'user_id' => $userId);
    $this->db->select('*');
    $this->db->from('votes');
    $this->db->where($array );
    $query= $this->db->get();
    $rowcount = $query->num_rows();
    if($rowcount == 0){
      $upvote_new=1;
      $downvote=0;
      $upvoted=1;
      $array_new = array('post_id' => $post_id,'user_id' => $userId ,'upvote' =>$upvote_new,'downvote' =>$downvote ,'upvoted'=> $upvoted);
      //$array_new = array('post_id' => $post_id,'user_id' => $userId ,'upvote' =>$upvote_new,'downvote' =>$downvote);
     $query=$this->db->insert('votes',$array_new);
     //set downvote vote count to zer0
     $this->db->set('downvoted',0);
     $this->db->where($array);
     $this->db->update('votes');
     //set downvote vote count to zer0
     $this->db->set('downvote',0);
     $this->db->where($array);
     $this->db->update('votes');
   }else{
     $array_new = array('post_id' => $post_id,'user_id' => $userId );
     $this->db->set($this->db->escape_str($array_new));
     $this->db->where($array);
     $this->db->set('upvote', 'upvote+1', FALSE);
     $this->db->where($array);
     $this->db->update('votes');
     //testing
     $upvoted=1;
     $this->db->set('upvoted',$upvoted);
     $this->db->where($array);
     $this->db->update('votes');
     //set downvoted vote count to zer0
     $this->db->set('downvoted',0);
     $this->db->where($array);
     $this->db->update('votes');
     //set downvote vote count to zer0
     $this->db->set('downvote',0);
     $this->db->where($array);
     $this->db->update('votes');
   }

   //echo $this->db->last_query();

  }

  /*---------------------------------------------------------------
  /              INSERT DATA INTO DATABASE
  /----------------------------------------------------------------
  /   This method is responsible for inserting the data into the
  /   database.
  /   $data= data array consisting data to be added into the
  databse.
  /
  */
  public function insertAbuseData($data){
      $this->db->insert('report',$this->db->escape_str($data));
  }

  public function load_uploadedComments($data){
    $parentId=0;
    $this->db->order_by('comment_id','DESC');
    $this->db->select('*');
    $this->db->from('comment');
    $this->db->where(array('comment.parent_comment_id' => $parentId, 'comment.post_id' => $data));
    $query= $this->db->get();
    $queryResult=$query->result_array();
    return $queryResult;
  }
  /*---------------------------------------------------------------
  /              FETCH REPLY TO A COMMENT
  /----------------------------------------------------------------
  /   This method is responsible for fetching the comments reply from
  /   database.
  /   $parent_id= This is the parent comment id to which the reply
  needs to be attached.
  /
  */
  public function load_reply_comments($parent_id,$post_id){
    $this->db->select('*');
    $this->db->from('comment');
    $this->db->where(array('comment.parent_comment_id' => $parent_id, 'comment.post_id' => $post_id));
    $query= $this->db->get();
    $queryResult=$query->result_array();
    return $queryResult;
  }
  /*---------------------------------------------------------------
  /              UPDATE UPVOTE COUNT ON PAGE LOAD
  /----------------------------------------------------------------
  /   This method is responsible for fetching the upvote count on
  /   page load
  /
  /   $post_id=This is the Post id of the post to which the user
  /   has upvoted.
  /
  */
  public function fetchUpvoteCount($post_id){

    $query=$this->db->get_where('post',array('post_id'=>$post_id));
    $row = $query->row();
    $upvote=$row->upvote;
    return $upvote ;
  }
  /*---------------------------------------------------------------
  /              UPDATE DOWNVOTE COUNT ON PAGE LOAD
  /----------------------------------------------------------------
  /   This method is responsible for fetching the downvote count on
  /   page load
  /
  /   $post_id=This is the Post id of the post to which the user
  /   has upvoted.
  /
  */
  public function fetchDownvoteCount($post_id){
    $query=$this->db->get_where('post',array('post_id'=>$post_id));
    $row = $query->row();
    $downvote=$row->downvote;
    return $downvote;
  }

  /*---------------------------------------------------------------
  /              UPDATE UPVOTE COUNT
  /----------------------------------------------------------------
  /   This method is responsible for updating upvote count on
  /   page load
  /
  /   $post_id=This is the Post id of the post to which the user
  /   has upvoted.
  /
  /   $data= The upvote count to be updated into the database.
  /
  */
  public function updateUpvote($post_id,$data){
    $count=$this->fetchDownvoteCount($post_id);
    if($count !=0){
      $array = array('post_id' => $post_id);
      $this->db->set('downvote', 'downvote-1', FALSE);
      $this->db->where($array);
      $this->db->update('post');
    }
      $this->db->set($this->db->escape_str($data));
      $this->db->where('post_id',$post_id);
      $this->db->update('post');
      $query=$this->db->get_where('post',array('post_id'=>$post_id));
      $row = $query->row();
      $upvote=$row->upvote;

    return $upvote ;
  }

  /*---------------------------------------------------------------
  /              UPDATE DOWNVOTE COUNT
  /----------------------------------------------------------------
  /   This method is responsible for updating downvote count on
  /   page load
  /
  /   $post_id=This is the Post id of the post to which the user
  /   has upvoted.
  /
  /   $data= The upvote count to be updated into the database.
  /
  */
  public function updateDownvote($post_id,$data,$user_Id){
    $count=$this->fetchUpvoteCount($post_id);
    if($count !=0){
      $array = array('post_id' => $post_id);
      $this->db->set('upvote', 'upvote-1', FALSE);
      $this->db->where($array);
      $this->db->update('post');
    }
    $this->db->set($data);
    $this->db->where('post_id',$post_id);
    $this->db->update('post');
    $query=$this->db->get_where('post',array('post_id'=>$post_id));
    $row = $query->row();
    $downvote=$row->downvote;

    return $downvote ;
  }


  public function getCounts($user_id) {
    $query = $this->db->query("SELECT COUNT(comment_id) as count FROM comment WHERE user_id = $user_id ");
		$result = $query->row_array();
		$result = (int)$result["count"];
		return $result;
  } 

  public function get_user_comments($user_id) {
    $query=$this->db->get_where('comment',array('user_id'=>$user_id));
    return $query->result();
  }

  public function deleteComment($data) {
    if (!empty($data)) {
			$this->db->where_in('comment_id', $data);
			return $this->db->delete('comment');
		}
  }


  public function fetch_comment_activites($user_id) {
    $this->db->select('comment.comment_id, comment.comment, comment.date_added, user.firstname, user.lastname, user.id, post.post_title');
		$this->db->from('comment');
    $this->db->join('user', 'comment.user_id = user.id', 'left inner'); 
    $this->db->join('post', 'comment.post_id = post.post_id', 'left inner');
    $this->db->where("comment.user_id !=",$user_id);
    $this->db->where(array('post.user_id'=>$user_id));
		$this->db->order_by('comment.date_added', 'DESC');

    $query = $this->db->get();
    //echo $this->db->last_query();
		return $query->result();
  }

  public function fetch_vote_activites($user_id) {
    $this->db->select('votes.vote_id, comment.comment, comment.date_added, user.firstname, user.lastname, user.id, post.post_title');
		$this->db->from('votes');
    $this->db->join('user', 'comment.user_id = user.id', 'left inner'); 
    $this->db->join('post', 'comment.post_id = post.post_id', 'left inner');
    $this->db->where("comment.user_id !=",$user_id);
    $this->db->where(array('post.user_id'=>$user_id));
		$this->db->order_by('comment.date_added', 'DESC');

    $query = $this->db->get();
    echo $this->db->last_query();
		return $query->result_array();
  }
}
?>
