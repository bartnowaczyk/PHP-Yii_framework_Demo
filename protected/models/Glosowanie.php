<?php

/**
 * This is the model class for table "Glosowanie".
 *
 * The followings are the available columns in table 'Glosowanie':
 * @property integer $id
 * @property integer $radaId
 * @property string $dataOd
 * @property string $dataDo
 * @property string $nazwa
 * @property string $opis
 * @property integer $status
 * @property integer $settingsId
 *
 * The followings are the available model relations:
 * @property Glosy[] $glosy
 * @property Rada $rada
 * @property Settings $settingsId
 * @property Propozycje[] $propozycje
 */
class Glosowanie extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Glosowanie the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
		public $domyslne;
		public $voted;
		public $firstVote;
		public $lastVote;
		public $numberOfVotes;
		

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Glosowanie';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('radaId, dataOd, dataDo, nazwa', 'required', 'message'=>'	Wartość zmiennej {attribute} jest wymagana.'),
			array('radaId, status, settingsId', 'numerical', 'integerOnly'=>true),
			array('nazwa', 'length', 'max'=>200),
			array('dataDo, opis, domyslne', 'safe'),
			array('dataOd, dataDo', 'date', 'format'=>'yyyy-M-d'),
			array('dataDo', 'validateDate'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, radaId, dataOd, dataDo, nazwa, opis, status, settingsId, domyslne', 'safe',  'on'=>'search'),
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
			'gloses' => array(self::HAS_MANY, 'Glos', 'glosowanieId'),
			'rada' => array(self::BELONGS_TO, 'Rada', 'radaId'),
			'settings' => array(self::BELONGS_TO, 'Settings', 'settingsId'),
			'propozycje' => array(self::HAS_MANY, 'Propozycja', 'glosowanieId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'radaId' => 'Rada',
			'dataOd' => 'Data rozpoczęcia',
			'dataDo' => 'Data zakończenia',
			'nazwa' => 'Nazwa',
			'opis' => 'Opis',
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
		$criteria->compare('radaId',$this->radaId);
		$criteria->compare('dataOd',$this->dataOd,true);
		$criteria->compare('dataDo',$this->dataDo,true);
		$criteria->compare('nazwa',$this->nazwa,true);
		$criteria->compare('opis',$this->opis,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('settingsId',$this->settingsId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function validateDate () {
		if ($this->compareDate($this->dataOd, $this->dataDo)==false) {
			$this->addError('dataOd','Data zakończenia musi być póżniejsza niż data rozpoczęcia');
		}	
	}
	
	public function compareDate($od, $do) {
		$datyOd = explode("-", $od);
		$datyDo = explode("-", $do);
		$startRok=$datyOd[0]; 
		$startMsc=$datyOd[1]; 
		$startDzien=$datyOd[2];
		$koniecRok=$datyDo[0]; 
		$koniecMsc=$datyDo[1]; 
		$koniecDzien=$datyDo[2]; 
		if ($koniecRok<$startRok) {
			return false;
		}
		else if ($koniecRok==$startRok&&$koniecMsc<$startMsc) {
			return false;		
		}
		else if ($koniecRok==$startRok&&$koniecMsc==$startMsc&&$koniecDzien<$startDzien) {
			return false;		
		}
		else {
			return true;		
		}
	}
	
	public function getStatystyki() {
		$criteria = new CDbCriteria;
		$criteria->condition='glosowanieId=:glosowanieId';
		$criteria->params=array('glosowanieId'=>$this->id);
		$criteria->select='id';
		return count(Glos::model()->findAll($criteria));
	}
	
	public function getFirstVote() {
	$criteria = new CDbCriteria;
		$criteria->condition='glosowanieId=:glosowanieId';
		$criteria->params=array('glosowanieId'=>$this->id);
		$criteria->order='data ASC';
		$criteria->limit='1';
		$glos = Glos::model()->find($criteria);
		if (!isset($glos))
			$glos= new Glos;
		return $glos->data;
	}

	public function getLastVote() {
	$criteria = new CDbCriteria;
		$criteria->condition='glosowanieId=:glosowanieId';
		$criteria->params=array('glosowanieId'=>$this->id);
		$criteria->order='data DESC';
		$criteria->limit='1';
		$glos = Glos::model()->find($criteria);
		if (!isset($glos))
			$glos= new Glos;
		return $glos->data;
	}


/*	private function afterFind() {
			parent::afterFind();
//			getStatystyki();
			
	}
*/	
}
