<?php

/**
 * GxActiveForm class file.
 *
 * @author Rodrigo Coelho <rodrigo@giix.org>
 * @link http://giix.org/
 * @copyright Copyright &copy; 2010-2011 Rodrigo Coelho
 * @license http://giix.org/license/ New BSD License
 */

/**
 * GxActiveForm provides forms with additional features.
 *
 * @author Rodrigo Coelho <rodrigo@giix.org>
 */
class GxActiveForm extends CActiveForm {

	/**
	 * Renders a checkbox list for a model attribute.
	 * This method is a wrapper of {@link GxHtml::activeCheckBoxList}.
	 * #MethodTracker
	 * This method is based on {@link CActiveForm::checkBoxList}, from version 1.1.7 (r3135). Changes:
	 * <ul>
	 * <li>Uses GxHtml.</li>
	 * </ul>
	 * @see CActiveForm::checkBoxList
	 * @param CModel $model The data model.
	 * @param string $attribute The attribute.
	 * @param array $data Value-label pairs used to generate the check box list.
	 * @param array $htmlOptions Addtional HTML options.
	 * @return string The generated check box list.
	 */
	public function checkBoxList($model, $attribute, $data, $htmlOptions = array()) {
		return GxHtml::activeCheckBoxList($model, $attribute, $data, $htmlOptions);
	}

	public function __call($method, $args){
		if(strpos($method, '_in')){
			$method = strtr($method, array('_in'=>''));
			echo '<div class="form-group">'."\n";
			if($method == 'textField') {
				echo $this->label($args[0], $args[1], array('class'=>'sr-only'));
				if(!isset($args[2]))
					$args[2]=array();
				$args[2]['class'] = empty($args[2]['class']) ? 'form-control' : $args[2]['class'].' form-control';
			}
			echo call_user_func_array(array($this, $method), $args);
			echo "\n</div>\n";
		}
		else
			return parent::__call($method, $args);
	}

}