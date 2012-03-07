<?php

/**
 * This is the model class for table "solicitor_note".
 *
 * The followings are the available columns in table 'solicitor_note':
 * @property integer $id
 * @property integer $firm_id
 * @property integer $user_id
 * @property string $note
 * @property string $added
 *
 * The followings are the available model relations:
 * @property SolicitorFirm $firm
 */
class SolicitorNote extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SolicitorNote the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'solicitor_note';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firm_id, user_id, note, added', 'required'),
			array('firm_id, user_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, firm_id, user_id, note, added', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'firm' => array(self::BELONGS_TO, 'SolicitorFirm', 'firm_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'firm_id' => 'Firm',
			'user_id' => 'User',
			'note' => 'Note',
			'added' => 'Added',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('firm_id',$this->firm_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('added',$this->added,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}