<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Wall
 *
 * @author miltone
 */
class Walllib {
    //put your code here

    /**
     * __get
     *
     * Enables the use of CI super-global without having to define an extra variable.
     *
     * I can't remember where I first saw this, so thank you if you are the original author. -Militis
     *
     * @access	public
     * @param	$var
     * @return	mixed
     */
    public function __get($var) {
        return get_instance()->$var;
    }

    function update_post($content, $post_img_ids, $wall_id, $friendtaglist = '') {
        $post_array = array(
            'content' => $content,
            'wall_id' => $wall_id,
            'postedby' => current_user()->id,
            'tagfriend' => $friendtaglist,
        );
        $post_id = $this->wall_model->updatepost($post_array);
        if ($post_id) {
            if ($post_img_ids <> '') {
                $this->wall_model->updatepostIMG($post_id, explode(',', $post_img_ids));
            }

            return $post_id;
        }

        return FALSE;
    }

    function get_post($post_id) {
        $current_user = current_user();
        $value = $this->wall_model->get_post($post_id);
        $display = '';

        $userinfo = current_user($value->postedby);
        $display .= '<div  class="postitem"  postid="' . $value->id . '">';
        $display .= '<div class="post-header">
                   <div class="post-header-img"><a href="' . site_url('timeline/' . $userinfo->username) . '"><img src="' . PROFILE_IMG_PATH . $userinfo->profile_photo . '" class="' . ($current_user->id == $value->postedby ? ' currentuser-profile_photo' : '') . '  timeline-user-img"/></a></div>
                   <div class="post-header-title">
                   <div class="timeline-1st-titlediv"><a class="text-bizhuruY" href="' . site_url('timeline/' . $userinfo->username) . '">' . $userinfo->firstname . ' ' . $userinfo->lastname . '</a>';
        if ($value->postedby != $value->wall_id) {
            $walluser = current_user($value->wall_id);
            $display.= ' >> <a class="text-bizhuruY" href="' . site_url('timeline/' . $walluser->username) . '">' . $walluser->firstname . ' ' . $walluser->lastname . '</a>';
        }
        $display.='</div>
                   <div class="timeline-2nd-titlediv">ddddddddddddd</div>
                   </div>
                   <div class="post-action">Delete</div>
<div class="clearboth"></div>
                       </div>';

        $display.= '<div class="post-body">' . $value->content . '</div>';

        $post_images = $this->wall_model->get_postimg($value->id);
        if ($post_images) {
            $display .= '<div class="timeline-thumbdiv">';
            $total_image = count($post_images);
            $class = '';
            if ($total_image == 1) {
                $class = 'timeline-thumb-img-single';
            } else if ($total_image == 2) {
                $class = 'timeline-thumb-img-double';
            } else {
                $class = 'timeline-thumb-img-tripple';
            }
            foreach ($post_images as $imgkey => $imgvalue) {
                $display .= '<img  class="timeline-thumb-img  ' . $class . '" src="' . WALL_IMG_PATH . $imgvalue->photo . '"/>';
            }
            $display .= '<div class="clearboth"></div></div>';
        }

        $display .= '</div>';




        return $display;
    }

