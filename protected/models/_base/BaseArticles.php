<?php

/**
 * This is the model base class for the table "articles".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Articles".
 *
 * Columns in table "articles" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $news_id
 * @property string $title
 * @property string $image_url
 * @property string $body
 * @property string $share_url
 * @property string $image_source
 * @property integer $section_id
 * @property string $section_name
 * @property string $js_url
 * @property string $css_url
 * @property integer $type
 * @property integer $retry_times
 * @property string $signature
 * @property string $status
 * @property integer $created
 * @property integer $deleted
 *
 */
abstract class BaseArticles extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'articles';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Articles|Articles', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('news_id, title, body', 'required'),
			array('news_id, section_id, type, retry_times, created, deleted', 'numerical', 'integerOnly'=>true),
			array('signature', 'length', 'max'=>32),
			array('status', 'length', 'max'=>10),
			array('image_url, share_url, image_source, section_name, js_url, css_url', 'safe'),
			array('image_url, share_url, image_source, section_id, section_name, js_url, css_url, type, retry_times, signature, status, created, deleted', 'default', 'setOnEmpty' => true, 'value' => null),
			array('news_id, title, image_url, body, share_url, image_source, section_id, section_name, js_url, css_url, type, retry_times, signature, status, created, deleted', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'news_id' => Yii::t('app', 'News'),
			'title' => Yii::t('app', 'Title'),
			'image_url' => Yii::t('app', 'Image Url'),
			'body' => Yii::t('app', 'Body'),
			'share_url' => Yii::t('app', 'Share Url'),
			'image_source' => Yii::t('app', 'Image Source'),
			'section_id' => Yii::t('app', 'Section'),
			'section_name' => Yii::t('app', 'Section Name'),
			'js_url' => Yii::t('app', 'Js Url'),
			'css_url' => Yii::t('app', 'Css Url'),
			'type' => Yii::t('app', 'Type'),
			'retry_times' => Yii::t('app', 'Retry Times'),
			'signature' => Yii::t('app', 'Signature'),
			'status' => Yii::t('app', 'Status'),
			'created' => Yii::t('app', 'Created'),
			'deleted' => Yii::t('app', 'Deleted'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('news_id', $this->news_id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('image_url', $this->image_url, true);
		$criteria->compare('body', $this->body, true);
		$criteria->compare('share_url', $this->share_url, true);
		$criteria->compare('image_source', $this->image_source, true);
		$criteria->compare('section_id', $this->section_id);
		$criteria->compare('section_name', $this->section_name, true);
		$criteria->compare('js_url', $this->js_url, true);
		$criteria->compare('css_url', $this->css_url, true);
		$criteria->compare('type', $this->type);
		$criteria->compare('retry_times', $this->retry_times);
		$criteria->compare('signature', $this->signature, true);
		$criteria->compare('status', $this->status, true);
		$criteria->compare('created', $this->created);
		$criteria->compare('deleted', $this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}