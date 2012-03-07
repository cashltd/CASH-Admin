<?php

/**
 * This is the model class for table "solicitor_firm".
 *
 * The followings are the available columns in table 'solicitor_firm':
 * @property integer $id
 * @property string $added
 * @property string $title
 * @property string $address1
 * @property string $address2
 * @property string $area
 * @property string $postcode
 * @property string $telephone
 * @property string $fax
 * @property string $email
 * @property integer $pipartners
 * @property integer $yearstrading
 * @property integer $offices
 * @property integer $status
 * @property string $sectors
 *
 * The followings are the available model relations:
 * @property SolicitorContact[] $solicitorContacts
 * @property SolicitorStatus $status0
 */
class SolicitorFirm extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SolicitorFirm the static model class
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
		return 'solicitor_firm';
	}



	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, address1, address2, area, postcode, telephone, fax, email, pipartners, yearstrading, offices, status, sectors', 'required'),
			array('pipartners, yearstrading, offices, status', 'numerical', 'integerOnly'=>true),
			array('title, address1, address2, area, email, web_address, sectors', 'length', 'max'=>255),
			array('postcode', 'length', 'max'=>10),
			array('telephone, fax', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, added, title, address1, address2, area, postcode, telephone, fax, email, pipartners, yearstrading, offices, solicitorStatus.status, sectors', 'safe', 'on'=>'search'),
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
			'solicitorContacts' => array(self::HAS_MANY, 'SolicitorContact', 'firm_id'),
			'solicitorNotes' => array(self::HAS_MANY, 'SolicitorNote', 'firm_id'),
			'solicitorStatus' => array(self::BELONGS_TO, 'SolicitorStatus', 'status'),
			'solicitorContracts' => array(self::HAS_MANY, 'SolicitorContractDetails', 'firm_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'added' => 'Added',
			'title' => 'Title',
			'address1' => 'Address 1',
			'address2' => 'Address 2',
			'area' => 'Area',
			'postcode' => 'Postcode',
			'telephone' => 'Telephone',
			'fax' => 'Fax',
			'email' => 'Email',
			'web_address' => 'Web Address',
			'pipartners' => 'Pi Partners',
			'yearstrading' => 'Years Trading',
			'offices' => 'Offices',
			'solicitorStatus.title' => 'Status',
			'sectors' => 'Sectors',
		);
	}




	public function leadStatistics()
	{
		return array(
			array( 'name' => 'accepted', 'y' => 18, 'number' => '10' ),
			array( 'name' => 'declined', 'y' => 77, 'number' => '10' ),
			array( 'name' => 'pending', 'y' => 5, 'number' => '10' ),
		);
	}



	public function solicitorContractsModel()
	{
		return new CArrayDataProvider( $this->solicitorContracts(), array(
		
		));
	}



	public function totalIncome()
	{
	
	
		return '1000';
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
		$criteria->compare('added',$this->added,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('web_address',$this->web_address,true);
		$criteria->compare('pipartners',$this->pipartners);
		$criteria->compare('yearstrading',$this->yearstrading);
		$criteria->compare('offices',$this->offices);
		$criteria->compare('solicitorStatus.title',$this->solicitorStatus->status);
		$criteria->compare('sectors',$this->sectors,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}