    function get_wallpost($wall_id) {
        $current_user = current_user();
        $post_list = $this->wall_model->get_postbywall($wall_id);
        $display = '';
        foreach ($post_list as $key => $value) {
            $userinfo = current_user($value->postedby);
            $display .= '<div  class="postitem"  postid="' . $value->id . '">';
            $display .= '<div class="post-header">
                   <div class="post-header-img"><a href="' . site_url('timeline/' . $userinfo->username) . '"><img src="' . PROFILE_IMG_PATH . $userinfo->profile_photo . '" class="' . ($current_user->id == $value->postedby ? ' currentuser-profile_photo' : '') . '  timeline-user-img"/></a></div>
                   <div class="post-header-title">
                   <div class="timeline-1st-titlediv"><a class="text-bizhuruY" href="' . site_url('timeline/' . $userinfo->username) . '">' . $userinfo->firstname . ' ' . $userinfo->lastname . '</a>';
            if ($value->postedby != $value->wall_id) {
                $walluser = current_user($value->wall_id);
                $display.= ' <i class="glyphicon glyphicon-triangle-right trianglearrow text-brown"></i> <a class="text-bizhuruY" href="' . site_url('timeline/' . $walluser->username) . '">' . $walluser->firstname . ' ' . $walluser->lastname . '</a>';
            }
            $display.='</div>
                   <div class="timeline-2nd-titlediv">ddddddddddddd</div>
                   </div>
                   <div class="post-action">
                   <div class="btn-group">
                   <a class="post-action-dropdown dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="false"><i class="fa fa-angle-down"></i></a>
                  <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="elements.html#" tabindex="-1">
                                                            <i class="dropdown-icon fa fa-camera"></i>
                                                            Gallery
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="elements.html#" tabindex="-1">
                                                            <i class="dropdown-icon fa fa-envelope"></i>
                                                            Inbox
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="elements.html#" tabindex="-1">
                                                            <i class="dropdown-icon fa fa-cloud-download"></i>
                                                            Download
                                                        </a>
                                                    </li>

                                                    <li class="divider"></li>
                                                    <li>
                                                        <a href="elements.html#" tabindex="-1">
                                                            <i class="dropdown-icon glyphicon glyphicon-cog"></i>
                                                            Settings
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="elements.html#" tabindex="-1">
                                                            <i class="dropdown-icon glyphicon glyphicon-log-out"></i>
                                                            Log Out
                                                        </a>
                                                    </li>
                                                </ul>
                   </div>
                   </div>
<div class="clearboth"></div>
                       </div>';

            $display.= '<div class="post-body">' . $value->content . '</div>';

            $post_images = $this->wall_model->get_postimg($value->id);
            if ($post_images) {
                $display .= '<div class="timeline-thumbdiv">';
                $total_image = count($post_images);
                $class = '';
                if ($total_image == 1) {
                    $class = 'timeline-thumb-img-single';
                } else if ($total_image == 2) {
                    $class = 'timeline-thumb-img-double';
                } else {
                    $class = 'timeline-thumb-img-tripple';
                }
                foreach ($post_images as $imgkey => $imgvalue) {
                    $display .= '<a href="javascript:void(0);" img-url="' . WALL_IMG_PATH . $imgvalue->photo . '" class="img-model timeline-thumb-img" img-id=' . $imgvalue->id . ' ><img  class="  ' . $class . '" src="' . WALL_IMG_PATH . $imgvalue->photo . '"/></a>';
                }
                $display .= '<div class="clearboth"></div></div>';
            }
            $total_comment = $this->wall_model->count_comment($value->id);

            $display.='<div class="post-comment-wrapper">
                <div>
                <div class="post-comment-comment"><a href="javascript:void(0);" class="openpost_commentform" postid="' . $value->id . '">Comment ' . ($total_comment > 0 ? $total_comment : '') . '</a><a href="javascript:void(0);" postid="' . $value->id . '">Share</a></div>   
                <div class="post-comment-like_dislike">';
            $vote_up = $this->wall_model->get_post_vote($value->id);
            if ($vote_up) {
                
            } else {
                //$display.='<span class="vote_nodata">0</span><a href="javascript:void(0);" postid="'.$value->id.'" class="post-vote"><i class="bizhuru- bizhuru-orange-rate-up"><i></a>';
            }
            $display.='</div>
                  <div class="clearboth"></div>
                  </div>';
            $display.='<div class="commentbox"><div class="comment-row">
                 <div class="comment-profilepicdiv"><img src="' . PROFILE_IMG_PATH . $current_user->profile_photo . '" class=" currentuser-profile_photo  timeline-user-img-comment"/></div>
                 <div class="comment-textareadiv"><textarea placeholder="Write a comment.." postid="' . $value->id . '" pcomment="" commid="" class="inputautogrouw commentinput"></textarea>
                     <div id="commentloader' . $value->id . 'X"></div>
                     </div>
                  <div class="clearboth"></div>
                  
                  </div><div id="maincommentlist' . $value->id . '">';

            $commentlist = $this->wall_model->get_commentbypost($value->id);
            $continue_from = 0;

            foreach ($commentlist as $comkey => $com_value) {
                $commentuser = current_user($com_value->user_id);
                $display.='<div class="comment-row " id="commentrow' . $value->id . 'X' . $com_value->id . '">
                 <div class="comment-profilepicdiv"> <a href="' . site_url('timeline/' . $commentuser->username) . '"><img src="' . PROFILE_IMG_PATH . $commentuser->profile_photo . '" class=" ' . ($current_user->id == $com_value->user_id ? ' currentuser-profile_photo' : '') . '  timeline-user-img-comment"/></a></div>
                 <div class="comment-textareadiv">
                    <div class="comment-content"><a href="' . site_url('timeline/' . $commentuser->username) . '" class="text-bizhuruY">' . $commentuser->firstname . ' ' . $commentuser->lastname . '</a> ' . $com_value->comment . '
                        <div class="commentposted">' . timeline_postedtime(strtotime($com_value->postedtime)) . '</div>
                    <div class="comment-footer">
                      <div class="comment-footer-reply"><a>Reply</a></div>
                      <div class="comment-footer-vote"><span id="loadervote' . $com_value->id . '"></span>';
                $vote_up = $this->wall_model->get_comment_vote($com_value->id);
                $vote_down = $this->wall_model->get_comment_vote($com_value->id, 0);
                if ($vote_up > 0) {
                    $user_vote = $this->wall_model->is_user_vote_comment($com_value->id, $current_user->id);
                    if ($user_vote) {
                        $display .='<a href="javascript:void(0);" title="I like this" id="commentvoteup' . $com_value->id . '" action="voteup" commid="' . $com_value->id . '" class="upvote commentvote"><i class="bizhuru- bizhuru-orange-rate-up"></i><span>' . $vote_up . '</span></a>';
                    } else {
                        $display .='<a href="javascript:void(0);" title="I like this" id="commentvoteup' . $com_value->id . '" action="voteup" commid="' . $com_value->id . '" class="upvote commentvote"><i class="bizhuru- bizhuru-orange-white-rate-up"></i><span>' . $vote_up . '</span></a>';
                    }
                } else {
                    $display .='<a href="javascript:void(0);" title="I like this" id="commentvoteup' . $com_value->id . '" action="voteup" commid="' . $com_value->id . '" class="upvote commentvote"><i class="bizhuru- bizhuru-gray-rate-up"></i><span>0</span></a>';
                }

                if ($vote_down > 0) {
                    $user_vote = $this->wall_model->is_user_vote_comment($com_value->id, $current_user->id, 0);
                    if ($user_vote) {
                        $display .='<a href="javascript:void(0);" title="I dislike this" id="commentvotedown' . $com_value->id . '" action="votedown" commid="' . $com_value->id . '" class="downvote commentvote"><i class="bizhuru- bizhuru-red-rate-down"></i><span>' . $vote_down . '</span></a>';
                    } else {
                        $display .='<a href="javascript:void(0);" title="I dislike this" id="commentvotedown' . $com_value->id . '" action="votedown" commid="' . $com_value->id . '" class="downvote commentvote"><i class="bizhuru- bizhuru-red-white-rate-down"></i><span>' . $vote_down . '</span></a>';
                    }
                } else {
                    $display .='<a href="javascript:void(0);" title="I dislike this" id="commentvotedown' . $com_value->id . '" action="votedown" commid="' . $com_value->id . '" class="downvote commentvote"><i class="bizhuru- bizhuru-gray-rate-down"></i><span>0</span></a>';
                }
                // <a class="bizhuru- bizhuru-red-white-rate-down"><span>0</span></a>

                $display .='</div>
                      <div class="clearboth"></div>
                       </div>    
                    </div>
                    <div class="comment-contentaction" style="display: none;">';
                if ($userinfo->id == $current_user->id) {
                    if ($com_value->user_id == $current_user->id) {
                        $display.='<a href="javascript:void(0);" title="Edit or Delete" action="edit" postid="' . $value->id . '" commid="' . $com_value->id . '"><i class="text-brown glyphicon glyphicon-pencil"></i></a>';
                    } else {
                        $display.='<a href="javascript:void(0);" title="Delete" action="remove" postid="' . $value->id . '" commid="' . $com_value->id . '"><i class="text-brown glyphicon glyphicon-remove"></i></a>';
                    }
                }
                $display .='</div>
                    <div class="clearboth"></div>
                     </div>
                  <div class="clearboth"></div>
                  
                  </div>';
                $continue_from = $com_value->id;
            }

            $morecomment = $this->wall_model->count_comment($value->id, $continue_from);
            if ($morecomment > 0) {
                $display.='<div class="morecomment" id="morecomment' . $value->id . '"><a href="javascript:void(0);"  class="morecommentlink" postid="' . $value->id . '" lastid="' . $continue_from . '"> View ' . ($morecomment > 50 ? '' : $morecomment ) . ' more comments</a> <span id="commentmoreloder' . $value->id . '"></span></div>';
            }

            $display.='</div></div>';
            $display.='</div>';

            $display .= '</div>';
        }

        return $display;
    }

