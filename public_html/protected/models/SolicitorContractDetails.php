<?php

/**
 * This is the model class for table "solicitor_contract_details".
 *
 * The followings are the available columns in table 'solicitor_contract_details':
 * @property integer $id
 * @property integer $firm_id
 * @property string $start_date
 * @property string $finish_date
 * @property integer $monthly_leads
 * @property integer $contract_length
 * @property double $price_per_lead
 * @property double $vat_rate
 * @property double $joining_fee
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property SolicitorContractStatus $status0
 * @property SolicitorFirm $firm
 * @property SolicitorContractPayments[] $solicitorContractPayments
 */
class SolicitorContractDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SolicitorContractDetails the static model class
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
		return 'solicitor_contract_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firm_id, start_date, finish_date, monthly_leads, contract_length, price_per_lead, vat_rate, joining_fee, status', 'required'),
			array('firm_id, monthly_leads, contract_length, status', 'numerical', 'integerOnly'=>true),
			array('price_per_lead, vat_rate, joining_fee', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, firm_id, start_date, finish_date, monthly_leads, contract_length, price_per_lead, vat_rate, joining_fee, status', 'safe', 'on'=>'search'),
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
			'contractStatus' => array(self::BELONGS_TO, 'SolicitorContractStatus', 'status'),
			'firm' => array(self::BELONGS_TO, 'SolicitorFirm', 'firm_id'),
			'solicitorContractPayments' => array(self::HAS_MANY, 'SolicitorContractPayments', 'contract_id'),
			'solicitorAssignedClaimants' => array(self::HAS_MANY, 'SolicitorAssignedClaimants', 'contract_id'),

		);
	}

	
	public function claimantListView()
	{
		$claimantsAssigned = array();
		foreach ($this->solicitorAssignedClaimants AS $test)
		{
			$claimantsAssigned[] = $test->claimant;
		}
		
		return new CArrayDataProvider( $claimantsAssigned, array(
		
		));
	}
	
	public function paymentsMade()
	{
		// Returns details of all payments made on this contract
		
		return new CArrayDataProvider( $this->solicitorContractPayments(), array(
		
		));
	
	}
	
	
	public function claimantsAssigned()
	{	
		return new CArrayDataProvider( $this->solicitorAssignedClaimants(), array(
		
		));
	}
	
	
	
	public function leadStatistics()
	{
		$total = 0;
		$accepted = 0;
		$declined = 0;
		$pending = 0;
		foreach ($this->solicitorAssignedClaimants AS $sent)
		{
			if ($sent->status == 0) $pending++;
			else if ($sent->status == 1) $accepted++;
			else if ($sent->status == 2) $declined++;
			$total++;
		}
	
	
		return array(
			array( 'name' => 'Accepted', 'y' => ($total > 0) ? (($accepted / $total)*100) : 0, 'number' => $accepted ),
			array( 'name' => 'Declined', 'y' => ($total > 0) ? (($declined / $total )*100) : 0, 'number' => $declined ),
			array( 'name' => 'Pending', 'y' => ($total > 0) ? (($pending / $total )*100) : 0, 'number' => $pending ),
		);
	}

	
	public function totalToDate()
	{
		$total = 0;
		foreach ($this->solicitorContractPayments AS $payment)
		{
			$total = $total + $payment['amount'];
		}
		return number_format($total, 2, '.', ',');
	}
	
	public function contractTotalCost()
	{
		return number_format((((($this->monthly_leads * $this->contract_length) * $this->price_per_lead) + $this->joining_fee) * (($this->vat_rate/100)+1)), 2, '.', ',');
	}
	
	public function contractTotal()
	{
	
		return 10000;
	
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'firm_id' => 'Firm',
			'start_date' => 'Start Date',
			'finish_date' => 'Finish Date',
			'monthly_leads' => 'Monthly Leads',
			'contract_length' => 'Contract Length',
			'price_per_lead' => 'Price Per Lead',
			'vat_rate' => 'Vat Rate',
			'joining_fee' => 'Joining Fee',
			'status' => 'Status',
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
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('finish_date',$this->finish_date,true);
		$criteria->compare('monthly_leads',$this->monthly_leads);
		$criteria->compare('contract_length',$this->contract_length);
		$criteria->compare('price_per_lead',$this->price_per_lead);
		$criteria->compare('vat_rate',$this->vat_rate);
		$criteria->compare('joining_fee',$this->joining_fee);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}