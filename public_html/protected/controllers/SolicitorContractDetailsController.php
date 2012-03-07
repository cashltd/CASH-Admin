<?php

class SolicitorContractDetailsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view',  'downloadContract'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new SolicitorContractDetails;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SolicitorContractDetails']))
		{
			$model->attributes=$_POST['SolicitorContractDetails'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SolicitorContractDetails']))
		{
			$model->attributes=$_POST['SolicitorContractDetails'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('SolicitorContractDetails');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SolicitorContractDetails('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SolicitorContractDetails']))
			$model->attributes=$_GET['SolicitorContractDetails'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}




	public function actionDownloadContract($id)
	{
		$model=SolicitorContractDetails::model()->findByPk($id);
		
		$solicitorModel=SolicitorFirm::model()->findByPk($model->firm_id);
		
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		
		
		$totalLeads = $model->contract_length * $model->monthly_leads;
		$totalCost = $totalLeads * $model->price_per_lead;
		
		$monthlyFee = ($totalCost / $model->contract_length) * (1 + ($model->vat_rate / 100) );
		$joiningFee = $model->joining_fee * (1 + ($model->vat_rate / 100) );
		
		
		$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 'P', 'cm', 'A4', true, 'UTF-8');
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("C.A.S.H. Limited");
		$pdf->SetTitle("Solicitor Contract");
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->AliasNbPages();
		$pdf->AddPage();

		$pdf->SetFont("helvetica", "B", 9);
		$pdf->Cell(12,0, "PLEASE READ THIS AGREEMENT CAREFULLY BEFORE SIGNING",0,0,C);
		
		$pdf->Ln(0);
		
		$pdf->SetFont("helvetica", "", 8);	
		
		$address = "The Stables,
Media Mews,
Kitty Lane, Marton,
Fylde, FY4 5EG.
		
T:	01253 600663
F:	01253 696252
E:	mail@cash-ltd.co.uk
W:	www.cash-ltd.co.uk";
		
		
		$pdf->MultiCell(5, 0, $address."\n", 0, 'L', 0, 0, 17 ,'', true);
		
		$pdf->Ln(1);
		$pdf->SetFont("helvetica", "", 12);
		
		$pdf->Cell(5,0, "SOLICITORS AGREEMENT",0,0,L);
		$pdf->SetFont("helvetica", "", 6);
		$pdf->Ln();
		$pdf->Cell(5,0, "between",0,0,L);	
		$pdf->Ln();
		$pdf->SetFont("helvetica", "", 12);
		$pdf->Cell(5,0, "Claims Accident Service Helpline Limited",0,0,L);
		$pdf->SetFont("helvetica", "", 6);
		$pdf->Ln();
		$pdf->Cell(5,0, "is regulated by the Ministry of Justice in respect of regulated claims management activities.",0,0,L);	
		$pdf->Ln();
		$pdf->Cell(5,0, "CRM: 6068. Our regulation is recorded on the Ministry of Justice website. www.claimsregulation.gov.uk",0,0,L);
		$pdf->Ln();
		$pdf->Cell(5,0, "(hereinafter called 'the provider') and",0,0,L);	
		
		
		
		$solicitorDetails = "<b>Name of law firm joining scheme :</b> <i>".$solicitorModel->title."</i><br />
<b>Address :</b> <i>".$solicitorModel->address1.", ".$solicitorModel->address2.", ".$solicitorModel->area.", ".$solicitorModel->postcode."</i><br />
<b>E-Mail :</b> <i>".$solicitorModel->email."</i><br />
<b>Tel No. :</b> <i>".$solicitorModel->telephone."</i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Fax No. :</b> <i>".$solicitorModel->fax."</i>";
		
		$leadDetails = "Total Number of leads @ £".$model->price_per_lead."<br />
over full contractual term : ".$totalLeads."<br />
Total value of contract over full term £".number_format($totalCost, 2, '.', ',')."<br />
<b>All referral rates are plus VAT @ ".$model->vat_rate."%</b>";
		
		$pdf->Ln(1);
		
		$pdf->SetFont("helvetica", "", 8);		
		$pdf->MultiCell(11, 1, $solicitorDetails, 0, 'L', 0, 0, '' ,'', true, 0, true);
		
		
		
		$pdf->SetFont("helvetica", "", 8);		
		$pdf->MultiCell(7, 1, $leadDetails, 0, 'L', 0, 0, 13 ,'', true, 0, true);
		

		$pdf->Ln(2);

		$firstParagraph = "The provider hereby agrees to advertise, promote for leads over the full agreed term for the panel member as set out on this agreement for a minimum period of ".$model->contract_length." months subject to termination clause at the guaranteed fixed monthly marketing rate. The date of the first lead is deemed to be the first day of the period and in any event shall be no later than 21 days from the date of signing. The minimum period of ".$model->contract_length." months may be extended by 180 days by the provider to ensure the level of leads is achieved and provided that all payments have been made by the member, no further payment will be made during that extended time. Leads are deemed to be accepted if the provider has not received written instructions to the contrary from the member within 7 days of receipt. By agreement then 21 days extra will be allowed for engineer’s reports and/or photographic evidence etc. Any leads that fail to progress through inaccurate or false information given by the client are replaced free of charge providing notification is received in writing within 48 hours of discovery by the member. Where a lead is rejected by the member due to there being no reasonable prospects of success (i.e. less than 51%) and the lead has not been willingly accepted by another law firm as having reasonable prospects of success or because of a fault resting with the original member firm, either due to an inadequate response time (not making immediate and friendly contact on receipt of case details) or “cherry picking”, the lead will be replaced free of charge.";
		
		$pdf->SetFont("helvetica", "", 8);		
		$pdf->MultiCell(19, 2, $firstParagraph."\n", 0, 'J', 0, 0, '' ,'', true);
		
		$pdf->Ln(4);
		$pdf->SetFont("helvetica", "B", 9);
		$pdf->Cell(5,1, "MEMBER DETAILS & INFORMATION",0,0,L);
		
		
		$memberDetailsinfo = "Please include my firm on the scheme as agreed overleaf & herein:<br />
Minimum Quantum Level £1,000.00<br />
Bespoke Call Centre IT Software & Membership £".number_format($joiningFee, 2, '.', ',')." including VAT<br />
Note: This is no guarantee of any fixed number of leads in any interim period";
		
		$officeUseOnly = "Acceptance Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; RET: <br />
Date of first lead: <br />
Membership Fee Rec. £".number_format($joiningFee, 2, '.', ',')." including VAT<br />
Authorised by: ";
		

		$pdf->Ln(1);
		
		$pdf->SetFont("helvetica", "", 8);		
		$pdf->MultiCell(11, 1, $memberDetailsinfo, 0, 'L', 0, 0, '' ,'', true, 0, true);

		$pdf->SetFont("helvetica", "", 8);		
		$pdf->MultiCell(7, 1, $officeUseOnly, 0, 'L', 0, 0, 13 ,'', true, 0, true);
		

		$pdf->Ln(1);
		$pdf->SetFont("helvetica", "B", 9);
		
		$pdf->Cell(5,2, "PAYMENT DETAILS",0,0,L);
		$pdf->Ln(1);
		
		$payDetails = "In consideration for the promotion and supply of the agreed leads over the full contract period the panel member will pay the sum of £".number_format($monthlyFee, 2, '.', ',')." <b>including VAT per month</b>.  An initial payment of membership and first months marketing fee plus the VAT is required on acceptance and signing of this agreement. The balance must be paid monthly by bankers order for a minimum of ".($model->contract_length-1)." consecutive months for the full contracted term, guaranteeing rates will not increase within the ".$model->contract_length." month contract period.  A minimum of ".$model->cancellation_period." months cancellation notice is required in writing.  The Contract contains all the terms and conditions. The panel member has no right to reject a referral, unless the mutual client has no valid case and any referrals that fall into this category are replaced during or at the end of the agreement. No verbal conditions will be accepted unless endorsed herein and agreed in writing by the provider.";
		
		
		$pdf->SetFont("helvetica", "", 8);		
		$pdf->MultiCell(19, 1, $payDetails."\n", 0, 'J', 0, 0, '' ,'', true, 0, true);
		

		$pdf->Ln(3);
		$pdf->SetFont("helvetica", "B", 8);
		$pdf->Cell(19,1, "First monthly marketing payment including membership to be initially paid by cheque and monthly thereafter by bank mandate.",0,0,C);
		
		
		$solicitorAgree = "£……………………………(figures)………………………………………………………………………………..(words) Including VAT @ ".$model->vat_rate."%<br /><br />
Signed by……………………………………………………… partner. Please print name…………………………………………………………….<br /><br />             
Signed by………………………………………….on behalf of the provider.";
		
		$pdf->Ln(1);
		$pdf->SetFont("helvetica", "", 8);
		$pdf->MultiCell(19, 1, $solicitorAgree, 0, 'C', 0, 0, 1 ,'', true, 0, true);
		

		$pdf->Ln(2);
		$pdf->SetFont("helvetica", "B", 8);
		$pdf->MultiCell(19, 1, "I the panel member have read and hereby accept all the terms and conditions of this agreement, here and overleaf, a copy of which has been receiver by me/my firm, I am duty authorised to sign on behalf of my firm.", 0, 'C', 0, 0, '' ,'', true, 0, true);
		
		
		
		
		
		
		
		
		
		// Now we create the terms and conditions for page two
		
		$txt = '1. In the event of impracticality by the provider, then an increase in the '.$model->contract_length.' month period may be applied to enable the leads to be achieved over and above the minimum period of '.$model->contract_length.' months as stated overleaf. Any refund of any monies paid may be made to the panel members in leads only as expenditure will be current. Replacement leads will be at the prevailing rate less leads received prior to termination. This is subject to the minimum '.$model->cancellation_period.' month cancellation clause and applies only after an initial period of three months has expired. Any cancellation in the first '.$model->contract_length.' months may result in a delay or shortfall of leads.

2. Any error in the lead information or numerical order must be notified in writing by the member to the provider within one working day of receipt of the lead information on the form provided. Otherwise the lead shall be deemed to be received correctly in all respects. If the member notifies the provider of any errors after the aforementioned one working day, the provider will use its best endeavours to correct the errors, the member shall have no claim for a replacement lead against the provider in respect thereof.

3. The member must clearly state in initial contact (within 24 hours of receipt of deposition) and confirm in correspondence that the lead is from Claims Accident Service Helpline and provide a copy on request of their CFA letter. It is hereby agreed the panel member speaks to each individual claimant and cannot determine success without prior telephone contact.

4. The provider will replace any lead rejected by the member where possible within 180 days where the client has no case to proceed with the case or refuses to co-operate with the firm proceeding with the case. Rejection will not be accepted where the member firm fails to take on a lead that is later found to be of substance and is accepted by another member. Should any shortfall exist in the aggregate number of leads and rejected leads these shall be in any event remedied no later than 180 days after the whole contract has expired.

5. It is agreed and declared that this Agreement contains all the terms and conditions between the parties hereto and the provider has made no warranty (oral or otherwise) except as expressly stated herein.

6. Where the business of the member is taken over by a new proprietor/partner (or where his business ceases or the nature of the business changes or status) the member shall nevertheless remain fully liable under this agreement, unless the new proprietor/partner notifies the provider by recorded delivery of his intention to accept as his responsibility, the terms already agreed with the provider by the member, should, however, the new proprietor default in the performance of this agreement the member will remain liable for any loss sustained by the provider.

7. Any form of instalments by bankers order payment will only be accepted by the provider if it has clearly been endorsed upon the agreement and it should be noted that all payments are payable monthly and consecutively for a minimum period of '.$model->contract_length.' months on the agreed date. If payment of an instalment hereunder is not made on the due date or cancelled without written notice or the member has breached the contract in any way then the whole of the balance outstanding under this Agreement shall immediately become due and payable, plus costs of collection.

8. Any proceedings of whatever nature in connection with or arising out of this Agreement shall be held at the County Court, Blackpool, and Lancashire High Court Registry at the discretion of the provider. The contract shall continue for a minimum of '.$model->contract_length.' months and shall continue until the member terminates the contract giving a minimum of '.$model->cancellation_period.' months fully paid up notice in writing.

9. The provider reserves the right to claim any outstanding invoice, due to the provider, by the Bankers Order Mandate. The provider reserves the right to charge interest at 4% above the current Bank of England base rate on out-standing monies.

10. Should an Act of God, War of the Queen’s Enemies or Act of Parliament or other Government action, postal delay, extreme weather conditions, force majeure, disaster conditions, or any other reasons beyond the control of the provider occur, the provider shall be excused from carrying out the conditions of this Contract until a normal situation has returned.

11. If for any reason the promoter may at his absolute discretion generate purchase or obtain leads from third parties providing always that these meet both the MOJ and SRA code of conduct.

12. This agreement shall in all respects be construed under and subject to English Law.

13. Any change in the standard rate of VAT shall be taken into account when calculating any payment due.

14. The provider hereby undertakes to comply with the provisions of Rules 7 and 9 of the Solicitors Regulation Authority code of conduct, in particular, 9.02 (b) and (e) subparagraphs (i) and (ii) the methods by which we obtain leads complies with 9.02 (c) and therefore Rule 7 of the code. The provider agrees that before making a referral the client will be given all relevant information about the referral namely:-

'."\t\t\t\t\t\t\t\t\t\t\t\t".'1. The fact that the provider has a financial arrangement with the member.
'."\t\t\t\t\t\t\t\t\t\t\t\t".'2. The amount of referral fee paid

15. The contractual term will be for '.$model->contract_length.' months or until such time that the solicitors regulation authority advise the fixed marketing fee is captured within the scope of any referral fee ban';

		$pdf->AddPage();
		
		$pdf->SetFont("helvetica", "B", 9);
		$pdf->Cell(0,1, "TERMS AND CONDITIONS",0,0,C);
		
		$pdf->Ln(2);
		
		$pdf->SetFont("helvetica", "", 8);		
		$pdf->MultiCell(19, 5, $txt."\n", 0, 'J', 0, 0, '' ,'', true);
		
		
		$pdf->Output("example_002.pdf", "I");
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=SolicitorContractDetails::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='solicitor-contract-details-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