    function get_comment($commentid) {
        $current_user = current_user();

        $display = '';

        $com_value = $this->wall_model->get_comment($commentid);
        $postinfo = $this->wall_model->get_post($com_value->post_id);
        $post_id = $com_value->post_id;
        $commentuser = current_user($com_value->user_id);
        $display.='<div class="comment-row " id="commentrow' . $post_id . 'X' . $com_value->id . '">
                 <div class="comment-profilepicdiv"><a href="' . site_url('timeline/' . $commentuser->username) . '"><img src="' . PROFILE_IMG_PATH . $commentuser->profile_photo . '" class=" ' . ($current_user->id == $com_value->user_id ? ' currentuser-profile_photo' : '') . '  timeline-user-img-comment"/></a></div>
                 <div class="comment-textareadiv">
                    <div class="comment-content"><a href="' . site_url('timeline/' . $commentuser->username) . '" class="text-bizhuruY">' . $commentuser->firstname . ' ' . $commentuser->lastname . '</a> ' . $com_value->comment . '
                        
                        <div class="commentposted">' . timeline_postedtime(strtotime($com_value->postedtime)) . '</div>
                    <div class="comment-footer">
                      <div class="comment-footer-reply"><a>Reply</a></div>
                      <div class="comment-footer-vote"><span id="loadervote' . $com_value->id . '"></span>';
                $vote_up = $this->wall_model->get_comment_vote($com_value->id);
                $vote_down = $this->wall_model->get_comment_vote($com_value->id, 0);
                if ($vote_up > 0) {
                    $user_vote = $this->wall_model->is_user_vote_comment($com_value->id, $current_user->id);
                    if ($user_vote) {
                        $display .='<a href="javascript:void(0);" title="I like this" id="commentvoteup' . $com_value->id . '" action="voteup" commid="' . $com_value->id . '" class="upvote commentvote"><i class="bizhuru- bizhuru-orange-rate-up"></i><span>' . $vote_up . '</span></a>';
                    } else {
                        $display .='<a href="javascript:void(0);" title="I like this" id="commentvoteup' . $com_value->id . '" action="voteup" commid="' . $com_value->id . '" class="upvote commentvote"><i class="bizhuru- bizhuru-orange-white-rate-up"></i><span>' . $vote_up . '</span></a>';
                    }
                } else {
                    $display .='<a href="javascript:void(0);" title="I like this" id="commentvoteup' . $com_value->id . '" action="voteup" commid="' . $com_value->id . '" class="upvote commentvote"><i class="bizhuru- bizhuru-gray-rate-up"></i><span>0</span></a>';
                }

                if ($vote_down > 0) {
                    $user_vote = $this->wall_model->is_user_vote_comment($com_value->id, $current_user->id, 0);
                    if ($user_vote) {
                        $display .='<a href="javascript:void(0);" title="I dislike this" id="commentvotedown' . $com_value->id . '" action="votedown" commid="' . $com_value->id . '" class="downvote commentvote"><i class="bizhuru- bizhuru-red-rate-down"></i><span>' . $vote_down . '</span></a>';
                    } else {
                        $display .='<a href="javascript:void(0);" title="I dislike this" id="commentvotedown' . $com_value->id . '" action="votedown" commid="' . $com_value->id . '" class="downvote commentvote"><i class="bizhuru- bizhuru-red-white-rate-down"></i><span>' . $vote_down . '</span></a>';
                    }
                } else {
                    $display .='<a href="javascript:void(0);" title="I dislike this" id="commentvotedown' . $com_value->id . '" action="votedown" commid="' . $com_value->id . '" class="downvote commentvote"><i class="bizhuru- bizhuru-gray-rate-down"></i><span>0</span></a>';
                }
                // <a class="bizhuru- bizhuru-red-white-rate-down"><span>0</span></a>

                $display .='</div>
                      <div class="clearboth"></div>
                       </div>  
                        </div>
                    <div class="comment-contentaction" style="display: none;">';
        if ($postinfo->postedby == $current_user->id) {
            if ($com_value->user_id == $current_user->id) {
                $display.='<a href="javascript:void(0);" title="Edit or Delete" action="edit" postid="' . $post_id . '" commid="' . $com_value->id . '"><i class="text-brown glyphicon glyphicon-pencil"></i></a>';
            } else {
                $display.='<a href="javascript:void(0);" title="Delete" action="remove" postid="' . $post_id . '" commid="' . $com_value->id . '"><i class="text-brown glyphicon glyphicon-remove"></i></a>';
            }
        }
        $display .='</div>
                    <div class="clearboth"></div>
                     </div>
                  <div class="clearboth"></div>
                  
                  </div>';



        return $display;
    }

