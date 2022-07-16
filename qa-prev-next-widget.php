<?php

class qa_prev_next_widget
{

	function allow_template($template)
	{
		return ($template == 'question');
	}

	function allow_region($region)
	{
		return true;
	}
	function output($out) {
		echo $out;
	}

	function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
	{
		$parts = explode('/', $request);
		$postid = $parts[0];
		$this->output('<div class="qa-prev-next">');
		$this->get_prev_q($postid);
		$this->get_next_q($postid);
		$this->output('</div>');
		if(qa_opt('q2a_prev_next_enable_category')) 
		{
			$this->output('<div class="qa-prev-next-qinc">');
			$this->get_prev_qinc($postid);
			$this->get_next_qinc($postid);
			$this->output('</div>');
		}

	}


	function get_prev_q($postid){

		$query_p = "SELECT *
			FROM ^posts
			WHERE postid < $postid
			AND type='Q'
			ORDER BY postid DESC
			LIMIT 1";

		$prev_q = qa_db_query_sub($query_p);

		while($prev_link = qa_db_read_one_assoc($prev_q, true)){

			$title = $prev_link['title'];
			$pid = $prev_link['postid'];

			$this->output('<a href=\''. qa_q_path_html($pid, $title) .'\' type="button" title="'. $title .'" class="button qa-prev-q">'.qa_opt('q2a_prev_next_previous_label').'</a>');

		}

	}

	function get_next_q($postid){

		$query_n = "SELECT *
			FROM ^posts
			WHERE postid > $postid
			AND type='Q'
			ORDER BY postid ASC
			LIMIT 1";

		$next_q = qa_db_query_sub($query_n);

		while($next_link = qa_db_read_one_assoc($next_q, true)){

			$title = $next_link['title'];
			$pid = $next_link['postid'];

			$this->output('<a href=\''. qa_q_path_html($pid, $title) .'\' type="button" title="'. $title .'" class="button qa-next-q">'.qa_opt('q2a_prev_next_next_label').'</a>');

		}

	}

	function get_prev_qinc($postid){

		$query_p = "SELECT *
			FROM ^posts
			WHERE postid < $postid
			AND type='Q' AND categoryid = (SELECT categoryid from ^posts where postid = $postid)
			ORDER BY postid DESC
			LIMIT 1";

		$prev_q = qa_db_query_sub($query_p);

		while($prev_link = qa_db_read_one_assoc($prev_q, true)){

			$title = $prev_link['title'];
			$pid = $prev_link['postid'];

			$this->output('<a href=\''. qa_q_path_html($pid, $title) .'\' type="button" title="'. $title .'" class="button qa-prev-q">'.qa_opt('q2a_prev_next_previous_qinc_label').'</a>');

		}

	}
	function get_next_qinc($postid){

		$query_n = "SELECT *
			FROM ^posts
			WHERE postid > $postid
			AND type='Q'
			AND categoryid = (SELECT categoryid from ^posts where postid = $postid)
			ORDER BY postid ASC
			LIMIT 1";

		$next_q = qa_db_query_sub($query_n);

		while($next_link = qa_db_read_one_assoc($next_q, true)){

			$title = $next_link['title'];
			$pid = $next_link['postid'];

			$this->output('<a href=\''. qa_q_path_html($pid, $title) .'\' type="button" title="'. $title .'" class="button qa-next-q">'.qa_opt('q2a_prev_next_next_qinc_label').'</a>');

		}

	}
}
