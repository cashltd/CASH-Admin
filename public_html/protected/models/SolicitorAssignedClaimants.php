<?php

/**
 * This is the model class for table "solicitor_assigned_claimants".
 *
 * The followings are the available columns in table 'solicitor_assigned_claimants':
 * @property integer $id
 * @property integer $contract_id
 * @property integer $claimant_id
 * @property integer $status
 * @property string $sendDate
 *
 * The followings are the available model relations:
 * @property SolicitorContractDetails $contract
 * @property ClaimantList $claimant
 */
class SolicitorAssignedClaimants extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SolicitorAssignedClaimants the static model class
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
		return 'solicitor_assigned_claimants';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contract_id, claimant_id, status, sendDate', 'required'),
			array('contract_id, claimant_id, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, contract_id, claimant_id, status, sendDate', 'safe', 'on'=>'search'),
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
			'contract' => array(self::BELONGS_TO, 'SolicitorContractDetails', 'contract_id'),
			'claimant' => array(self::BELONGS_TO, 'ClaimantList', 'claimant_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'contract_id' => 'Contract',
			'claimant_id' => 'Claimant',
			'status' => 'Status',
			'sendDate' => 'Send Date',
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
		$criteria->compare('contract_id',$this->contract_id);
		$criteria->compare('claimant_id',$this->claimant_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('sendDate',$this->sendDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}