    function get_comments($post_id, $continuefrom) {

        $current_user = current_user();
        $commentlist = $this->wall_model->get_commentbypost($post_id, $continuefrom);
        $continue_from = $continuefrom;
        $display = '';
        $postinfo = $this->wall_model->get_post($post_id);


        foreach ($commentlist as $comkey => $com_value) {
            $commentuser = current_user($com_value->user_id);
            $display.='<div class="comment-row " id="commentrow' . $post_id . 'X' . $com_value->id . '">
                 <div class="comment-profilepicdiv"><a href="' . site_url('timeline/' . $commentuser->username) . '"><img src="' . PROFILE_IMG_PATH . $commentuser->profile_photo . '" class=" ' . ($current_user->id == $com_value->user_id ? ' currentuser-profile_photo' : '') . '  timeline-user-img-comment"/></a></div>
                 <div class="comment-textareadiv">
                    <div class="comment-content"><a href="' . site_url('timeline/' . $commentuser->username) . '" class="text-bizhuruY">' . $commentuser->firstname . ' ' . $commentuser->lastname . '</a> ' . $com_value->comment . '
                        <div class="commentposted">' . timeline_postedtime(strtotime($com_value->postedtime)) . '</div>
                    <div class="comment-footer">
                      <div class="comment-footer-reply"><a>Reply</a></div>
                      <div class="comment-footer-vote"><span id="loadervote' . $com_value->id . '"></span>';
                $vote_up = $this->wall_model->get_comment_vote($com_value->id);
                $vote_down = $this->wall_model->get_comment_vote($com_value->id, 0);
                if ($vote_up > 0) {
                    $user_vote = $this->wall_model->is_user_vote_comment($com_value->id, $current_user->id);
                    if ($user_vote) {
                        $display .='<a href="javascript:void(0);" title="I like this" id="commentvoteup' . $com_value->id . '" action="voteup" commid="' . $com_value->id . '" class="upvote commentvote"><i class="bizhuru- bizhuru-orange-rate-up"></i><span>' . $vote_up . '</span></a>';
                    } else {
                        $display .='<a href="javascript:void(0);" title="I like this" id="commentvoteup' . $com_value->id . '" action="voteup" commid="' . $com_value->id . '" class="upvote commentvote"><i class="bizhuru- bizhuru-orange-white-rate-up"></i><span>' . $vote_up . '</span></a>';
                    }
                } else {
                    $display .='<a href="javascript:void(0);" title="I like this" id="commentvoteup' . $com_value->id . '" action="voteup" commid="' . $com_value->id . '" class="upvote commentvote"><i class="bizhuru- bizhuru-gray-rate-up"></i><span>0</span></a>';
                }

                if ($vote_down > 0) {
                    $user_vote = $this->wall_model->is_user_vote_comment($com_value->id, $current_user->id, 0);
                    if ($user_vote) {
                        $display .='<a href="javascript:void(0);" title="I dislike this" id="commentvotedown' . $com_value->id . '" action="votedown" commid="' . $com_value->id . '" class="downvote commentvote"><i class="bizhuru- bizhuru-red-rate-down"></i><span>' . $vote_down . '</span></a>';
                    } else {
                        $display .='<a href="javascript:void(0);" title="I dislike this" id="commentvotedown' . $com_value->id . '" action="votedown" commid="' . $com_value->id . '" class="downvote commentvote"><i class="bizhuru- bizhuru-red-white-rate-down"></i><span>' . $vote_down . '</span></a>';
                    }
                } else {
                    $display .='<a href="javascript:void(0);" title="I dislike this" id="commentvotedown' . $com_value->id . '" action="votedown" commid="' . $com_value->id . '" class="downvote commentvote"><i class="bizhuru- bizhuru-gray-rate-down"></i><span>0</span></a>';
                }
                // <a class="bizhuru- bizhuru-red-white-rate-down"><span>0</span></a>

                $display .='</div>
                      <div class="clearboth"></div>
                       </div>  
                       </div>
                    <div class="comment-contentaction" style="display: none;">';
            if ($postinfo->postedby == $current_user->id) {
                if ($com_value->user_id == $current_user->id) {
                    $display.='<a href="javascript:void(0);" title="Edit or Delete" action="edit" postid="' . $post_id . '" commid="' . $com_value->id . '"><i class="text-brown glyphicon glyphicon-pencil"></i></a>';
                } else {
                    $display.='<a href="javascript:void(0);" title="Delete" action="remove" postid="' . $post_id . '" commid="' . $com_value->id . '"><i class="text-brown glyphicon glyphicon-remove"></i></a>';
                }
            }
            $display .='</div>
                    <div class="clearboth"></div>
                     </div>
                  <div class="clearboth"></div>
                  
                  </div>';
            $continue_from = $com_value->id;
        }

        $morecomment = $this->wall_model->count_comment($post_id, $continue_from);
        if ($morecomment > 0) {
            // $display.='<div class="morecomment" id="morecomment'.$post_id.'"><a href="javascript:void(0);" postid="'.$post_id.'" lastid="'.$continue_from.'"> View '.($morecomment > 50 ? '': $morecomment ).' more comments</a><span id="commentmoreloder'.$post_id.'"></span> </div>';
            $display.='<div class="morecomment" id="morecomment' . $post_id . '"><a href="javascript:void(0);"  class="morecommentlink" postid="' . $post_id . '" lastid="' . $continue_from . '"> View ' . ($morecomment > 50 ? '' : $morecomment ) . ' more comments</a> <span id="commentmoreloder' . $post_id . '"></span></div>';
        }

        return $display;
    }

    function get_imgpopup($img_popup) {

        $dispaly = '<div>TESTING DATA</div>';
        return $dispaly;
    }

    function comment_update($commid, $postid, $comment, $pcomment, $current_user) {
        $array = array(
            'user_id' => $current_user->id,
            'post_id' => $postid,
            'comment' => $comment,
            'pcomment' => $pcomment,
        );
        return $this->wall_model->comment_update($array, $commid);
    }

    function vote_comment($commid, $action, $current_user) {
        //is user already vote
        $vote = array(
            'user_id' => $current_user->id,
            'comment_id' => $commid,
            'vote_up' => ($action == 'voteup' ? 1 : 0),
            'vote_down' => ($action == 'votedown' ? 1 : 0),
        );
        $check = $this->wall_model->get_user_comment_vote($commid, $current_user->id);
        if ($check) {
            return $this->wall_model->update_commentvote($vote, $check->id);
        } else {
            // vote comment first time
            return $this->wall_model->update_commentvote($vote);
        }
    }

}
