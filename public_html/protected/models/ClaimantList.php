<?php

/**
 * This is the model class for table "claimant_list".
 *
 * The followings are the available columns in table 'claimant_list':
 * @property integer $id
 * @property string $co_id
 * @property string $title
 * @property string $forename
 * @property string $surname
 * @property string $add1
 * @property string $add2
 * @property string $add3
 * @property string $town
 * @property string $county
 * @property string $postcode
 * @property string $telephone
 * @property string $mobile
 * @property string $email
 * @property double $long
 * @property double $lat
 * @property integer $status
 * @property integer $campaign_id
 * @property integer $csv
 *
 * The followings are the available model relations:
 * @property ClaimantCsvData $csv0
 * @property ClaimantCampaign $campaign
 * @property ClaimantNotes[] $claimantNotes
 * @property SolicitorClaim[] $solicitorClaims
 */
class ClaimantList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ClaimantList the static model class
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
		return 'claimant_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('co_id, title, forename, surname, add1, add2, add3, town, county, postcode, telephone, mobile, email, long, lat, status, campaign_id, csv', 'required'),
			array('status, campaign_id, csv', 'numerical', 'integerOnly'=>true),
			array('long, lat', 'numerical'),
			array('co_id, title, forename, surname, add1, add2, add3, town, county, postcode, telephone, mobile, email', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, co_id, title, forename, surname, add1, add2, add3, town, county, postcode, telephone, mobile, email, long, lat, status, campaign_id, csv', 'safe', 'on'=>'search'),
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
			'csv0' => array(self::BELONGS_TO, 'ClaimantCsvData', 'csv'),
			'campaign' => array(self::BELONGS_TO, 'ClaimantCampaign', 'campaign_id'),
			'claimantNotes' => array(self::HAS_MANY, 'ClaimantNotes', 'claimant_id'),
			'solicitorClaims' => array(self::HAS_MANY, 'SolicitorClaim', 'claimant_id'),
			'claimantStatus' => array(self::BELONGS_TO, 'ClaimantStatus', 'status'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'co_id' => 'Co',
			'title' => 'Title',
			'forename' => 'Forename',
			'surname' => 'Surname',
			'add1' => 'Add1',
			'add2' => 'Add2',
			'add3' => 'Add3',
			'town' => 'Town',
			'county' => 'County',
			'postcode' => 'Postcode',
			'telephone' => 'Telephone',
			'mobile' => 'Mobile',
			'email' => 'Email',
			'long' => 'Long',
			'lat' => 'Lat',
			'claimantStatus.title' => 'Status',
			'campaign_id' => 'Campaign',
			'csv' => 'Csv',
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
		$criteria->compare('co_id',$this->co_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('forename',$this->forename,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('add1',$this->add1,true);
		$criteria->compare('add2',$this->add2,true);
		$criteria->compare('add3',$this->add3,true);
		$criteria->compare('town',$this->town,true);
		$criteria->compare('county',$this->county,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('long',$this->long);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('status',$this->status);
		$criteria->compare('campaign_id',$this->campaign_id);
		$criteria->compare('csv',$this->csv);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}