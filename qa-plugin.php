<?php


if (!defined('QA_VERSION')){header('Location: ../../'); exit;}
qa_register_plugin_layer('qa-prev-next-layer.php', 'Previous Next Questions Layer');
qa_register_plugin_module('module', 'qa-prev-next-admin.php', 'qa_prev_next_admin', 'Previous Next Questions Settings');
qa_register_plugin_module('widget', 'qa-prev-next-widget.php', 'qa_prev_next_widget', 'Previous Next Questions Widget');
