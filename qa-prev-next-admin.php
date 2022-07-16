<?php

class qa_prev_next_admin {

	function allow_template($template)
	{
		return ($template!='admin');
	}

	function option_default($option) {

		switch($option) {

		case 'q2a_prev_next_enable_category':
			return 1;

			case 'q2a_prev_next_previous_label':
				return '&larr; Previous';

			case 'q2a_prev_next_next_label':
				return 'Next &rarr;';
			
			case 'q2a_prev_next_previous_qinc_label':
				return '&larr; Previous in category';

			case 'q2a_prev_next_next_qinc_label':
				return 'Next in category &rarr;';

			case 'q2a_prev_next_css':
				return '
.qa-prev-next, .qa-prev-next-qinc {
    margin: 15px 0;
    display: flow-root;
    clear: both;
}

.qa-prev-next .button, .qa-prev-next-qinc .button {
    display: inline-block;
    background-color: transparent;
    padding: 0.6rem 1rem;
    border: 1px solid;
    font-family: inherit;
    font-size: .8125rem;
    border-radius: 6px;
    margin-bottom: 0.5rem;
}
.qa-prev-q {
float:left;
}
.qa-next-q {
float:right;
}
';

			default:
				return null;

		}	

	}
	
	function admin_form(&$qa_content)
	{

		$ok = null;
		if (qa_clicked('q2a_prev_next_save_button')) {
			
			qa_opt('q2a_prev_next_css', qa_post_text('q2a_prev_next_css'));
			qa_opt('q2a_prev_next_enable_category',(bool) qa_post_text('q2a_prev_next_enable_category'));
			qa_opt('q2a_prev_next_previous_label', qa_post_text('q2a_prev_next_previous_label'));
			qa_opt('q2a_prev_next_next_label', qa_post_text('q2a_prev_next_next_label'));
			qa_opt('q2a_prev_next_previous_qinc_label', qa_post_text('q2a_prev_next_previous_qinc_label'));
			qa_opt('q2a_prev_next_next_qinc_label', qa_post_text('q2a_prev_next_next_qinc_label'));
			
			
			$ok = qa_lang('admin/options_saved');
		}
		else if (qa_clicked('q2a_prev_next_reset_button')) {
			foreach($_POST as $i => $v) {
				$def = $this->option_default($i);
				if($def !== null) qa_opt($i,$def);
			}
			$ok = qa_lang('admin/options_reset');
		}			
		

		$fields = array();


		$fields[] = array(
			'label' => 'CSS Styles',
			'type' => 'text',
			'value' => qa_opt('q2a_prev_next_css'),
			'tags' => 'NAME="q2a_prev_next_css"',
		);

		$fields[] = array(
			'label' => 'Previous question label',
			'type' => 'text',
			'value' => qa_opt('q2a_prev_next_previous_label'),
			'tags' => 'NAME="q2a_prev_next_previous_label"',
		);

		$fields[] = array(
			'label' => 'Next question label',
			'type' => 'text',
			'value' => qa_opt('q2a_prev_next_next_label'),
			'tags' => 'NAME="q2a_prev_next_next_label"',
		);
		$fields[] = array(
			'label' => 'Previous question in category label',
			'type' => 'text',
			'value' => qa_opt('q2a_prev_next_previous_qinc_label'),
			'tags' => 'NAME="q2a_prev_next_previous_qinc_label"',
		);

		$fields[] = array(
			'label' => 'Next question in category label',
			'type' => 'text',
			'value' => qa_opt('q2a_prev_next_next_qinc_label'),
			'tags' => 'NAME="q2a_prev_next_next_qinc_label"',
		);
		
		$fields[] = array(
			'label' => 'Enable for categories',
			'type' => 'checkbox',
			'value' => qa_opt('q2a_prev_next_enable_category'),
			'tags' => 'NAME="q2a_prev_next_enable_category"',
		);

		return array(
			'ok' => ($ok && !isset($error)) ? $ok : null,
			
			'fields' => $fields,
			
			'buttons' => array(
				array(
				'label' => qa_lang_html('main/save_button'),
				'tags' => 'NAME="q2a_prev_next_save_button"',
				),
				array(
				'label' => qa_lang_html('admin/reset_options_button'),
				'tags' => 'NAME="q2a_prev_next_reset_button"',
				),
			),
		);
	}

}
