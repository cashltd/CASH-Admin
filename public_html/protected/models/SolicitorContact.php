<?php

/**
 * This is the model class for table "solicitor_contact".
 *
 * The followings are the available columns in table 'solicitor_contact':
 * @property integer $id
 * @property integer $firm_id
 * @property string $Title
 * @property string $first_name
 * @property string $surname
 * @property string $address1
 * @property string $address2
 * @property string $area
 * @property string $postcode
 * @property string $telephone
 * @property string $fax
 * @property string $email
 *
 * The followings are the available model relations:
 * @property SolicitorFirm $firm
 */
class SolicitorContact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SolicitorContact the static model class
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
		return 'solicitor_contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firm_id, Title, first_name, surname, address1, address2, area, postcode, telephone, fax, email', 'required'),
			array('firm_id', 'numerical', 'integerOnly'=>true),
			array('Title, postcode', 'length', 'max'=>10),
			array('first_name, surname, address1, address2, area, email', 'length', 'max'=>255),
			array('telephone, fax', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, firm_id, Title, first_name, surname, address1, address2, area, postcode, telephone, fax, email', 'safe', 'on'=>'search'),
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
			'Title' => 'Title',
			'first_name' => 'First Name',
			'surname' => 'Surname',
			'address1' => 'Address1',
			'address2' => 'Address2',
			'area' => 'Area',
			'postcode' => 'Postcode',
			'telephone' => 'Telephone',
			'fax' => 'Fax',
			'email' => 'Email',
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
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}