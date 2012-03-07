<?php

/**
 * This is the model class for table "claimant_campaign".
 *
 * The followings are the available columns in table 'claimant_campaign':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $start_date
 * @property string $finish_date
 *
 * The followings are the available model relations:
 * @property ClaimantCsvData[] $claimantCsvDatas
 * @property ClaimantList[] $claimantLists
 */
class ClaimantCampaign extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ClaimantCampaign the static model class
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
		return 'claimant_campaign';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description, start_date', 'required'),
			array('title', 'length', 'max'=>255),
			array('finish_date', 'default', 'value'=>'0000-00-00', 'setOnEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, start_date, finish_date', 'safe', 'on'=>'search'),
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
			'claimantCsvDatas' => array(self::HAS_MANY, 'ClaimantCsvData', 'campaign_id'),
			'claimantLists' => array(self::HAS_MANY, 'ClaimantList', 'campaign_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
			'start_date' => 'Start Date',
			'finish_date' => 'Finish Date',
			'claimantStatus.title' => 'Status',
		);
	}
	
	
	public function statistics()
	{
	
		return array(
			array( 'name' => 'accepted', 'y' => 18, 'number' => '10' ),
			array( 'name' => 'declined', 'y' => 77, 'number' => '10' ),
			array( 'name' => 'pending', 'y' => 5, 'number' => '10' ),
			array( 'name' => 'duplicates', 'y' => 0, 'number' => '10' ),
		);
	
	}
	
	
	public function csvDetails()
	{
		return new CArrayDataProvider( 
			$this->claimantCsvDatas(), 
			array( 
				'sort' => array(
					'defaultOrder' => 'timestamp DESC'
				),
				'pagination' => array( 
					'pageSize' => 8
				),
			)
		);
	}
	
	
	public function claimantDetails()
	{
		return new CArrayDataProvider(
			$this->claimantLists(),
			array(
				'pagination' => array(
					'pageSize' => 25,
				),
			)
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('finish_date',$this->finish_date,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}