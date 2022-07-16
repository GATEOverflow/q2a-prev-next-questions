<?php

class qa_html_theme_layer extends qa_html_theme_base {

	function head_custom()
        {
                qa_html_theme_base::head_custom();
		if ($this -> template == 'question') {
			$this->output('<style type="text/css">'.qa_opt('q2a_prev_next_css').'</style>');
		}
        }
}

